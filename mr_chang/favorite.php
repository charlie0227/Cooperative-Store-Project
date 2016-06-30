<?php
require_once "sysconfig.php";
if($_POST['way']=='add'){
	$sql = "INSERT INTO `jangsc27_cs`.`favorite` (user_id,recruit_id) VALUES(?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($_POST['jobseeker_id'],$_POST['recruit_id']));
}
else{
	$sql = "DELETE FROM `jangsc27_cs`.`favorite` WHERE `user_id`=? AND `recruit_id`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($_POST['jobseeker_id'],$_POST['recruit_id']));  
}
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
