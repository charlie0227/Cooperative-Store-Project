<?php
require_once "sysconfig.php";
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
$_SESSION['edit']=$_POST['edit_id'];
header('Location:employer.php');
?>
