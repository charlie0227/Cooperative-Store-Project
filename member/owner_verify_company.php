<?php
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`company` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['company_id']));
$result = $sth->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`contract` b ON a.`company_id` = b.`company_id` AND b.`company_id` = ?";
$sth1 = $db->prepare($sql);
$sth1->execute(array($_GET['company_id']));

?>	
<html>
	<?php
	if($result) 
	{?>
		<p>���W <?echo $result->name?></p>
		<?if($result_img){?>
		<a href="http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image?>"><img src="<?echo $result_img->image?>" style="width: 30%;height: 30%;"/></a>
		<?}?>
		<p>�q�� <?echo $result->phone?></p>
		<p>�a�} <?echo $result->address?></p>
		<p>Email <?echo $result->email?></p>
		<p>�X�@���~ <?
			while($result_company = $sth1->fetchObject()){
				echo $result_company->name.'</p><p>';
			}?>
		</p>
	<?}?>
	<input type="button" value="��A�ڬO���~��" onclick="owner_verify_company(<?echo $result->id?>)">

</html>
