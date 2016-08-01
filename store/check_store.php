<?
require_once "../sysconfig.php";
$sql = "SELECT name FROM `jangsc27_cs_project`.`store` ";
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
echo json_encode($result);
?>