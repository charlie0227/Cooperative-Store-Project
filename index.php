<?php
require_once "sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8" />
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
		
		<script src="http://code.jquery.com/jquery-1.6.min.js"></script>
		<script src="js/jquery-1.12.4.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI"async defer></script>
		<script src="http://connect.facebook.net/zh_TW/all.js"></script>
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		<script src="js/jquery.reveal.js"></script>
		<script src="js/jquery-an-showbox.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="api/fbapi.js"></script>
		<script src="store/store.js"></script>
		<script src="company/company.js"></script>
		<script src="member/member.js"></script>
		<script src="function/index.js"></script>
		<script src="api/googleAPI.js"></script>
		<!--
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI"async defer></script>
		<script src="googleAPI.js"></script>
		<script type="text/javascript" src="http://connect.facebook.net/zh_TW/all.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		<script type="text/javascript" src="jquery.reveal.js"></script>
		<script src="jquery-1.12.4.min.js"></script>
		<script src="contract.js"></script>
		<script src="./store/store.js"></script>
		<script src="account.js"></script>
		<script src="./company/company.js"></script>
		<script src="./member/member.js"></script>
		<script src="index.js"></script>
		<script src="fbapi.js"></script>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="jquery-tablepage-1.0.js"></script>
		<script type="text/javascript"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<script type="text/javascript" src="jquery-an-showbox.js"></script>
		-->
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/reveal.css" rel="stylesheet" type="text/css" />
		<link href="css/jquery-an-showbox.css" rel="stylesheet" type="text/css" />
		<link href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" rel="stylesheet" >
		
		
		

	</head>
	<body>  
		<!--<div style = "width:600px; margin:0 auto; font-size:13px;" id="sitebody">-->
		<div style="text-align:center;">
		<ul class="header">
			<li class="menu_bar"><a href="#">Home</a></li>
			<li class="menu_bar" id="dropdown" onclick="shownotice(<?echo $_SESSION['id']?>)">
				<a href="#" id="dropbtn">Notice</a>
			</li>
			<li class="menu_bar_search" ><input id="search_bar" style="width:100%;"type="text" name="search_bar" placeholder="Search for store and company"></li>

		</ul>
		</div>
		

　		<div style = "width:66%; text-align:center;">
			<div id="sidebar">
				<input class = "abutton" style = "width:90%; margin-bottom: 5px;" type="button" value="test" onclick="fblogin()">
				<!--login status-->
				<?if($_SESSION['name']){?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">Hi, <?echo $_SESSION['name']?> </h3>
					<input class = "abutton" style = "width: 90%;" type="button" value="logout" onclick="fblogout();location.href='./function/logout.php';">
				<?}else{?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">會員登入</h3>
					<input style = "margin-bottom: 5px;" id="username" type="text" name="username" placeholder="Account">
					<input style = "margin-bottom: 5px;" id="password" type="password" name="password" placeholder="Password">
					<input class = "abutton" style = "width:90%; margin-bottom: 5px;" type="button" value="login" onclick="check_login()">
					<input class = "abutton" style = "width:90%; margin-bottom: 5px;" type="button" value="register" onclick="go_register()">
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
				<?}?>

				<input type="button" class = "sidebar" id = "show_news" onclick="news()" value="最新消息">
				<input type="button" class = "sidebar" id = "show_member" onclick="member()" value="會員專區">
				<input type="button" class = "sidebar" id = "show_store" onclick="store_list()" value="商店列表">
				<input type="button" class = "sidebar" id = "show_company" onclick="company_list()" value="企業列表">
			</div>
			<div id="content" >
			</div>
			
		</div>
		<div style='clear:both;'></div>		
　		<!--<div id="footer">footer</div>-->
		<div id="show_box" class="reveal-modal"><a class="close-reveal-modal"></a></div>
	</body>
</html>
