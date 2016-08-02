<?php
require_once "sysconfig.php";
$data = new stdClass();
function check_mamber($db,$account,$password,$phone,$email,$name,$gender){
	if($phone=='' || $email=='' ||$name=='' ||$gender==''){
		$data->result = 'Vacant Input';
		return false;
	}
	if(strstr($phone,' ') || strstr($email,' ') || strstr($name,' ')){
		$data->result = 'Contain whitespace';
		return false;
	}
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member`"." WHERE `account` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($account));
	$result = $sth->fetchObject();
	if($result){
		$data->result = 'Reapeat Account';
		return false;
	}
	else
		return true;
}

$name=$_POST['name'];
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$year=$_POST['year'];
$month=$_POST['month'];
$date=$_POST['date'];
$email=$_POST['email'];
$ddd=$year.'-'.$month.'-'.$date;
if(check_mamber($db,$account,$password,$phone,$email,$name,$gender))
	{
		$sql = "UPDATE `jangsc27_cs_project`.`member` SET `name` = ?,`phone` = ?,`gender` = ?,`birth` = ?,`email` = ? WHERE `member`.`id` = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($name,$phone,$gender,$ddd,$email,$_SESSION['id']));
		$data->result = 'edit Successed!!';
	}
	else
		$data->result = 'edit Failed!!';
echo $data->result;
?>
