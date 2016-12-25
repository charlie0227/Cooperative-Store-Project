<?
require_once "../sysconfig.php";
$sql = "INSERT INTO `jangsc27_cs_project`.`member_application` (`member_id`, `company_id`, `content`) VALUES (?, ?, ?)";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['member_id'],$_POST['company_id'],$_POST['content']));
echo $_POST['company_id'];
?>