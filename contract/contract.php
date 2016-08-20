<?php
require_once "../sysconfig.php";
$data=new stdClass();

$who=$_POST['who'];
$store_id=$_POST['store_id'];
$company_id=$_POST['company_id'];
if(isset($_POST['store_id'])){
	$sql = "SELECT b.name as company_owner, c.name as company_name, c.phone as company_phone, c.address as company_address
	FROM `jangsc27_cs_project`.`member_company` a 
	JOIN  `jangsc27_cs_project`.`member` b 
	JOIN  `jangsc27_cs_project`.`company` c 
	ON a.`member_id`=b.`id` 
	AND a.`company_id`=c.`id`
	AND a.`company_id`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($company_id));
	$result_company = $sth->fetchObject();
}
if(isset($_POST['company_id'])){
	$sql = "SELECT b.name as store_owner, c.name as store_name, c.phone as store_phone, c.address as store_address
	FROM `jangsc27_cs_project`.`member_store` a 
	JOIN  `jangsc27_cs_project`.`member` b 
	JOIN  `jangsc27_cs_project`.`store` c 
	ON a.`member_id`=b.`id` 
	AND a.`store_id`=c.`id`
	AND a.`store_id`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id));
	$result_store = $sth->fetchObject();
}
$data->who=$who;
$data->company_owner=$result_company->company_owner;
$data->company_name=$result_company->company_name;
$data->company_phone=$result_company->company_phone;
$data->company_address=$result_company->company_address;

$data->store_owner=$result_store->store_owner;
$data->store_name=$result_store->store_name;
$data->store_phone=$result_store->store_phone;
$data->store_address=$result_store->store_address;
echo json_encode($data);
?>
