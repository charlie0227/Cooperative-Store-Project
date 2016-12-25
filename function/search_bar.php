<?
require_once "../sysconfig.php";
$sql = "
SELECT 0 as type,a.id as id,a.name as name,a.address as address,b.image_url as image_url
FROM `jangsc27_cs_project`.`store` a  
JOIN `jangsc27_cs_project`.`store_image` b
ON a.`id`=b.`store_id`
UNION 
SELECT 1 as type,a.id as id,a.name as name,a.address as address,b.image_url as image_url 
FROM `jangsc27_cs_project`.`company` a  
JOIN `jangsc27_cs_project`.`company_image` b
ON a.`id`=b.`company_id`";
$sth = $db->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();
echo json_encode($result);
?>