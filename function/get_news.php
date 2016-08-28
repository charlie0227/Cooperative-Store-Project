<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`news` LIMIT ?,?";
$sth = $db->prepare($sql);
$sth->bindValue(1, (int) $_POST['first'],PDO::PARAM_INT); 
$sth->bindValue(2, (int) $_POST['num'],PDO::PARAM_INT); 
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
?>
