<html>
<body>
<form action="member/edit_pass_ok.php" method="POST" id="edit_pass_ajaxForm">
		<p>Original Password</p>
		<input class="k-textbox" style="margin: 0 5px 5px 0;" type="password" name="old_password" id="old_password">
		<p>New Password</p>
		<input class="k-textbox" style="margin: 0 5px 5px 0;" type="password" name="new1_password" id="new1_password">
		<p>New Password Again</p>
		<input class="k-textbox" style="margin: 0 5px 5px 0;" type="password" name="new2_password" id="new2_password">
		<p></p>
		<input class = "k-button" style = "width: 100px;"type="submit" value="OK" onclick="edit_pass_submit()">
	</form>
</body>
</html>