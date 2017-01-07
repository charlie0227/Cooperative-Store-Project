<?php
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['store_id']));
$result = $sth->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`contract` b ON a.`id` = b.`company_id` AND b.`store_id` = ?";
$sth1 = $db->prepare($sql);
$sth1->execute(array($_GET['store_id']));

$sql = "SELECT * FROM `jangsc27_cs_project`.`store_image` WHERE `store_id`= ?";
$sth2 = $db->prepare($sql);
$sth2->execute(array($_GET['store_id']));
$result_img = $sth2->fetchObject();

$_SESSION['name']=$_POST['username'];
?>	

<html>
<head>
<script src="../js/jquery.min.js"></script>
<style>
.mobileShow { display: none;}
@media only screen
and (min-device-width : 320px)
and (max-device-width : 480px){ .mobileShow { display: inline;}}
</style>
</head>	
		<?php
		if($result) 
		{?>
			<p>店名 <?echo $result->name?></p>
			<?if($result_img){?>
			<img id="store_img" onclick=" var newwin = window.open();newwin.location='https://www.charlie27.me/~xu3u4tp6/<?echo $result_img->image_url?>';" src="../<?echo $result_img->image_url?>"/>
			<?}?>
			<p>電話 <?echo $result->phone?></p>
			<p>地址 <?echo $result->address?></p>
			<div id="store_map" ></div>
			<p>網站 <?echo $result->url?></p>
			<p>合作企業 <?
				while($result_company = $sth1->fetchObject()){
					echo '<p>'.$result_company->name.'</p>';
				}?>
			</p>
		<?}?>
		<?$sth="../qrcode.php?store_id=".$result->id;?>
	<input type="button" class="abutton" style="width:auto;" value="點擊查看享有優惠項目" onclick="window.location = '<?echo $sth?>';">
	<p><?echo $_POST['username'];?></p>
</html>
