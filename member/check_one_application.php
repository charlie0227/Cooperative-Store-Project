<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` a 
JOIN `jangsc27_cs_project`.`member_application` b 
JOIN `jangsc27_cs_project`.`member_company` c
ON a.id = b.member_id and b.company_id = c.company_id and c.member_id = ? and c.company_id = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_GET['company_id']));


echo '<table>';
while($result=$sth->fetchObject()){?>
	<tr>
	<td>我是 : <?echo $result->name?></td>
	<td>因為 : <?echo $result->content?> </td>
	<td>我想要加入</td>
	<td><input type="button" value="確定" onclick="application_confirm(<?echo $result->id?>,<?echo $_GET['company_id']?>,1)"/></td>
	<td><input type="button" value="現在還不要" onclick="application_confirm(<?echo $result->id?>,<?echo $_GET['company_id']?>,0)"/></td>
	</tr>
<?}
echo '</table>';
?>

