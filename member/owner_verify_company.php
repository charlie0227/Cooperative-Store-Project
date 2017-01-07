<?php
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`company` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['company_id']));
$result = $sth->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`company_image` b ON a.`id` = b.`company_id` AND b.`company_id` = ?";
$sth1 = $db->prepare($sql);
$sth1->execute(array($_GET['company_id']));
$result_img = $sth->fetchObject();

?>	
<html>
	<?php
	if($result) 
	{?>
		<p>店名 <?echo $result->name?></p>
		<?if($result_img){?>
		<a href="http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image?>"><img src="<?echo $result_img->image?>" style="width: 30%;height: 30%;"/></a>
		<?}?>
		<p>電話 <?echo $result->phone?></p>
		<p>地址 <?echo $result->address?></p>
		<p>Email <?echo $result->url?></p>
		
	<?}?>
	<input type="button" value="對，我是企業長" onclick="owner_verify_company(<?echo $result->id?>)">

</html>
