<?php
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`company` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['company_id']));
$result = $sth->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`store` a JOIN `jangsc27_cs_project`.`contract` b ON a.`id` = b.`store_id` AND b.`company_id` = ?";
$sth1 = $db->prepare($sql);
$sth1->execute(array($_GET['company_id']));

$sql = "SELECT * FROM `jangsc27_cs_project`.`company_image` WHERE `company_id`= ?";
$sth2 = $db->prepare($sql);
$sth2->execute(array($_GET['company_id']));
$result_img = $sth2->fetchObject();



$situation = 0;#new
$sql = "SELECT * FROM `jangsc27_cs_project`.`member_application` WHERE `member_id`= ? AND `company_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_GET['company_id']));
if($sth->fetchObject())
	$situation= 1;#applied
$sql = "SELECT * FROM `jangsc27_cs_project`.`member_belong` WHERE `member_id`= ? AND `company_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_GET['company_id']));
if($sth->fetchObject())
	$situation= 2;#belong
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<style>

</style>
	</head>	
		<?php
		if($result) 
		{?>
			<p>���q�W <?echo $result->name?></p>
			<?if($result_img){?>
			<img id="company_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
			<?}?>
			<p>�q�� <?echo $result->phone?></p>
			<p>�a�} <?echo $result->address?></p>
			<p>���� <?echo $result->url?></p>
			<p>�X�@���a <?
				while($result_store = $sth1->fetchObject()){
					echo $result_store->name.'</p><p>';
				}?>
			</p>
		<?}?>
	<input type="button" class="abutton" style="width:auto;" value="edit" onclick="owner_company_edit(<?echo $_GET['company_id']?>)">
	<input type="button" class="abutton" style="width:auto;" value="��^" onclick="back_to_company_list()">

</html>
