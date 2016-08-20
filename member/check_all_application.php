<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` a 
JOIN `jangsc27_cs_project`.`member_application` b 
JOIN `jangsc27_cs_project`.`member_company` c
ON a.id = b.member_id and b.company_id = c.company_id and c.member_id = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['member_id']));

$result = $sth->fetchAll();
echo json_encode($result);
?>