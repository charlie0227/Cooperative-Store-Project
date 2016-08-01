<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` ";
if($_GET['word']){
	$sql=$sql."WHERE ";
	if($_GET['q']=="name")
		$sql=$sql."`name` LIKE '%".$_GET['word']."%'";
	if($_GET['q']=="phone")
		$sql=$sql."`phone` LIKE '%".$_GET['word']."%'";
	if($_GET['q']=="address")
		$sql=$sql."`address` LIKE '%".$_GET['word']."%'";
}
$sth = $db->prepare($sql);
$sth->execute();
echo '<table>
		<thead>
			<tr>
			<th>店名</th>
			<th>電話</th>
			<th>地址</th>
			</tr>
		</thead>
		<tbody>
		';?>
<?while($result = $sth->fetchObject()){?>
	<tr><td><a onclick="view_company(<?echo $result->id?>)" ><?echo $result->name?></a></td><td><?echo $result->phone?></td><td><?echo $result->address?></td></tr>
<?}?> 
	</tbody>
</table>