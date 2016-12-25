<?php
require_once "../sysconfig.php";
function hash_password($password){
	return crypt($password,'$1$eSlWcNyAr');
}
$old_password=hash_password($_POST['old_password']);
$new1_password=$_POST['new1_password'];
$new2_password=$_POST['new2_password'];
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` where `member`.`id` = ?  and `member`.`password` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$old_password));
$data = new stdClass();
if($sth->fetchObject()){
	if($new1_password==$new2_password){
		if($new1_password=='' || strstr($new1_password,' ')){
			//echo '<script>alert("New password contain space!");history.go(-1);</script>';
			$data->result ="New password contain space!";
			$data->q=0;
		}
		else{
			$new1_password=hash_password($new1_password);
			$sql = "UPDATE `jangsc27_cs_project`.`member` SET `password` = ? WHERE `member`.`id` = ?";
			$sth = $db->prepare($sql);
			$sth->execute(array($new1_password,$_SESSION['id']));
			unset($_SESSION['account']);
			unset($_SESSION['name']);
			unset($_SESSION['id']);
			//echo '<script>alert("Edit Success!\nPlease login again!");location.href="member.php"; </script>';
			$data->result ="Edit Success!\nPlease login again!";
			$data->q=1;
		}
	}
	else{
		//echo '<script>alert("Please type same password!");history.go(-1);</script>';	
		$data->result ="Please type same password!";
		$data->q=0;		
	}
}
else{
	//echo '<script>alert("Wrong password!");history.go(-1);</script>';
	$data->result ="Wrong password!";		
	$data->q=0;
}
echo json_encode($data);
?>