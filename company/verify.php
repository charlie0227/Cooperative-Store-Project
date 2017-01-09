<?php
require_once "../sysconfig.php";
$member=$_SESSION["id"];
$store=$_POST["company_id"];
$data = new stdClass();
if($member){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member_company` WHERE member_id=? AND company_id=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($member,$store));
	$result=$sth->fetchObject();
	if($result){
		$data->p="already";
	}
	else{
		$sql = "INSERT INTO `jangsc27_cs_project`.`member_company` (`member_id`,`company_id`)". " VALUES(?,?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($member,$store));
		$data->p="ok";

		$sql = "INSERT INTO `jangsc27_cs_project`.`member_belong` (`member_id`,`company_id`)". " VALUES(?,?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($member,$store));
	}

}
else
	$data->p="login";
echo json_encode($data);
?>
