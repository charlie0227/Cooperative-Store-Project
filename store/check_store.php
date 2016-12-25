<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['store_id']));
$result = $sth->fetchObject();
$message = $result->address;

echo $message;
?>