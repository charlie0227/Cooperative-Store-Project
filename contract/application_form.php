<?php
require_once "../sysconfig.php";
?>
<html>
<head>
</head>
<meta charset="utf-8" />
<body>
<form style="display:inline;" action="contract/application_join.php" method="POST" id="contract_application_ajaxForm">
<h3>請填入想對店家說的話(期待的優惠)</h3></br>
<input type="hidden" name="store_id" value="<?echo $_GET['store_id']?>">
<input type="hidden" name="company_id" value="<?echo $_GET['company_id']?>">
<textarea name="content" id="company_content" style="width:90%;height:150%;"></textarea></br>
<input class = "abutton" style="width: auto;" type="button" value="返回" name="submit" onclick="select_company(<?echo $_GET['store_id']?>)">
<input class = "abutton" style="width: auto;" type="submit" value="送出" name="submit" onclick="contract_application_submit()">
</form>

</body>
	
</html>


