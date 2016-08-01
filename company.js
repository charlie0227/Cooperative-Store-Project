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
	xhttp.open("GET", "company_search.php?q="+q+"&word="+word, true);
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
	xhttp.open("GET", "company_list.php", true);
	xhttp.send();
}

function view_company(id){
	clear();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "company.php?company_id="+id, true);
	xhttp.send();
	}