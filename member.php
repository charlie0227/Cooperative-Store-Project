<?php
require_once "sysconfig.php";
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<body>
<?if($_SESSION['name']){?>
		Hello  <?echo $_SESSION['name']?>  
		<input type="button" value="logout" onclick="location.href='logout.php';"><br>
		<input type="button" value="add your new store" onclick="location.href='create_store.php'"><br>
		<input type="button" value="manage your store" ><br>
		<input type="button" value="manage your contract" ><br>
		<input type="button" value="edit your personal information" onclick="location.href=('edit_personal_information.php')"><br>
		<input type="button" value="edit your password" onclick="location.href=('edit_password.php')"><br>
		
	<?}else{?>
		<p><-----------</p>
		<p>Please Login first</p>
	<?}?>
</body>
</html>