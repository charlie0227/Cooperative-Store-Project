var lastwordValue = '';
var lastforValue = '';
setInterval(function() {
    if ($("#search_word").val() != lastwordValue || $("#search_for").val() != lastforValue) {
        lastwordValue = $("#search_word").val();
		lastforValue = $("#search_for").val();
		
        var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				$("#show_company").hide();
				document.getElementById("show_company").innerHTML = xhttp.responseText;
				$("#show_company").fadeIn(1000);
			}
		};
		var q = document.getElementById("search_for").value;
		var word = document.getElementById("search_word").value;
		xhttp.open("GET", "company_search.php?q="+q+"&word="+word, true);
		xhttp.send();
		}
}, 500);
