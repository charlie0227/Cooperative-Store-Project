<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`member_company` a JOIN `jangsc27_cs_project`.`company` b ON a.`company_id` = b.`id` AND a.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<p>要使用哪一家企業簽約</p><table>';
while($result=$sth->fetchObject()){?>
	<tr>
	<td><input type="button" value="<?echo $result->name?>" onclick="contract_make(<?echo $_GET['store_id']?>,<?echo $result->company_id?>,'company');"/></td>
	</tr>
<?}
echo '</table>';
?>