<?php
require_once "../sysconfig.php";
$company_id=$_POST['company_id'];
$store_id=$_POST['store_id'];

if(isset($_POST['company_id'])){
	$sql = "SELECT a.id as contract_id,b.name as store_name FROM `jangsc27_cs_project`.`contract` a
		JOIN `jangsc27_cs_project`.`store` b
		ON a.store_id=b.id
		AND a.company_id = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($company_id));
	while($result=$sth->fetchObject()){
		?>
		<input type="button" class="k-button" value="<?echo $result->store_name?>" onclick="contract_manage(<?echo $result->contract_id?>,'company')"><br>
		
		<?
	}
}
if(isset($_POST['store_id'])){
	$sql = "SELECT a.id as contract_id,b.name as company_name FROM `jangsc27_cs_project`.`contract` a
		JOIN `jangsc27_cs_project`.`company` b
		ON a.company_id=b.id
		AND a.store_id = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id));
	while($result=$sth->fetchObject()){
		?>
		<input type="button" class="k-button" value="<?echo $result->company_name?>" onclick="contract_manage(<?echo $result->contract_id?>,'store')"><br>
		<?
	}
}
?>