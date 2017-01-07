<?php
require_once "../sysconfig.php";
$data=new stdClass();
$sql = "DELETE FROM `jangsc27_cs_project`.`member_belong` WHERE `member_id`= ? AND `company_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_POST['company_id']));
$result = $sth->fetchObject();
$data->back=$_POST['back'];
$data->company_id=$_POST['company_id'];
echo json_encode($data);
?>