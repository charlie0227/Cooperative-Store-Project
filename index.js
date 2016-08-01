$(document).ready( function() {
	$("#tbl").tablepage($("#table_page"), 5);
})
$(document).ready(function(){
	news();
});
function news(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "news.php", true);
	xhttp.send();
}