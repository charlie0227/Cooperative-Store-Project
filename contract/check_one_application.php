<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` a
JOIN `jangsc27_cs_project`.`contract_application` b
JOIN `jangsc27_cs_project`.`member_store` c
ON a.id = b.member_id and b.company_id = c.company_id and c.member_id = ? and c.company_id = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_GET['store_id']));

?>
