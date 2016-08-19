var lastStore;
function member(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/member_list.php", true);
	xhttp.send();
}
function edit_personal(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#my_member").hide();
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			edit_personal_ready();
			$("#my_member").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/edit_personal.php", true);
	xhttp.send();
}
function edit_personal_ready(){
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
	$('#edit_personal_ajaxForm').submit(function() { 
	 // 提交表单
    $(this).ajaxSubmit(function(data){
		$("#my_member").hide();
		alert(data);
		$("#my_member").fadeIn(500);
	});
    // 为了防止普通浏览器进行表单提交和产生页面导航（防止页面刷新？）返回false

		 return false;
	}); 
}
function edit_password(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#my_member").hide();
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			$("#my_member").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/edit_pass.php", true);
	xhttp.send();
}
function edit_pass_submit(){
	$('#edit_pass_ajaxForm').submit(function() { 
	 // 提交表单
    $(this).ajaxSubmit(function(data){
		alert(data);
		var obj=JSON.parse(data);
		if(obj.q==0){
			alert(obj.result);
			edit_password();
		}
		else{
			alert(obj.result);
			location.href='function/logout.php';
		}
	});
    // 为了防止普通浏览器进行表单提交和产生页面导航（防止页面刷新？）返回false
		 return false;
	}); 
}
function my_belong_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#my_member").hide();
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			belong_list_ready();
			$("#my_member").fadeIn(500);
		}
	};
	xhttp.open("GET", "member/belong_list.html", true);
	xhttp.send();
}
function belong_list_ready(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("div_l").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/belong_list_company.php", true);
	xhttp.send();
}
function show_belong_store(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("div_r").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/belong_list_store.php?id="+id, true);
	xhttp.send();
}
function show_belong_store_content(id,map_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	var thttp;
	thttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("store_info").innerHTML = xhttp.responseText;
			initMap(map_id);//set google map
			find_address(id);//geocodeAddress(address)
		}
	};
	xhttp.open("GET", "member/belong_store_show.php?store_id="+id, true);
	xhttp.send();
}
function my_store_company_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#my_member").hide();
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			owner_store_ready();
			owner_company_ready();
			$("#my_member").fadeIn(500);
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
	$("#my_member").hide();
	document.getElementById("my_member").innerHTML = '<input type="button" value="新增店家" onclick="owner_create_store()">'+'</br>'+'<input type="button" value="新增企業" onclick="owner_create_company()">';
	$("#my_member").fadeIn(500);
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
	member();
	
	$.post("store/verify.php",
		{
			datatype:'json',
		  store_id:id
		},
		function(data){
			var obj=JSON.parse(data);
			show_box_close();
			if(obj.p=="ok")
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
			document.getElementById("my_member").innerHTML = xhttp.responseText;
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
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			$("#search_company_result").hide();
			owner_create_company_search();
			$("#search_company_result").fadeIn(500);
			if ($(".owner_search_company input") != null){
				setInterval(function () {
					if ($(".owner_search_company input").val() != lastStore && $(".owner_search_company input").val() != ""){
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
	lastStore = $(".owner_search_company input").val();
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
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("my_member") != null) {
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			initMap(map_id);//set google map
			find_address(id);//geocodeAddress(address)
		}
	};
	xhttp.open("GET", "member/owner_store.php?store_id="+id, true);
	xhttp.send();
	
}
function owner_store_edit(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("my_member") != null) {
			document.getElementById("my_member").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/edit_store.php?edit_id="+id, true);
	xhttp.send();
}
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

//edit company
function show_own_company_content(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("my_member") != null) {
			document.getElementById("my_member").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/owner_company.php?company_id="+id, true);
	xhttp.send();
	
}

function owner_store_edit(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200 && document.getElementById("my_member") != null) {
			document.getElementById("my_member").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "member/edit_store.php?edit_id="+id, true);
	xhttp.send();
}