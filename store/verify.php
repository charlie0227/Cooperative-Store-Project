<?php
require_once "../sysconfig.php";
$member=$_SESSION["id"];
$store=$_POST["store_id"];
$data = new stdClass();
if($member){
	$sql = "INSERT INTO `jangsc27_cs_project`.`member_store` (`member_id`,`store_id`)". " VALUES(?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($member,$store));
	$data->p="ok";
}
else
	$data->p="login";
echo json_encode($data);
?>



