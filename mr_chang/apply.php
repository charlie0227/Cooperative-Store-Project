<?php
require_once "sysconfig.php";
$sql = "INSERT INTO `jangsc27_cs`.`application` (user_id,recruit_id) VALUES(?,?)";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['jobseeker_id'],$_POST['recruit_id']));
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
