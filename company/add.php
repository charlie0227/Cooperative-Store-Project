<?php
require_once "../sysconfig.php";
$s_name=$_POST['name'];
$s_phone=$_POST['phone'];
$s_address=$_POST['address'];
$s_email=$_POST['email'];
$data = new stdClass();

function find_company_id($db,$name,$phone,$address,$email){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`company` where `name`=? and `phone`=? and `address`=? and `email`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$email));
	return $sth->fetchObject()->id;
}

if($s_name){
	//create new company
	$sql = "INSERT INTO `jangsc27_cs_project`.`company` (name,phone,address,email) VALUES(?,?,?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($s_name,$s_phone,$s_address,$s_email));
}

$company_id=find_company_id($db,$s_name,$s_phone,$s_address,$s_email);
echo $company_id;
//echo json_encode($data);
//header('Location:index.php');

?>