<?
require_once "../sysconfig.php";
//$time = date("h:i:s");
date_default_timezone_set("Asia/Taipei");
$dt = new DateTime();
$time = $dt->format('Y-m-d H:i:s');
$sql = "INSERT INTO `jangsc27_cs_project`.`news` (`time`, `title`, `content`) VALUES (?, ?, ?)";
$sth = $db->prepare($sql);
$sth->execute(array($time,$_POST['title'],$_POST['content']));
echo $_POST['content'];
echo $time;
?>