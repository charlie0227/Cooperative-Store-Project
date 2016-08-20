<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`member_store` a JOIN `jangsc27_cs_project`.`store` b ON a.`store_id` = b.`id` AND a.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<p>要使用哪一家商店簽約</p><table>';
while($result=$sth->fetchObject()){?>
	<tr>
	<td><input type="button" value="<?echo $result->name?>" onclick="contract_make(<?echo $result->store_id?>,<?echo $_GET['company_id']?>,'store');"/></td>
	</tr>
<?}
echo '</table>';
?>