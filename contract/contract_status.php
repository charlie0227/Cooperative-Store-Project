<?
require_once "../sysconfig.php";
if($_POST['type']==0){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `store_id` = ? AND `status` = 0";
}
else{
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `company_id` = ? AND `status` = 0";
}
$sth = $db->prepare($sql);
$sth->execute(array($_POST['id']));
?>