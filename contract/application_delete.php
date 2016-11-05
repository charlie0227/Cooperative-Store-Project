<?php
require_once "../sysconfig.php";
$sql = "DELETE FROM `jangsc27_cs_project`.`contract_application` WHERE `store_id`= ? AND `company_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['store_id'],$_POST['company_id']));
?>