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
			<th style = "width: 200px;">名稱</th>
			<th style = "width: 200px;">電話</th>
			<th style = "width: 500px;">地址</th>
			<th style = "width: 50px;">負責人</th>
			</tr>
		</thead>
		</table>
		
		<div id = "list"><table class="bordered">
		<tbody>
		';?>
<?while($result = $sth->fetchObject()){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member_store` WHERE `store_id` = ?";
	$r_sth = $db->prepare($sql);
	$r_sth->execute(array($result->id));
	?>
	<tr onclick="view_store(<?echo $result->id?>,'store_map')"><td style = "width: 200px;"><?echo $result->name?></td><td style = "width: 200px;"><?echo $result->phone?></td><td style = "width: 500px;"><?echo $result->address?></td><td><?while($r_result=$r_sth->fetchObject()){ echo $r_result->member_id.'<img src="images/star.png" style="width:30px;height:30px;">'; }?></td></tr>
<?}?> 
	</tbody>
</table></div>