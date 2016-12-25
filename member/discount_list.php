<?
require_once "../sysconfig.php";
if($_SESSION['id']==''){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member`"." WHERE `name` = ?";
	$sth2 = $db->prepare($sql);
	$sth2->execute(array($_SESSION['name']));
	$result2 = $sth2->fetchObject();
	$_SESSION['account']=$result2->account;
	$_SESSION['id']=$result2->id;
}


$order=isset($_POST['q'])?" ORDER BY ".$_POST['q']:"";
$sql = "SELECT b.name as company_name, b.id as company_id, c.name as store_name, c.id as store_id, d.content as content ,
(  SELECT COUNT(e.id) 
   FROM`jangsc27_cs_project`.`population` e
   WHERE e.company_id = b.id 
   AND e.store_id = c.id ) as num
FROM `jangsc27_cs_project`.`member_belong` a
JOIN `jangsc27_cs_project`.`company` b
JOIN `jangsc27_cs_project`.`store` c
JOIN `jangsc27_cs_project`.`contract` d
ON a.member_id = ?
AND a.company_id = b.id
AND b.id = d.company_id
AND d.store_id = c.id".$order;
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
//,$_POST['store_id']
$result = $sth->fetchAll();
echo json_encode($result);
?>