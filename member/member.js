var lastStore;
var lastCompany
function member(){
	var xhttp;
	$('#loading').show();
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$('#loading').hide();
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/member_list.php", true);
	xhttp.send();
	$(".mem_op").slideDown();
}
function edit_personal(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			edit_personal_ready();
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/edit_personal.php", true);
	xhttp.send();
}
function edit_personal_ready(){
	$("#year").kendoDropDownList({
		optionLabel: "--Year--"
	});
	$("#month").kendoDropDownList({
		optionLabel: "--Month--"
	});
	$("#date").kendoDropDownList({
		optionLabel: "--Date--"
	});
	$(".edit_input input").change(function(){
		if($(this).val()==""){
			var c=$(this).next();
			c.show();
		}
		else{
			var c=$(this).next();
			c.hide();
		}
	});
}
function edit_personal_submit(){
	$.ajax({
		type:"POST",
		url:'member/edit_personal_ok.php',
		data:$('#edit_personal_ajaxForm').serialize(),
		dataType:'json',
		success:function(r){
			alert('12');
			if(r.q=='1'){
				alert(r.result);
				alert('7777777');
				edit_personal();
				return false;
			}
			else{
				alert(r.result);
				edit_personal();
				return false;
			}
		}
	});
	 // 提交表单
    /*$(this).ajaxSubmit(function(data){
		$("#content").hide();
		alert(data);
		$("#content").fadeIn(500);
	});
    // 为了防止普通浏览器进行表单提交和产生页面导航（防止页面刷新？）返回false

		 return false;
	});
	*/
}
function edit_password(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/edit_pass.php", true);
	xhttp.send();
}
function edit_pass_submit(){
	$.ajax({
		type:'POST',
		url:'member/edit_pass_ok.php',
		data:$('#edit_pass_ajaxForm').serialize(),
		dataType:'json',
		success:function(r){
			//alert(r.result);
			if(r.q==1)
				location.href='function/logout.php';
			else{
				alert(r.result);
				edit_password();
			}

			return false;
		},
		error:function(){
			edit_password();
			return false;
		}
	});
	/*$('#edit_pass_ajaxForm').submit(function() {
	 // 提交表单
    $(this).ajaxSubmit(function(data){
		//alert(data);
		var obj=JSON.parse(data);
		if(obj.q==0){
			alert(obj.result);
			edit_password();
		}
		else{
			//alert(obj.result);
			console.log("QQ");
			location.href='function/logout.php';
		}
	});
    // 为了防止普通浏览器进行表单提交和产生页面导航（防止页面刷新？）返回false
		 return false;
	});*/
}
function my_belong_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			belong_list_search('company_id');
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/belong_list.html", true);
	xhttp.send();
}
function belong_list_search(order){
	$('#loading').show();
	$.post("member/belong_list.php",
	{
		datatype:'json',
		q:order
	},
	function(data){
		var obj=JSON.parse(data);
		for(var i=0; i<obj.length; i++){
			//discount calculate
			var res=obj[i].content;
			var content=JSON.parse(res);
			var discount="";
			var discount_intro="";
			if(obj[i].status==2){
				if(content.method=="dynamic"){
					discount=parseInt(content.big)-Math.floor(parseInt(obj[i].num)/parseInt(content.people));
					discount=(discount<parseInt(content.small))?parseInt(content.small):discount;
					//discount introduction
					var big=(parseInt(content.big)%10==0)?parseInt(content.big)/10:parseInt(content.big);
					var how_many=content.people-(obj[i].num % content.people);
					var small=(parseInt(content.small)%10==0)?parseInt(content.small)/10:parseInt(content.small);
					discount_intro="原始折扣"+big+"折 再消費"+how_many+"人可再折扣1% 最低至"+small+"折";
				}
				else{
					discount=parseInt(content.discount);
					discount_intro="固定折扣";
				}
				discount=(discount%10==0)?discount/10:discount;
				//append into table
				$( "#belong_search" ).append('<tr>\
					<td><input class="k-button" type="button" value="'+obj[i].company_name+'"></td>\
					<td><input class="k-button" type="button" value="'+obj[i].store_name+'"></td>\
					<td><p>'+discount+'折</p></td>\
					<td><p>'+discount_intro+'</p></td>\
					<td><input type="button" class="k-button" style="width:auto;" value="退出此團體" onclick="quit('+"'"+'belong_list'+"'"+','+obj[i].company_id+')"></td>\
					</tr>');
			}
		}
		$('#loading').hide();
	});
}
function show_belong_company_discount(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("div_r").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/belong_company_discount.php?company_id="+id, true);
	xhttp.send();
}
function show_belong_store_content(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/belong_store_show.php?store_id="+id, true);
	xhttp.send();
}
function my_store_company_list(){
	$('#loading').show();
	var xhttp;
	$('#back_history').val('my_store_company_list');
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			owner_store_ready();
			owner_company_ready();
			$("#content").fadeIn(500);
			$('#loading').hide();
		}
	};
	xhttp.open("GET", "member/owner.html", true);
	xhttp.send();
}
function owner_store_ready(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("div_l").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/owner_list_store.php", true);
	xhttp.send();
}
function owner_company_ready(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("div_r").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/owner_list_company.php", true);
	xhttp.send();
}
function owner_create(){
	$("#content").hide();
	document.getElementById("content").innerHTML = '<input type="button" value="新增店家" onclick="owner_create_store()">'+'</br>'+'<input type="button" value="新增企業" onclick="owner_create_company()">';
	$("#content").fadeIn(500);
}
function owner_show_store(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/owner_verify_store.php?store_id="+id, true);
	xhttp.send();
}
function owner_show_company(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/owner_verify_company.php?company_id="+id, true);
	xhttp.send();
}
function owner_verify_store(id){
	show_box_close();
	member();
	$.post("store/verify.php",
		{
			datatype:'json',
		  store_id:id
		},
		function(data){
			var obj=JSON.parse(data);
			if(obj.p=="ok")
				my_store_company_list();
		});
}
function delete_store_owner(){
	var store_id = document.getElementById("store_id").value;
	$.post("member/delete_store_owner.php",
		{
			datatype:'json',
		    store_id:store_id
		},
		function(data){
			var obj=JSON.parse(data);
			if(obj.q=="ok")
				my_store_company_list();
		});

}
function owner_verify_company(id){
	member();
	$.post("company/verify.php",
		{
			datatype:'json',
		  company_id:id
		},
		function(data){
			var obj=JSON.parse(data);
			show_box_close();
			if(obj.p=="ok")
				my_store_company_list();
		});
}


function owner_create_store(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#search_store_result").hide();
			owner_create_store_search();
			$("#search_store_result").fadeIn(500);
			if ($(".owner_search_store input") != null){
				setInterval(function () {
					if ($(".owner_search_store input").val() != lastStore && $(".owner_search_store input").val() != ""){
						$("#search_store_result").hide();
						owner_create_store_search();
						$("#search_store_result").fadeIn(500);
						}
					}, 500);
			}
		}
	};
	xhttp.open("GET", "member/owner_create_store.html", true);
	xhttp.send();
}
function owner_create_store_search(){
	lastStore = $(".owner_search_store input").val();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("search_store_result") != null) {
			document.getElementById("search_store_result").innerHTML = xhttp.responseText;
		}
	};
	var word = $(".owner_search_store input").val();
	xhttp.open("GET", "member/owner_create_store.php?word="+word, true);
	xhttp.send();
}
function owner_create_store_form(){


}
//company
function owner_create_company(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#search_company_result").hide();
			owner_create_company_search();
			$("#search_company_result").fadeIn(500);
			if ($(".owner_search_company input") != null){
				setInterval(function () {
					if ($(".owner_search_company input").val() != lastCompany && $(".owner_search_company input").val() != ""){
						$("#search_company_result").hide();
						owner_create_company_search();
						$("#search_company_result").fadeIn(500);
						}
					}, 500);
			}
		}
	};
	xhttp.open("GET", "member/owner_create_company.html", true);
	xhttp.send();
}
function owner_create_company_search(){
	lastCompany = $(".owner_search_company input").val();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("search_company_result") != null) {
			document.getElementById("search_company_result").innerHTML = xhttp.responseText;
		}
	};
	var word = $(".owner_search_company input").val();
	xhttp.open("GET", "member/owner_create_company.php?word="+word, true);
	xhttp.send();
}
//edit store
function show_own_store_content(id,map_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("content") != null) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			initMap(map_id);//set google map
			find_address(id);//geocodeAddress(address)
		}
	};
	xhttp.open("GET", "member/owner_store.php?store_id="+id, true);
	xhttp.send();

}
function owner_store_edit(){
	var store_id=document.getElementById("store_id").value;
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("content") != null) {
			document.getElementById("content").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/edit_store.php?edit_id="+store_id, true);
	xhttp.send();
}
/*
function edit_store_submit(){
	$('#edit_store_form').submit(function() {
		$(this).ajaxSubmit(function(data){
			var obj=JSON.parse(data);
			if(obj.error)
				alert(obj.error);
			show_own_store_content(obj.p,'store_map');
		});
		 return false;
	});
}
*/
function  edit_store_submit(){
	$.ajax({
		type:'POST',
		url:'member/edit_store_confirm.php',
		data:$('#edit_store_form').serialize(),
		dataType:'json',
		success:function(data){
			var obj=JSON.parse(data);
			if(obj.error)
				alert(obj.error);
			show_own_store_content(obj.p,'store_map');
			return false;
		},
		error:function(){
			return false;
		}
	});
}
//edit company
function show_own_company_content(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("content") != null) {
			document.getElementById("content").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/owner_company.php?company_id="+id, true);
	xhttp.send();

}

function owner_company_edit(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("content") != null) {
			document.getElementById("content").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/edit_company.php?edit_id="+id, true);
	xhttp.send();
}
function  edit_company_submit(){
	$.ajax({
		type:'POST',
		url:'member/edit_company_confirm.php',
		data:$('#edit_company_form').serialize(),
		dataType:'json',
		success:function(data){
			alert(data);
			var obj=JSON.parse(data);
			if(obj.error)
				alert(obj.error);
			show_own_company_content(obj.p);
			return false;
		},
		error:function(data){
			alert(data);
			return false;
		}
	});
}
function show_application(id){ //id for company
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/check_one_application.php?company_id="+id, true);
	xhttp.send();
}

function application_confirm(member_id,company_id,type){
	$.post("member/application_confirm.php",
	{
		datatype:'json',
		member_id:member_id,
		company_id:company_id,
		type:type

	},
	function(){
		show_application(company_id);
	});
}

function show_discount(id){//company id
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("div_r").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/show_discount.php?company_id="+id, true);
	xhttp.send();
}

//kendo dropdown select
function dropselect(){
	$("#year").kendoDropDownList({
		optionLabel: "--Start time--"
	});
}

function show_own_store_analysis(){
	var store_id=document.getElementById("store_id").value;
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("content") != null) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			createChart(store_id);
		}
	};
	xhttp.open("GET", "member/owner_store_analysis.php?store_id="+store_id, true);
	xhttp.send();

}

function createChart(id) {
	$.post("member/population_information.php",
	{
		datatype:'json',
	    store_id:id
	},
	function(data){
		var temp='{"list":'+data+'}';
		var obj=JSON.parse(temp);
		var time = new Array();
		var birth = new Array();
		var name = new Array();
		var count;
		var male;
		var female;
		var type;//year 0 month 2016~2036 day 1-12
		var category=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
		var NowDate=new Date();
		var d=new Date();
		$(document).ready(function(){
			$('#ana_m').siblings('input[type=radio]').prop('checked', false);
			$('#ana_m').prop('checked', true);
			count = new Array(12);
			male = new Array(12);
			female = new Array(12);
			mystring=NowDate.getFullYear();
			type="month";
			document.getElementById("ana_n").value=NowDate.getMonth();
		});
		change_chart();
		$('#ana_l').on('click',function(){
			if($('input[id=ana_y]').is(':checked')){
				d.setFullYear(d.getFullYear()-1);
			}
			if($('input[id=ana_m]').is(':checked')){
				d.setMonth(d.getMonth()-1);
			}
			if($('input[id=ana_d]').is(':checked')){
				d.setDate(d.getDate()-1);
			}
		});
		$('#ana_r').on('click',function(){
			if($('input[id=ana_y]').is(':checked')){
				d.setFullYear(d.getFullYear()+1);
			}
			if($('input[id=ana_m]').is(':checked')){
				d.setMonth(d.getMonth()+1);
			}
			if($('input[id=ana_d]').is(':checked')){
				d.setDate(d.getDate()+1);
			}
		});
		$('.ana_select input').on('click',function(){
			change_chart();
		});
		$('.ana_radio input[type=radio]').on('change',function(){
			d=NowDate;
			change_chart();
		});
		function change_chart(){
			if($('input[id=ana_y]').is(':checked')){
				document.getElementById("ana_n").value=d.getFullYear();
				count = new Array(12);
				male = new Array(12);
				female = new Array(12);
				mystring=d.getFullYear();
				category=["Jan", "Feb", "Mar", "Apr", "May", "Jun", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
				type="year";
				}
			if($('input[id=ana_m]').is(':checked')){
				document.getElementById("ana_n").value=d.getMonth()+1;
				var days = new Date(NowDate.getFullYear(),mystring,0).getDate();
				count = new Array(days);
				male = new Array(days);
				female = new Array(days);
				mystring=d.getMonth()+1;
				category=new Array();
				for(var i=0;i<days;i++){
					var t=i+1;
					category=category.concat(t);
				}
				type="month";
				}
			if($('input[id=ana_d]').is(':checked')){
				document.getElementById("ana_n").value=d.getDate();
				count = new Array(24);
				male = new Array(24);
				female = new Array(24);
				mystring=d.getDate();
				category=new Array();
				for(var i=0;i<24;i++){
					var t=i+':00';
					category=category.concat(t);
				}
				type="day";
				}
			for(var i=0;i<count.length;i++){
			count[i]=0;
			male[i]=0;
			female[i]=0;
		}
		for(var i=0;i<obj.list.length;i++){
			var date_tmp=(obj.list[i].time).split("-");
			var tmp=date_tmp[2].split(" ");
			date_tmp[2]=tmp[0];
			var time_tmp=tmp[1].split(":");
			if(type=='year'){
				if(d.getFullYear()==date_tmp[0]){
					var flag=parseInt(date_tmp[1]);
					count[flag-1]=count[flag-1]+1;
					if(obj.list[i].gender=='0'){
						female[flag-1]=female[flag-1]+1;
					}
					else{
						male[flag-1]=male[flag-1]+1;
					}
				}
			}
			else if(type=='month'){
				if(d.getFullYear()==date_tmp[0]){
					if(d.getMonth()+1==date_tmp[1]){
						var flag=parseInt(date_tmp[2]);
						count[flag-1]=count[flag-1]+1;
						if(obj.list[i].gender=='0'){
							female[flag-1]=female[flag-1]+1;
						}
						else{
							male[flag-1]=male[flag-1]+1;
						}
					}
				}
			}
			else{
				if(d.getFullYear()==date_tmp[0]){
					if(d.getMonth()+1==date_tmp[1]){
						if(d.getDate()==date_tmp[2]){
							var flag=parseInt(time_tmp[0]);
							count[flag]=count[flag]+1;
							if(obj.list[i].gender=='0'){
								female[flag]=female[flag]+1;
							}
							else{
								male[flag]=male[flag]+1;
							}
						}
					}
				}
			}
			/*
			alert(date_tmp[0]);//year
			alert(date_tmp[1]);//month
			alert(date_tmp[2]);//day
			alert(time_tmp[0]);//hour
			alert(time_tmp[1]);//min
			alert(time_tmp[2]);//sec
			*/
		}

		$("#chart").kendoChart({
            title: {
                text: mystring
            },
            legend: {
                position: "bottom"
            },
            seriesDefaults: {
                type: "column"
            },
            series: [{
                name: "Total Visits",
                data: count
            },  {
                name: "male visitors",
                data: male
            },  {
                name: "female visitors",
                data: female
            }],
            valueAxis: {
                line: {
                    visible: false
                }
            },
            categoryAxis: {
                categories: category,
                majorGridLines: {
                    visible: false
                }
            },
            tooltip: {
                visible: true,
                format: "{0}"
            }
        });
		}

	});
    }

function show_contract(){
	$('#loading').show();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$('#content').hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$('#loading').hide();
			$('#content').fadeIn(500);
			$('#back_history').val("show_contract");
		}
	};
	xhttp.open("GET", "member/owner_contract_list.php", true);
	xhttp.send();
}
function view_contract_application(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "contract/check_all_application.php", true);
	xhttp.send();
}
function view_member_application(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/check_all_application.php", true);
	xhttp.send();
}
function quit(back,company_id){
	$.post('member/delete_belong.php',{
		back:back,
		company_id:company_id
	},function(data){
		var obj = JSON.parse(data);
		if(obj.back=='company')
			view_company(obj.company_id);
		if(obj.back=='belong_list')
			my_belong_list();
	});
}
