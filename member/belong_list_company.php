<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`member_belong` b ON a.`id` = b.`company_id` AND b.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<table>';
echo '<H2>所屬的團體</H2>';
while($result=$sth->fetchObject()){?>
<tr>
	<td><input class="k-button" type="button" onclick="show_belong_company_discount(<?echo $result->id?>)" value="<?echo $result->name?>"></td>
</tr>
	<?}

echo '</table>';
?>