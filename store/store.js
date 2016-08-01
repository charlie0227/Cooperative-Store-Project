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
					;//alert(address + " not found");
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


var lastwordValue = '';
var lastforValue = '';
var search_sto;

function clear(){
	clearInterval(search_sto);
}
function show_store_list(){
	lastwordValue = $("#search_word").val();
	lastforValue = $("#search_for").val();
	
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#show_search_store").hide();
			document.getElementById("show_search_store").innerHTML = xhttp.responseText;
			$("#show_search_store").fadeIn(500);
		}
	};
	var q = $("#search_for").val();
	var word = $("#search_word").val();
	xhttp.open("GET", "./store/store_search.php?q="+q+"&word="+word, true);
	xhttp.send();
}

function store_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			show_store_list();
			search_com = setInterval(function () {
				if ($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue && $("#search_word").val() != "") ){
					show_store_list();
					}
			}, 500);
		}
	};
	xhttp.open("GET", "./store/store_list.html", true);
	xhttp.send();
}
function find_address(id){
	$.post("./store/check_store.php",
		{
		  datatype:'json',
		  store_id:id
		},
		function(data){
			var obj=JSON.parse(data);
			alert(obj);
		}
		
		);
		//showAddress('<?echo $temp->address?>')
}
function view_store(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			find_address(id);//set google map
			$("#store_bar").hide();
			$("#into_store").hide();
			document.getElementById("into_store").innerHTML = xhttp.responseText;
			$("#into_store").fadeIn(500);
		}
	};
	xhttp.open("GET", "./store/store.php?store_id="+id, true);
	xhttp.send();
}
function back_to_store_list(){
	$("#into_store").hide();
	$("#store_bar").fadeIn(500);
}
function add_new_store(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#store_bar").hide();
			$("#into_store").hide();
			document.getElementById("into_store").innerHTML = xhttp.responseText;
			$("#into_store").fadeIn(500);
		}
	};
	xhttp.open("GET", "./store/create_store.php", true);
	xhttp.send();
}
