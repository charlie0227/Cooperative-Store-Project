<?php
require_once "../sysconfig.php";
?>
<html>	
	<?if(!isset($_SESSION['name'])){?>
		<p><-----------</p>
		<p>請先登入</p>
	<?}
	if(isset($_SESSION['name'])){?>
		<h2>會員專區</h2>
		<table style="margin-left: 5%;">
		<tr><td style="border: 3px solid #fff; "><input class="member_option" type="button" value="所屬團體" onclick="my_belong_list(<?echo $_SESSION['id']?>)"></td></tr>
		<tr><td style="border: 3px solid #fff; "><input class="member_option" type="button" value="擁有店家/企業管理" onclick="my_store_company_list()"></td></tr>
		<tr><td style="border: 3px solid #fff; "><input class="member_option" type="button" value="修改會員資料" onclick="edit_personal()"></td></tr>
		<tr><td style="border: 3px solid #fff; "><input class="member_option" type="button" value="修改密碼" onclick="edit_password()"></td></tr>
		</table>
	<?}?>
	<div style="margin:25px;"id="my_member"></div>

</html>
