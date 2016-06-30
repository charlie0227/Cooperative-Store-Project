<?php
require_once "sysconfig.php";
unset($_SESSION['way']);
function check_employer($db,$account,$password,$phone,$email){
	if($account=='' || $password=='' || $phone=='' || $email==''){
		echo '<h1>Vacant Input</h1>';
		return false;
	}
	if(strstr($account,' ') || strstr($password,' ') || strstr($phone,' ') || strstr($email,' ')){
		echo '<h1>Contain whitespace</h1>';
		return false;
	}
	$sql = "SELECT * FROM `jangsc27_cs`.`employer`"." WHERE `account` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($account));
	$result = $sth->fetchObject();
	if($result){
		echo '<h1>Reapeat Account</h1>';
		return false;
	}
	else
		return true;
}
function check_jobseeker($db,$account,$password,$phone,$gender,$email,$salary){
	if($account=='' || $password=='' || $phone=='' || $gender=='' || $email=='' || $salary=='' || !is_numeric($salary)){
		echo '<h1>Vacant Input</h1>';
		return false;
	}
	if(strstr($account,' ') || strstr($password,' ') || strstr($phone,' ') || strstr($email,' ')){
		echo '<h1>Contain whitespace</h1>';
		return false;
	}
	$sql = "SELECT * FROM `jangsc27_cs`.`user`"." WHERE `account` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($account));
	$result = $sth->fetchObject();
	if($result){
		echo '<h1>Reapeat Account</h1>';
		return false;
	}
	else
		return true;
}
function hash_password($password){
	return crypt($password,'$1$eSlWcNyAr');
}
$who=$_POST['who'];
$account=$_POST['account'];
$password=hash_password($_POST['password']);
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$email=$_POST['email'];
$salary=$_POST['salary'];
$education=$_POST['education'];
if($who==0){	
	if( check_jobseeker($db,$account,$password,$phone,$gender,$email,$salary)){
		$sql = "INSERT INTO `jangsc27_cs`.`user` (account,password,phone,gender,age,email,salary,education)". " VALUES(?,?,?,?,?,?,?,?)";
		$sth = $db->prepare($sql);
		$sth->bindParam(5,$age,PDO::PARAM_INT);
		$sth->bindParam(7,$salary,PDO::PARAM_INT);
		$sth->execute(array($account,$password,$phone,$gender,$age,$email,$salary,$education));
		
		$sql3 = "INSERT INTO `jangsc27_cs`.`user_specialty` (user,specialty_id)". " VALUES(?,?)";
		$sth3 = $db->prepare($sql3);
		$sql2 = "SELECT * FROM `jangsc27_cs`.`specialty`";
		$sth2 = $db->prepare($sql2);
		$sth2->execute();
		while($result = $sth2->fetchObject()){
			if($_POST[$result->id])
				$sth3->execute(array($account,$result->id));
		}
		echo '<h1>Create Successed!!</h1>';
	}
	else
		echo '<h1>Create Failed!!</h1>';
}
if($who==1){
	if( check_employer($db,$account,$password,$phone,$email)){
		$sql = "INSERT INTO `jangsc27_cs`.`employer` (account,password,phone,email)". " VALUES(?,?,?,?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($account,$password,$phone,$email));
		echo '<h1>Create Successed!!</h1>';
	}
	else
		echo '<h1>Create Failed!!</h1>';
}
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<input type="image" src="image/back_to_index.png" onclick="location.href=('logout.php')">
</html>
