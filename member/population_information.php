<?
require_once "../sysconfig.php";
$store_id=$_POST['store_id'];
$sql = "SELECT a.time,b.gender ,b.birth ,c.name
FROM `jangsc27_cs_project`.`population` a
JOIN  `jangsc27_cs_project`.`member` b
JOIN  `jangsc27_cs_project`.`company` c
ON a.member_id = b.id
AND a.company_id = c.id
AND a.store_id = ?";
$sth=$db->prepare($sql);
$sth->execute(array($store_id));
$result=$sth->fetchAll();
echo json_encode($result);
?>