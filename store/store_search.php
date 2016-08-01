<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`store` ";
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
echo '<table class = "bordered">
		<thead>
			<tr>
			<th style = "width: 240px;">NAME</th>
			<th style = "width: 360px;">PHONE</th>
			<th style = "width: 480px;">ADDRESS</th>
			</tr>
		</thead>
		<tbody>
		';?>
<?while($result = $sth->fetchObject()){?>
	<tr onclick="view_store(<?echo $result->id?>)"><td><?echo $result->name?></td><td><?echo $result->phone?></td><td><?echo $result->address?></td></tr>
<?}?> 
	</tbody>
</table>