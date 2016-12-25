<?php
require_once "../sysconfig.php";
?>
<html>
<head>
</head>
<meta charset="utf-8" />
<body>
<form style="display:inline;" action="company/application_join.php" method="POST" id="application_ajaxForm">
<h3>Fill reason why you want to join</h3></br>
<input type="hidden" name="member_id" value="<?echo $_GET['member_id']?>">
<input type="hidden" name="company_id" value="<?echo $_GET['company_id']?>">
<textarea name="content" id="company_content" style="width:90%;height:150%;"></textarea></br>
<input class = "abutton" style="width: auto;" type="submit" value="Submit" name="submit" onclick="application_submit()">
</form>

</body>
	
</html>


