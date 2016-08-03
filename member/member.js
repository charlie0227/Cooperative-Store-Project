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
	xhttp.open("GET", "./member/member_list.php", true);
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
	xhttp.open("GET", "./member/edit_personal.php", true);
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
	xhttp.open("GET", "./member/belong_list.html", true);
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
	xhttp.open("GET", "./member/belong_list_company.php", true);
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
	xhttp.open("GET", "./member/belong_list_store.php?id="+id, true);
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
	xhttp.open("GET", "./member/belong_store_show.php?store_id="+id, true);
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
	xhttp.open("GET", "./member/owner.html", true);
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
	xhttp.open("GET", "./member/owner_list_store.php", true);
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
	xhttp.open("GET", "./member/owner_list_company.php", true);
	xhttp.send();
}