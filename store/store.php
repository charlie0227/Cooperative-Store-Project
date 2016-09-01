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

?>	
<html>
<head>

<style>

</style>
	</head>	
		<?php
		if($result) 
		{?>
			<p>店名 <?echo $result->name?></p>
			<?if($result_img){?>
			<img id="store_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
			<?}?>
			<p>電話 <?echo $result->phone?></p>
			<p>地址 <?echo $result->address?></p>
			<div id="store_map" ></div>
			<p>網站 <?echo $result->url?></p>
			<p>合作企業 <?
				while($result_company = $sth1->fetchObject()){
					echo $result_company->name.'</p><p>';
				}?>
			</p>
		<?}?>
	<input type="button" class="abutton" style="width:auto;" value="與店家合作" onclick="">
	<a href="#" class="big-link" data-reveal-id="show_box"><input type="button" class="abutton" style="width:auto;" value="我是店長" onclick="owner_show_store(<?echo $result->id?>)"></a>
	<a href="#" class="big-link" data-reveal-id="show_box"><input type="button" class="abutton" style="width:auto;" value="簽約" onclick="select_company(<?echo $result->id?>)"/></a>
	<input type="button" class="abutton" style="width:auto;" value="返回" onclick="back_to_store_list()">

</html>
