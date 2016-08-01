<?php
require_once "sysconfig.php";
unset($_SESSION['way']);
function check_mamber($db,$account,$password,$phone,$email,$name,$gender){
	if($account=='' || $password=='' || $phone=='' || $email=='' ||$name=='' ||$gender==''){
		//echo '<h1>Vacant Input</h1>';
		return false;
	}
	if(strstr($account,' ') || strstr($password,' ') || strstr($phone,' ') || strstr($email,' ') ){
		echo '<h1>Contain whitespace</h1>';
		return false;
	}
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member`"." WHERE `account` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($account));
	$result = $sth->fetchObject();
	if($result){
		//echo '<h1>Reapeat Account</h1>';
		return false;
	}
	else
		return true;
}

function hash_password($password){
	return crypt($password,'$1$eSlWcNyAr');
}

$account=$_POST['account'];
$password=hash_password($_POST['password']);
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
		$sql = "INSERT INTO `jangsc27_cs_project`.`member` (account,password,phone,email,name,gender,birth)". " VALUES(?,?,?,?,?,?,?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($account,$password,$phone,$email,$name,$gender,$ddd));
		//echo '<h1>Create Successed!!</h1>';
	}
	//else
		//echo '<h1>Create Failed!!</h1>';
	
	
	

header("Location:index.php" )

?>
