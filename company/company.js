var lastwordValue = '';
var lastforValue = '';
var search_com;
var clear_interval =function (interval){
	clearInterval(interval);
}
function show_company_list(){
	lastwordValue = $("#search_word").val();
	lastforValue = $("#search_for").val();
	
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_search_company").innerHTML = xhttp.responseText;
		}
	};
	var q = $("#search_for").val();
	var word = $("#search_word").val();
	xhttp.open("GET", "company/company_search.php?q="+q+"&word="+word, true);
	xhttp.send();
}

function company_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#show_search_company").hide();
			show_company_list();
			$("#show_search_company").fadeIn(500);
			search_com=setInterval(function () {
				if ($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue && $("#search_word").val() != "") ){
					$("#show_search_company").hide();
					show_company_list();
					$("#show_search_company").fadeIn(500);
				}
				if(document.getElementById("company_bar")== null){
					clear_interval(search_com);
				}
			}, 500);
		}
	};
	xhttp.open("GET", "company/company_list.html", true);
	xhttp.send();
}

function view_company(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#company_bar").hide();
			$("#into_company").hide();
			document.getElementById("into_company").innerHTML = xhttp.responseText;
			$("#into_company").fadeIn(500);
		}
	};
	xhttp.open("GET", "company/company.php?company_id="+id, true);
	xhttp.send();
	}
function back_to_company_list(){
	$("#into_company").hide();
	$("#company_bar").fadeIn(500);
}

function add_new_company(){
	company_list();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#company_bar").hide();
			$("#into_company").hide();
			document.getElementById("into_company").innerHTML = xhttp.responseText;
			add_company_ready();
			$("#into_company").fadeIn(500);
		}
	};
	xhttp.open("GET", "company/create_company.php", true);
	xhttp.send();
}
function add_company_ready(){
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
function company_submit(){
	$('#company_ajaxForm').submit(function() {
		$(this).ajaxSubmit(function(data){
			var obj=JSON.parse(data);
			if(obj.error)
				alert(obj.error);
			show_company_list();
			view_company(obj.p);
		});
		 return false;
	}); 
}

function view_company(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#company_bar").hide();
			$("#into_company").hide();
			document.getElementById("into_company").innerHTML = xhttp.responseText;
			$("#into_company").fadeIn(500);
		}
	};
	xhttp.open("GET", "company/company.php?company_id="+id, true);
	xhttp.send();
}

function apply(member_id,company_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "company/application_form.php?company_id="+company_id+"&member_id="+member_id, true);
	xhttp.send();
}
function apply_cancel(member_id,company_id,type){
	$.post("member/application_confirm.php",
	{
		datatype:'json',
		member_id:member_id,
		company_id:company_id,
		type:type
		
	},
	function(){
		view_company(company_id);
	});
}
function application_submit(){
	show_box_close();
	$('#application_ajaxForm').submit(function() { 
	 // 提交表单
    $(this).ajaxSubmit(function(data){
		if(data)
			alert("Thank you for your comment!已送出"); 
			view_company(data);
	});
    // 为了防止普通浏览器进行表单提交和产生页面导航（防止页面刷新？）返回false
   

		 return false;
	}); 
}
