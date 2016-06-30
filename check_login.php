<?php
require_once "sysconfig.php";
unset($_SESSION['way']);
$data = new stdClass();
function hash_password($password){
	return crypt($password,'$1$eSlWcNyAr');
}
$name=$_POST['username'];
$pass=hash_password($_POST['password']);
$sql = "SELECT * FROM `jangsc27_cs_project`.`member`"." WHERE `account` = ? AND `password` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($name,$pass));
$result = $sth->fetchObject();
if($result){
	$_SESSION['name']=$result->name;
	$_SESSION['account']=$result->account;
	$_SESSION['id']=$result->id;
	
	$data->message="Hello ".$result->name." Welcome !!";
}
else
	$data->message="Wrong Account or password !!";
echo json_encode($data);
?>

