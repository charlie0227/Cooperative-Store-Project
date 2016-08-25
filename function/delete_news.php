<?php
require_once "../sysconfig.php";
$sql = "DELETE FROM `jangsc27_cs_project`.`news` WHERE `id`= ? ";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['news_id']));
echo "Delete";
echo $_POST['news_id'];
?>