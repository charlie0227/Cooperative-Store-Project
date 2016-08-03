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

//menuBAR
var VisibleMenu = ''; // 記錄目前顯示的子選單的 ID
// 顯示或隱藏子選單
function switchMenu( theMainMenu, theSubMenu, theEvent ){
	var SubMenu = document.getElementById( theSubMenu );
	if( SubMenu.style.display == 'none' ){ // 顯示子選單
		SubMenu.style.minWidth = theMainMenu.clientWidth; // 讓子選單的最小寬度與主選單相同 (僅為了美觀)
		SubMenu.style.display = 'block';
		hideMenu(); // 隱藏子選單
		VisibleMenu = theSubMenu;
	}
	else{ // 隱藏子選單
		if( theEvent != 'MouseOver' || VisibleMenu != theSubMenu ){
			SubMenu.style.display = 'none';
			VisibleMenu = '';
		}
	}
}

// 隱藏子選單
function hideMenu(){
	if( VisibleMenu != '' ){
		document.getElementById( VisibleMenu ).style.display = 'none';
	}
	VisibleMenu = '';
}

// 顯示通知內容
function shownotice(){
	
}