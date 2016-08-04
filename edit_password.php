<?
require_once "sysconfig.php";
?>
<html>
<body>
<form id="edit_passwordl_ajaxForm" style="display:inline;" action="edit_password_confirm.php" method="POST">
		<p>Original Password</p>
		<input type="password" name="old_password" id="old_password">
		<p>New Password</p>
		<input type="password" name="new1_password" id="new1_password">
		<p>New Password Again</p>
		<input type="password" name="new2_password" id="new2_password">
		<p></p>
		<input class = "abutton" style = "width: 100px;"type="submit" value="OK" onclick="edit_password_submit()">
	</form>
</body>
</html>