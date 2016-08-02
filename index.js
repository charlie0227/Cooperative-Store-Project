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

//js for captcha
var rval;
function checkEmail() {
	var remail = $("#email").val();
	emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
	if (remail.search(emailRule)!=-1) {
		$.post("send_auth.php",
		{
		  datatype:'text',
		  remail:remail
		  
		},
		function(data){
			rval = data;
			//alert(rval);
		});
		document.getElementById("text1").innerHTML = 'Please check your e-mail >_<';
		document.getElementById("send").value = 'Send again 0.0';
	}
	else {
		alert("False");
		//$("#form").focus();
	}
}
function check_rval(){
	var c = $("#check_num").val();
	var result = rval.replace(/\r\n|\n/g,"");
	result = result.replace(/\s+/g, "");
	if(result==c){
		alert("Correct");
		document.getElementById('Done').disabled = false;
	}
	else{
		alert("Wrong");
	}
}