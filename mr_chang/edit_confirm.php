<?php
require_once "sysconfig.php";
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}

$edit_id=$_POST['edit_id'];
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$working=$_POST['working'];
$education=$_POST['education'];
$experience=$_POST['experience'];
$salary=$_POST['salary'];
if(!is_numeric($salary))
	echo '<script>alert("Please type salary in number !!");history.back();</script>';
else if($salary=='')
	echo '<script>alert("Please type salary !!");history.back();</script>';
else{

$sql = "UPDATE `jangsc27_cs`.`recruit` SET `occupation_id` = ?,`location_id` = ?,`working_time` = ?,`education` = ?,`experience` = ?,`salary` = ? WHERE `recruit`.`id` = ?";
$sth = $db->prepare($sql);
$sth->bindParam(6,$salary,PDO::PARAM_INT);
$sth->execute(array($occupation,$location,$working,$education,$experience,$salary,$edit_id));
unset($_SESSION['edit']);
header('Location:employer.php');
}
?>
