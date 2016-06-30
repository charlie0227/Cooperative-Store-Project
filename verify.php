<?php
require_once "sysconfig.php";
$member=$_POST["member_id"];
$store=$_POST["store_id"];
$sql = "INSERT INTO `jangsc27_cs_project`.`member_store` (`member_id`,`store_id`)". " VALUES(?,?)";
$sth = $db->prepare($sql);
$sth->execute(array($member,$store));
?>



