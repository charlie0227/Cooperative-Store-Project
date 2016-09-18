<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`store` a JOIN `jangsc27_cs_project`.`member_store` b ON a.`id` = b.`store_id` AND b.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
//echo '<h2 style="width:100%;">擁有店家/企業管理</h2>';
echo '<table><th style="font-size:25px;">Your store</th><th><input type="button" class="member_option" style="background:#E78F8E; width: auto;" value="新增店家" onclick="owner_create_store()"></th>';
while($result=$sth->fetchObject()){?>
	<tr>
	<td style="width: 200px; border-bottom: 1px solid #6E8898;"><?echo $result->name?></td>
	<td><input class="member_option" style="width: auto; background: #E78F8E;"type="button" value="管理" onclick="show_own_store_content(<?echo $result->store_id?>,<?echo "'owner_map'"?>)"></td>
	<td><a href="#" class="big-link" data-reveal-id="show_box"><input class="member_option" style="width: auto; background: #E78F8E;"type="button" value="合約列表" onclick="show_contract(<?echo $result->store_id?>,0)"></a></td>
	</tr>
<?}
echo '</table>';
?>