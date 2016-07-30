<?php
require_once "sysconfig.php";
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
$sql = "SELECT * FROM `jangsc27_cs`.`employer` WHERE `account`=?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['admin']));
$employer_id=$sth->fetchObject()->id;
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$working=$_POST['working'];
$education=$_POST['education'];
$experience=$_POST['experience'];
$salary=$_POST['salary'];
if(!is_numeric($salary) )
	echo '<script>alert("Please type salary in number !!");history.back();</script>';
else{
$sql = "INSERT INTO `jangsc27_cs`.`recruit` (employer_id,occupation_id,location_id,working_time,education,experience,salary)". " VALUES(?,?,?,?,?,?,?)";
$sth = $db->prepare($sql);
$sth->bindParam(7,$salary,PDO::PARAM_INT);
$sth->execute(array($employer_id,$occupation,$location,$working,$education,$experience,$salary));
header('Location:employer.php');
}
?>
