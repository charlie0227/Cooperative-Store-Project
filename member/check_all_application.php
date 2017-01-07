<?
require_once "../sysconfig.php";
$sql = "SELECT d.name as name, b.content as content, b.member_id as member_id, b.company_id as company_id, c.name as company_name
FROM `jangsc27_cs_project`.`member_company` a
JOIN `jangsc27_cs_project`.`member_application` b
JOIN `jangsc27_cs_project`.`company` c
JOIN `jangsc27_cs_project`.`member` d
ON a.company_id = b.company_id and b.company_id = c.id and b.member_id = d.id and a.member_id = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));

echo '<p>這些人想加入您的團體</p>';
echo '<table>';
while($result=$sth->fetchObject()){?>
	<tr>
	<td>我是 : <?echo $result->name?></td>
	<td>因為 : <?echo $result->content?> </td>
	<td>我想要加入 : <?echo $result->company_name?></td>
	<td><input type="button" value="確定" onclick="application_confirm(<?echo $result->member_id?>,<?echo $result->company_id?>,1)"/></td>
	<td><input type="button" value="現在還不要" onclick="application_confirm(<?echo $result->member_id?>,<?echo $result->company_id?>,0)"/></td>
	</tr>
<?}
echo '</table>';
?>

