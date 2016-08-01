<?php
require_once "sysconfig.php";
?>
<html>
	<!--memeber func-->
	<div hidden id="please_login">	
		<?if(!$_SESSION['name']){?>
			<p><-----------</p>
			<p>Please Login first</p>
		<?}?>
	</div>
	<div hidden id = "membership" name="qt2">
		
		<?if($_SESSION['name']){?>
			<h2>會員專區</h2>
			<table>
			<tr>
			 <td><input class="abutton" id = "show_add_store"  type="button" value="add new store" onclick="add_store()"></td>
			 <td><input class="abutton" type="button" value="manage store" onclick="chage_store(1,1)"></td>
			 <td><input class="abutton" type="button" value="manage contract" onclick="contract_list()"></td>
			 <td><input class="abutton" type="button" value="edit personal information" onclick="edit_personal()"></td>
			 <td><input class="abutton" type="button" value="edit password" onclick="edit_password()"></td>
			</tr>
			</table>	
		<?}?>
		
		<div id="my_member">
			
		</div>
		<div id='show_one_store_for_my_member'></div>
	</div>
</html>
