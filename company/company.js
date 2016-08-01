var lastwordValue = '';
var lastforValue = '';
var search_com;
function clear(){
	clearInterval(search_com);
}
function show_company_list(){
	lastwordValue = $("#search_word").val();
	lastforValue = $("#search_for").val();
	
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#show_search_company").hide();
			document.getElementById("show_search_company").innerHTML = xhttp.responseText;
			$("#show_search_company").fadeIn(500);
		}
	};
	var q = $("#search_for").val();
	var word = $("#search_word").val();
	xhttp.open("GET", "./company/company_search.php?q="+q+"&word="+word, true);
	xhttp.send();
}

function company_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			show_company_list();
			search_com = setInterval(function () {
				if ($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue && $("#search_word").val() != "") ){
					show_company_list();
					}
			}, 500);
		}
	};
	xhttp.open("GET", "./company/company_list.html", true);
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
	xhttp.open("GET", "./company/company.php?company_id="+id, true);
	xhttp.send();
	}
function back_to_company_list(){
	$("#into_company").hide();
	$("#company_bar").fadeIn(500);
}