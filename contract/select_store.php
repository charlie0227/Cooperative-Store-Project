<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`member_store` a JOIN `jangsc27_cs_project`.`store` b ON a.`store_id` = b.`id` AND a.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<p>請問要使用哪一家商店簽約</p><table class="bordered">';
while($result=$sth->fetchObject()){?>
	<?
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store_image` WHERE `store_id`= ?";
	$sth2 = $db->prepare($sql);
	$sth2->execute(array($result->store_id));
	$result_img = $sth2->fetchObject();
	?>
	<tr onclick="contract_make(<?echo $result->store_id?>,<?echo $_GET['company_id']?>,'store');">
	<td>
	<?if($result_img){?>
		<img style="width:100px; height:100px;" id="store_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
	<?}?>		
	</td>
	<td><?echo $result->name?></td>
	<td style="width:200px;"><?echo $result->address?></td>
	<!--<td><input type="button" value="<?echo $result->name?>" onclick="contract_make(<?echo $_GET['store_id']?>,<?echo $result->company_id?>,'company');"/></td>-->
	
	</tr>

<?}
echo '</table>';
?>