<?php
require_once "sysconfig.php";

$_SESSION['type']='2';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8" />
		<!--<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA7kv2J21zjjZ6-_0abHxjqRTlRgz5vSA1MZbuL2l0P1cs_mO7FRT360m_w5W8HA98LDNckSGFAzJMBg"></script>-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI"async defer></script>
		<script src="googleAPI.js"></script>
		<script type="text/javascript" src="http://connect.facebook.net/zh_TW/all.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
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
		<link rel="stylesheet" type="text/css" href="jquery-an-showbox.css">
		<link rel="stylesheet" href="style.css">
		<?
			$sql = "SELECT name FROM `jangsc27_cs_project`.`store` ";
			$sth = $db->prepare($sql);
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
			
			$sql = "SELECT account FROM `jangsc27_cs_project`.`member`";
			$sth = $db->prepare($sql);
			$sth->execute();
			$register_result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
		?>
		<!--change color of block-->
		<script language="javascript">
			$(function(){
				//當滑鼠滑入時將div的class換成divOver
				$('.sidebar').hover(function(){
						$(this).addClass('sidebar_over');		
					},function(){
						//滑開時移除divOver樣式
						$(this).removeClass('sidebar_over');	
					}
				);
			});
		</script>
	</head>
	<body>  
		<!--<div style = "width:600px; margin:0 auto; font-size:13px;" id="sitebody">-->
　		<div style = "border-radius: 10px;" id="the_header"><h1>Home</h1></div>
　		<div style = "width:100%;">
			<div id="sidebar">
				<!--login status-->
				<?if($_SESSION['name']){?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">Hi, <?echo $_SESSION['name']?> </h3>
					<input class = "abutton" style = "width: 90%;" type="button" value="logout" onclick="fblogout();location.href='logout.php';">
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
　		<div id="footer">footer</div>
	</body>
</html>
