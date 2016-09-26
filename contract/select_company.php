<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`member_company` a JOIN `jangsc27_cs_project`.`company` b ON a.`company_id` = b.`id` AND a.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));



echo '<p>要使用哪一家企業簽約</p><table class="bordered">';
while($result=$sth->fetchObject()){?>
	<?
	$sql = "SELECT * FROM `jangsc27_cs_project`.`company_image` WHERE `company_id`= ?";
	$sth2 = $db->prepare($sql);
	$sth2->execute(array($result->company_id));
	$result_img = $sth2->fetchObject();
	?>
	<tr onclick="contract_application(<?echo $_GET['store_id']?>,<?echo $result->company_id?>);">
	<td>
	<?if($result_img){?>
		<img style="width:100px; height:100px;" id="store_img" src="<?echo $result_img->image_url?>"/>
	<?}?>		
	</td>
	<td><?echo $result->name?></td>
	<td style="width:200px;"><?echo $result->address?></td>
	<!--<td><input type="button" value="<?echo $result->name?>" onclick="contract_make(<?echo $_GET['store_id']?>,<?echo $result->company_id?>,'company');"/></td>-->
	
	</tr>
<?}
echo '</table>';
?>