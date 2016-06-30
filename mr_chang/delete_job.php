<?php
require_once "sysconfig.php";
unset($_SESSION['edit']);
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
$sql = "DELETE FROM `favorite` WHERE `recruit_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['delete_id']));

$sql = "DELETE FROM `application` WHERE `recruit_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['delete_id']));

$sql = "DELETE FROM `recruit` WHERE `id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['delete_id']));
header('Location:employer.php');
?>
