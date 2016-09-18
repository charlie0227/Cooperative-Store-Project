<?php
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['store_id']));
$result = $sth->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`contract` b ON a.`store_id` = b.`store_id` AND b.`store_id` = ?";
$sth1 = $db->prepare($sql);
$sth1->execute(array($_GET['store_id']));

$sql = "SELECT * FROM `jangsc27_cs_project`.`image` WHERE `store_id`= ?";
$sth2 = $db->prepare($sql);
$sth2->execute(array($_GET['store_id']));
$result_img = $sth2->fetchObject();

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
		<p>Email <?echo $result->email?></p>
		<p>合作企業 <?
			while($result_company = $sth1->fetchObject()){
				echo $result_company->name.'</p><p>';
			}?>
		</p>
	<?}?>
	<input type="button" class="k-button" style="width: auto;" value="對，我是店長" onclick="owner_verify_store(<?echo $result->id?>)">

</html>
