<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`member_company` b ON a.`id` = b.`company_id` AND b.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<table><th style="font-size:25px;">Your company</th><th><input type="button" class="member_option"  style="background:#E78F8E; width: auto;" value="新增企業" onclick="owner_create_company()"></th>';
while($result=$sth->fetchObject()){?>
	<tr><td style="width: 200px; border-bottom: 1px solid #6E8898;"><?echo $result->name?></td>
	<td><input class="member_option" style="width: auto; background: #E78F8E;"type="button" value="管理" onclick="show_own_company_content(<?echo $result->company_id?>)"></td>
		<td><a data-notifications="張順成該該叫" href="#" class="big-link" data-reveal-id="show_box"><input class="member_option" style="width: auto; background: #E78F8E;"type="button" value="合約列表_______" onclick="show_contract(<?echo $result->company_id?>,1)"></a></td>
</tr>
<?}
echo '</table>';	
?>