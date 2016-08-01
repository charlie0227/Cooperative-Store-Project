<?php
require_once "sysconfig.php";
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
unset($_SESSION['edit']);
header('Location:employer.php');
?>