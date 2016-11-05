<?php
require_once "../sysconfig.php";
$s_name=$_POST['name'];
$s_phone=$_POST['phone'];
$s_address=$_POST['address'];
$s_url=isset($_POST['url'])?$_POST['url']:"";
$data = new stdClass();
function check_sotre($db,$name,$phone,$address,$url){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `name`=? and `phone`=? and `address`=? and `url`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$url));
	if($sth->fetch())
		return true;
	else
		return false;
}


if(!check_sotre($db,$s_name,$s_phone,$s_address,$s_url)){
	//create new store
	$sql = "INSERT INTO `jangsc27_cs_project`.`store` (name,phone,address,url) VALUES(?,?,?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($s_name,$s_phone,$s_address,$s_url));
}


echo json_encode($data);
//header('Location:index.php');

?>