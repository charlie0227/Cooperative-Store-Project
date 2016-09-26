<?
require_once "../sysconfig.php";
$sql = "INSERT INTO `jangsc27_cs_project`.`contract_application` (`store_id`, `company_id`, `content`) VALUES (?, ?, ?)";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['store_id'],$_POST['company_id'],$_POST['content']));
echo $_POST['store_id'];
?>