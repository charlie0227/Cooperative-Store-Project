
//function for manage store
var map = null;
var geocoder = null;
var marker;

function initialize() 
{
	if (GBrowserIsCompatible()) 
	{
		map = new GMap2(document.getElementById("map"));
		map.addControl(new GLargeMapControl());	                //加入地圖縮放工具
		map.addControl(new GMapTypeControl());	                //加入地圖切換的工具
		map.addMapType(G_PHYSICAL_MAP);                         //加入地形圖
		map.setCenter(new GLatLng(25.001689, 121.460809), 8);   //設定台灣為中心點
		geocoder = new GClientGeocoder();
	}
}

function createMarker(point,title,html) 
{
	var marker = new GMarker(point);

	GEvent.addListener(marker, "click", function() 
	{
		marker.openInfoWindowHtml(
			html,
			{
				maxContent: html,
				maxTitle: title}
			);
	});
	return marker;
}

function showAddress(address){
	if (geocoder){
		geocoder.getLatLng(
			address,
			function(point){
				if (!point) 
				{
					alert(address + " not found");
				} 
				else 
				{
					if(marker)  //移除上一個點
					{
						map.removeOverlay(marker);
					}
					
					map.setCenter(point, 17);
					
					var title = "地址";
					
					marker = createMarker(point,title,address);

					map.addOverlay(marker);

					marker.openInfoWindowHtml(
						address,
						{
							maxContent: address,
							maxTitle: title}
						);
				}
			}
		);
	}
}
		
function func_for_manage_store(){
	$(document).ready(function(){
		 $("#address").blur(function(){
			 alert("test");
		 });
		
		showAddress($("address"));
	});
}

//manage store //1 for member  2 for store list
function manage_store(str,type){
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				
				
				
				
				
				
				if(type=='1'){
					$("#my_member").hide();
					
					document.getElementById("show_one_store_for_my_member").innerHTML = xmlhttp.responseText;
					$("#show_one_store_for_my_member").show();
				}
				else if(type=='2'){	
					$("#div_show_all_store").hide();
					$("#show_one_store_for_store_list").show();
					document.getElementById("show_one_store_for_store_list").innerHTML = xmlhttp.responseText;
				}
				
				setTimeout(function(){
					func_for_manage_store();
					initialize();
					var sth = document.getElementById("address_map").value;
					showAddress(sth);
				},100);
				
				
			}
		};
		
		xmlhttp.open("GET","store.php?store_id="+str+"&gtype="+type,true);
		xmlhttp.send();
		
	}
}

//to edit store.php's function
function go_edit_store(member_id,edit_id,type){//1 for member 2 for store list
	if (member_id == "" || edit_id == "" ) {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				$("#my_member").show();
				$("#show_one_store_for_my_member").hide();
				func_edit_store();
			}
		};
		xmlhttp.open("GET","edit_store.php?member_id="+member_id+"&edit_id="+edit_id+"&gtype="+type,true);
		xmlhttp.send();
		
	}
}
	

//add store
function add_store(){
	var str = "1";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				func_for_add_store();
				$("#my_member").show();
				$("#show_one_store_for_my_member").hide();
			}
		};
		xmlhttp.open("GET","create_store.php?nothing="+str,true);
		xmlhttp.send();
		
	}
}

//back function
function back(type){//// 1 for member 2 for store list
	if(type=='2')
	{
		$("#show_one_store_for_store_list").hide();
		$("#div_show_all_store").show();
		
		return;
	}
	else if(type=='1')
	{
			$("#show_one_store_for_my_member").hide();
			$("#my_member").show();
			
			return;
	}
}


//search store
function searchforstore(type) { // 1 for member 2 for store list
	var str = document.getElementById("search_type").value;
	/*
	if(type=='2')
	{
		if(document.getElementById("div_show_all_store").innerHTML!="")
		{
			$("#show_one_store_for_store_list").hide();
			$("#div_show_all_store").show();
			alert("test2");
			return;
		}
	}
	if(type=='1')
	{
		if(document.getElementById("my_member").innerHTML!="")
		{
			$("#show_one_store_for_my_member").hide();
			$("#my_member").show();
			alert("test1");
			return;
		}
	}
	*/
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if(type=='2'){
						document.getElementById("div_show_all_store").innerHTML = xmlhttp.responseText;
				}
				else{

						document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				}
				
						$("#tbl").tablepage($("#table_page"), 5);
				
				
			}
		};
		var sth = document.getElementById("searchfor").value;
		xmlhttp.open("GET","store_list.php?search="+str+"&searchfor="+sth+"&gtype="+type,true);
		xmlhttp.send();

	}
}

function go_verify(m_id,s_id,type){
	var str = "5";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					$("#div_show_all_store").hide();
					$("#show_one_store_for_store_list").show();	
					document.getElementById("show_one_store_for_store_list").innerHTML = xmlhttp.responseText;

				}
			}
		};
		str="verify_store.php?member_id="+m_id+"&store_id="+s_id+"&gtype="+type;
		xmlhttp.open("GET",str,true);
		xmlhttp.send();
		
	}
}
function check_verify(m_id,s_id,type){
		$.post("verify.php",
		{
		  member_id:m_id,
		  store_id:s_id
		},
		function(){
			manage_store(s_id,type);
		});
}
