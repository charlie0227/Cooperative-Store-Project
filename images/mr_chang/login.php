<?php
require_once "sysconfig.php";
unset($_SESSION['way']);
	function hash_password($password){
		return crypt($password,'$1$eSlWcNyAr');
	}
$name=$_POST['username'];
$pass=hash_password($_POST['password']);
$who=$_POST['who'];
	
	if($who==0){
		$sql = "SELECT * FROM `jangsc27_cs`.`employer`"." WHERE `account` = ? AND `password` = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($name,$pass));
		$result = $sth->fetchObject();
		if($result){
			$_SESSION['admin']=$result->account;
			$_SESSION['authority']='employer';
			header('Location: employer.php');
		}
		else{
			echo '<p style="font-size:50px;">Wrong account & password</p>';
		}
	}
	if($who==1){
		$sql = "SELECT * FROM `jangsc27_cs`.`user`"." WHERE `account` = ? AND `password` = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($name,$pass));
		$result = $sth->fetchObject();
		if($result){
			$_SESSION['admin']=$result->account;
			$_SESSION['authority']='jobseeker';
			header('Location: jobseeker.php');
		}
		else{
			$sql = "SELECT * FROM `jangsc27_cs`.`employer`"." WHERE `account` = ? AND `password` = ?";
			$sth = $db->prepare($sql);
			$sth->execute(array($name,$pass));
			$result = $sth->fetchObject();
			if($result){
				$_SESSION['admin']=$result->account;
				$_SESSION['authority']='employer';
				header('Location: jobseeker.php');
			}
			else
				echo '<p style="font-size:50px;">Wrong account & password</p>';
		}
	}
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<input type="image" src="image/back_to_index.png" onclick="location.href=('index.php')">
</html>
