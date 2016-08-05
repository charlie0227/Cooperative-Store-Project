<?
require_once "sysconfig.php";
$sql = "SELECT 0 as type,id ,name , address 
FROM `jangsc27_cs_project`.`store`  
UNION 
SELECT 1 as type,id ,name , address 
FROM `jangsc27_cs_project`.`company`";
$sth = $db->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();
echo json_encode($result);
?>