<?php
require_once "sysconfig.php";
write_log('Visit','');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8" />
		<html xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">


		<script src="js/jquery-3.1.0.min.js"></script>
		<script src="js/jspdf.debug.js"></script>
		<script src="function/index.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>

		<script src="js/jquery.reveal.js"></script>
		<script src="js/jquery-an-showbox.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI&libraries=places"async defer></script>
		<script src="https://connect.facebook.net/zh_TW/all.js"></script>
		<script src="https://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		<script src="api/fbapi.js"></script>
		<script src="js/iscroll-probe.js"></script>
		<script src="store/store.js"></script>
		<script src="company/company.js"></script>
		<script src="member/member.js"></script>
		<script src="contract/contract.js"></script>

		<script async src="api/googleAPI.js"></script>

		<!--contract UI-->
		<script src="js/require.js" defer async="true" data-main="js/main"></script>
		<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2016.2.714/styles/kendo.common.min.css"/>
		<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2016.2.714/styles/kendo.rtl.min.css"/>
		<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2016.2.714/styles/kendo.silver.min.css"/>
		<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2016.2.714/styles/kendo.default.min.css"/>
		<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2016.2.714/styles/kendo.mobile.all.min.css"/>
		<!---test-->
		<!---->

		<script src="js/jquery.form.js"></script>

		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/reveal.css" rel="stylesheet" type="text/css" />
		<link href="css/iscroll.css" rel="stylesheet" type="text/css" />
		<link href="css/jquery-an-showbox.css" rel="stylesheet" type="text/css" />
		<link href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" rel="stylesheet" >
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<style>
/* Material Theme padding adjustment*/




				#news_map{
					width: 500px;
					height: 500px;
				  }

   .mobileShow { display: none;}
   @media only screen
   and (min-device-width : 320px)
   and (max-device-width : 480px){ .mobileShow { display: inline;}}

</style>
	</head>
	<body>
		<!--<div style = "width:600px; margin:0 auto; font-size:13px;" id="sitebody">-->
		<div style="text-align:center;">
		<ul class="header">
			<li class="menu_bar"><input type="image" style="width:130px;height:60px" src="images/black_mark.png" onclick="location.reload()"></li>

			<li class="menu_bar">
			<div class="dropdown" id="dropdown">
			<a href="#" id="dropbtn"><div class="title">Notice</div></a>

				  <div class="dropdown-content" id="dropdown-content">
					<a href="#" class="big-link" data-reveal-id="show_box">
					<input class="k-button" type="button" value="查看想與您簽約的團體" onclick="view_contract_application()">
					</a>
					<a href="#" class="big-link" data-reveal-id="show_box">
					<input class="k-button" type="button" value="查看加入你企業的申請" onclick="view_member_application()">
					</a>
				  </div>
				</div>
			</li>

			<li class="menu_bar_search" ><input id="search_bar" style="width:100%;"type="text" name="search_bar" placeholder="Search for store and company"></li>
			<li class="account_bar"><?if(isset($_SESSION['name'])){?>
				<p style="color:white">Welcome , <?echo $_SESSION['name']?></p>
			<a type="button" class = "k-button" onclick="fblogout();location.href='./function/logout.php';">登出</a>
			<?}else{?>
			<a type="button" class = "k-button" style="background: #E78F8E;" href="#" class="big-link" data-reveal-id="show_box" onclick="show_box_login()">登入</a>
			<a type="button" class = "k-button" style="background: #E78F8E;" href="#" class="big-link" data-reveal-id="show_box" onclick="show_box_register()">註冊</a>

			<?}?>
			</li>
		</ul>
		</div>


　		<div style = "text-align:center;">
			<div>
				<div id="sidebar">
					<!--<input class = "abutton" style = "width:90%; margin-bottom: 5px;" type="button" value="test" onclick="fblogin()">-->
					<!--login status-->

					<input type="button" class = "sidebar" style="border-top:2px solid white;" id = "show_news" onclick="news()" value="最新消息">
					<input type="button" class = "sidebar" id = "show_member" onclick="member()" value="會員專區">
					<?if(isset($_SESSION['name'])){?>
						<input class="mem_op" type="button" style="display:none;" value="所屬團體" onclick="my_belong_list()"></td>
						<input class="mem_op" type="button" style="display:none;" value="擁有店家/企業管理" onclick="my_store_company_list()"></td>
						<input class="mem_op" type="button" style="display:none;" value="修改會員資料" onclick="edit_personal()">
						<input class="mem_op" type="button" style="display:none;" value="修改密碼" onclick="edit_password()">
					<?}?>

					<input type="button" class = "sidebar" id = "show_store" onclick="store_list()" value="商店列表">
					<input type="button" class = "sidebar" id = "show_company" onclick="company_list()" value="企業列表">
					<input type="button" class = "sidebar" id = "quick_contract" onclick="goto_quick_contract()" value="快速新增合約">
					<input type="button" class = "sidebar" id = "read_me" onclick="read_me()" value="使用說明">


				</div>
			</div>

			<div id="content" ></div>

		</div>
		<div style='clear:both;'></div>
　		<!--<div id="footer">footer</div>-->
		<div id="show_box" class="reveal-modal"><a class="close-reveal-modal"></a></div>
		<div id="loading" style="display:none;"><img src="images/loading.gif"></div>
		<div id="test" class="mobileShow" style="margin: 0px auto;font-size:36px;">
		<div id="m-show_box" class="reveal-modal" ><a class="close-reveal-modal"></a></div>
		<input type="hidden" id="back_history" value="#">
		</div>
	</body>
</html>
