<?php
require_once "../sysconfig.php";
$data=new stdClass();
$sql = "DELETE FROM `jangsc27_cs_project`.`member_store` WHERE `member_id`= ? AND `store_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_POST['store_id']));
$result = $sth->fetchObject();
$data->q="ok";
echo json_encode($data);
?>