<?php
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`store` a JOIN `jangsc27_cs_project`.`contract` b ON a.`id` = b.`store_id` AND b.`company_id` = ?";
$sth1 = $db->prepare($sql);
$sth1->execute(array($_GET['company_id']));

echo '<p><H2>合作店家</H2><br>';
	while($result_store = $sth1->fetchObject()){
		echo $result_store->name.'</p><p>';
	}
?>
