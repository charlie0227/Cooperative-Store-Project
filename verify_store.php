

<!DOCTYPE HTML>

<html>
<head>
	<script src="jquery-1.12.4.min.js"></script>
	<script src="contract.js"></script>
	<script src="store.js"></script>
	<script src="account.js"></script>
</head>
<meta charset="utf-8" />
	Is your store?
	<input class = "abutton" style = "width: 100px;"type="button" onclick="check_verify(<?echo $_GET["member_id"]?>,<?echo $_GET["store_id"]?>,<?echo $_GET['gtype']?>)" value="Yes">
	<button class = "abutton" style = "width: 100px;" type="button" onclick="back(2)">Back</button>

	
	


</html>
