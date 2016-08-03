<?php
require_once "sysconfig.php";
$sql = "DELETE FROM `favorite` WHERE `recruit_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['recruit_id']));

$sql = "DELETE FROM `application` WHERE `recruit_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['recruit_id']));

$sql = "DELETE FROM `recruit` WHERE `recruit`.`id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['recruit_id']));
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
