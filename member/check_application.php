<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`member_application` WHERE `company_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['company_id']));
$result = $sth->fetchAllObject();
echo json_encode($result);
?>