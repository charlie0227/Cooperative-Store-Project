<?php
require_once "../sysconfig.php";
if($_POST['type']==1){
	$sql = "INSERT INTO `jangsc27_cs_project`.`member_belong` (member_id,company_id) VALUES(?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($_POST['member_id'],$_POST['company_id']));
	echo "succ";
}
$sql = "DELETE FROM `jangsc27_cs_project`.`member_application` WHERE `member_id`= ? AND `company_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['member_id'],$_POST['company_id']));
?>