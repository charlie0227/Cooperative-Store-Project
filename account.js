//go to register.php
function go_register(){
	var str = "5";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				func_for_register();

			}
		};
		xmlhttp.open("GET","register.php?nothing="+str,true);
		xmlhttp.send();
		
	}
}

//edit password
function edit_password(){
	var str = "5";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				$("#my_member").show();
				$("#show_one_store_for_my_member").hide();
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				

			}
		};
		xmlhttp.open("GET","edit_password.php?nothing="+str,true);
		xmlhttp.send();
		
	}
}

//edit personal information
function edit_personal(){
	var str = "4";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				$("#my_member").show();
				$("#show_one_store_for_my_member").hide();
				$(document).ready(function(){
					$(".valid").hide();
					$("input").focus(function(){
						$(this).css("background-color", "#cccccc");
					});
					$("input").blur(function(){
						$(this).css("background-color", "#ffffff");
					});
					$("#word").blur(function(){
						var str=$(this).val();
						if(str) 
							$("#star2").hide();
						else $("#star2").show();
						if(str.match(" ")) 
							$("#valid2").show();
						else $("#valid2").hide();
					});
					$("#phone").blur(function(){
						var str=$(this).val();
						if(str) 
							$("#star3").hide();
						else $("#star3").show();
						if(str.match(" ")) 
							$("#valid3").show();
						else $("#valid3").hide();
					});
					$(".gender").blur(function(){
						var str=$(this).val();
						if(str) 
							$("#star4").hide();
						else $("#star4").show();
					});
					$("#email").blur(function(){
						var str=$(this).val();
						if(str) 
							$("#star5").hide();
						else $("#star5").show();
						if(str.match(" ")) 
							$("#valid5").show();
						else $("#valid5").hide();
					});
					$("#name").blur(function(){
						var str=$(this).val();
						if(str) 
							$("#star6").hide();
						else $("#star6").show();
						if(str.match(" ")) 
							$("#valid6").show();
						else $("#valid6").hide();
					});
				});
			}
		};
		xmlhttp.open("GET","edit_personal_information.php?nothing="+str,true);
		xmlhttp.send();
		
	}
}
function go_register(){
	var str = "5";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				func_for_register();

			}
		};
		xmlhttp.open("GET","register.php?nothing="+str,true);
		xmlhttp.send();
		
	}
}
function check_login(){
	$.post("check_login.php",
		{
		  datatype:'json',
		  username:document.getElementById("username").value,
		  password:document.getElementById("password").value
		},
		function(data){
			var obj=JSON.parse(data);
			location.reload();
			alert(obj.message);
		}
		
		);
}