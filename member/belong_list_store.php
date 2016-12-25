<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`store` a JOIN `jangsc27_cs_project`.`contract` b ON a.`id` = b.`store_id` AND b.`company_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['id']));
echo '<table>';
while($result=$sth->fetchObject()){?>
	<tr><td><?echo $result->name?></td>
	<td><a href="#" class="big-link" data-reveal-id="store_info" onclick="show_belong_store_content(<?echo $result->store_id?>,'belong_map')">Info</a></td>
	</tr>
<?}
echo '</table>';
?>