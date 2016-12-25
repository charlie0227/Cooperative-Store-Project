<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`news`"." WHERE `id` = ? ";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['news_id']));
$result=$sth->fetchObject();
?>
<h2><? echo $result->title?></h2>
<h3><? echo $result->time?></h3>
<p>
<?echo $result->content?>
</p>
