<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`member_belong` b ON a.`id` = b.`company_id` AND b.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<table>';
while($result=$sth->fetchObject()){?>
	<tr onclick="show_belong_store(<?echo $result->id?>)"><td><?echo $result->name?></td></tr>
<?}
echo '</table>';
?>