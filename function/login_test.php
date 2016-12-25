<?php
require_once "../sysconfig.php";
$data = new stdClass();
function hash_password($password){
	return crypt($password,'$1$eSlWcNyAr');
}
$name=$_POST['username'];
if(isset($_POST['password']))
	$pass=hash_password($_POST['password']);
else if($_POST['type']=='facebook')
	$pass=hash_password($_POST['username']);
$sql = "SELECT * FROM `jangsc27_cs_project`.`member`"." WHERE `account` = ? AND `password` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($name,$pass));
$result = $sth->fetchObject();
if($result){
	$_SESSION['name']=$result->name;
	$_SESSION['account']=$result->account;
	$_SESSION['id']=$result->id;
	$data->id=$result->id;
	$data->message="Hello ".$result->name." Welcome !!";
	$r_message = "Successful";
	write_log('Login Success','id: '.$result->id.' account: '.$result->account.' name: '.$result->name);
}
else{
	$data->message="Wrong Account or password !!";
	write_log('Login Failed','');
	$r_message = "Failed";
}
echo $r_message;
?>

