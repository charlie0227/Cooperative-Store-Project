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
	
	$situation = 0;#new
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract_application` WHERE `company_id`= ? AND `store_id`= ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($result->company_id,$_GET['store_id']));
	if($sth->fetchObject())
	$situation= 1;#applied
	
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `member_id`= ? AND `company_id`= ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($_SESSION['id'],$result->company_id));
	if($result_con=$sth->fetchObject() && $result->status==1)
	$situation= 2;#belong

	
	?>
	<tr>
	<td>
	<?if($result_img){?>
		<img style="width:100px; height:100px;" id="store_img" src="<?echo $result_img->image_url?>"/>
	<?}?>		
	</td>
	<td><?echo $result->name?></td>
	<td style="width:200px;"><?echo $result->address?></td>
	<td>
	<?
	if($_SESSION['id']){
		if($situation==0){?>
			<input type="button" class="k-button" style="width:auto;" value="我想簽約" onclick="contract_application(<?echo $_GET['store_id']?>,<?echo $result->company_id?>);"/>
		<?}if($situation==1){?>
			<input type="button" class="k-button" style="width:auto;" value="已送出邀請(再次點擊取消邀請)" onclick="delete_contract_application(<?echo $result->company_id?>,<?echo $_GET['store_id']?>)"/>
		<?}if($situation==2){?>
			<input type="button" class="k-button" style="width:auto;" value="查看合約" onclick="">
		<?}?>
	<?}?>
	</td>
	<!--<td><input type="button" value="<?echo $result->name?>" onclick="contract_make(<?echo $_GET['store_id']?>,<?echo $result->company_id?>,'company');"/></td>-->
	
	</tr>
<?}
echo '</table>';
?>