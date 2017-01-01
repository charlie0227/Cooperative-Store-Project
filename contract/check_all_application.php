<?
require_once "../sysconfig.php";
$sql = "SELECT c.name as company_name ,d.name as store_name,c.id as company_id , d.id as store_id ,content FROM `jangsc27_cs_project`.`member_store` a
JOIN `jangsc27_cs_project`.`contract_application` b
JOIN `jangsc27_cs_project`.`company` c
JOIN `jangsc27_cs_project`.`store` d
ON a.store_id = b.store_id and b.company_id = c.id and d.id = a.store_id and a.member_id = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));

echo '<p>這些團體想與你簽約</p><table class="bordered">';
while($result=$sth->fetchObject()){?>
<?
$sql = "SELECT * FROM `jangsc27_cs_project`.`company_image` WHERE `company_id`= ?";
$sth2 = $db->prepare($sql);
$sth2->execute(array($result->company_id));
$company_img = $sth2->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`store_image` WHERE `store_id`= ?";
$sth2 = $db->prepare($sql);
$sth2->execute(array($result->store_id));
$store_img = $sth2->fetchObject();
?>
<tr>
<td>
<?if($company_img){?>
  <img style="width:100px; height:100px;" id="company_img" src="<?echo $company_img->image_url?>"/>
<?}?>
</td>
<td><?echo $result->company_name?></td>
<td>想與您的商店</td>
<td>
<?if($store_img){?>
  <img style="width:100px; height:100px;" id="store_img" src="<?echo $store_img->image_url?>"/>
<?}?>
</td>
<td><?echo $result->store_name?></td>
<td><input type="button" class="k-button" style="width:auto;" value="簽約" onclick="contract_make(<?echo $result->store_id?>,<?echo $result->company_id?>,'store');"/></td>
<?}?>
