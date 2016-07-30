<?php
require_once "sysconfig.php";
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<h1 style="text-align:left;color:#fff355;">Hello <?php echo $_SESSION['admin'];?>  </h1>
<input style="float:left;" type="image" src="image/log_out.png" onclick="location.href='logout.php';"><br>
<?php
include("job.php");
?>
</br>
<input type="image" src="image/my_favorite_list.png" onclick="location.href='favorite_list.php';">
</html>
