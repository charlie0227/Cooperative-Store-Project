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


if(isset($_SESSION['id'])){
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
}
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
			<p>公司名稱 <?echo $result->name?></p>
			<?if($result_img){?>
			<img id="company_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
			<?}?>
			<p>電話 <?echo $result->phone?></p>
			<p>地址 <?echo $result->address?></p>
			<p>網站 <?echo $result->url?></p>
			<p>合作店家 <?
				while($result_store = $sth1->fetchObject()){
					echo $result_store->name.'</p><p>';
				}?>
			</p>
		<?}?>
	<?
	if(isset($_SESSION['id'])){
		if($situation==0){?>
			<a href="#" class="big-link" data-reveal-id="show_box">
			<input type="button" class="k-button" style="width:auto;" value="加入此團體" onclick="apply(<?echo $_SESSION['id']?>,<?echo$_GET['company_id']?>)"></a>
		<?}if($situation==1){?>
			<input type="button" class="k-button" style="width:auto;" value="等待審核中(再次點即取消加入)" onclick="apply_cancel(<?echo $_SESSION['id']?>,<?echo $_GET['company_id']?>,0)"/></a>
		<?}if($situation==2){?>
			<input type="button" class="k-button" style="width:auto;" value="退出此團體" onclick="quit(<?echo $_SESSION['id']?>,<?echo$_GET['company_id']?>)">
		<?}?>
		<a href="#" class="big-link" data-reveal-id="show_box"><input type="button" class="k-button" style="width:auto;" value="簽約" onclick="select_store(<?echo $result->id?>)"/></a>
	<?}?>
	<input type="button" class="k-button" style="width:auto;" value="返回" onclick="back_to_company_list()">

</html>
