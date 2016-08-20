<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`news` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['news_id']));
$result = $sth->fetchObject();
$content = $result->content;
if(!$result){
	echo "False";
}
else{
	echo $content;
}


?>