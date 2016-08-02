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
	search_com = setInterval(function () {
		$(".edit_input").focus(function(){
			var c=$(this).children('input');
			var d=$(this).children('p');
			if(c.val()==""){
				d.show();
			}
			});
		}, 500);
	
}