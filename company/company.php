<?php
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`company` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['company_id']));
$result = $sth->fetchObject();

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

    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="jquery-1.12.4.min.js"></script>
	<script src="jquery-tablepage-1.0.js"></script>

	<table id="tb1"><tr>
		<th>NAME</th>
		<th>PHONE</th>
		<th>ADDRESS</th>
		<th>EMAIL</th>
		</tr> 
		<?php
		if($result)
		{?>
			<td><?echo $result->name?></td>
			<td><?echo $result->phone?></td>
			<td><?echo $result->address?></td>
			<td><?echo $result->email?></td>
			</tr>
		<?}?>
	</table>
	
		
	<div id="apply_company" class="reveal-modal">
		<a class="close-reveal-modal">&#215;</a>
	</div>
	
	<span id="table_page"></span>
	<?if($situation==0){?>
		<a href="#" class="big-link" data-reveal-id="apply_company">
		<input type="button" value="加入此團體" onclick="apply(<?echo $_SESSION['id']?>,<?echo$_GET['company_id']?>)">
		</a>
	<?}if($situation==1){?>
		<p>等待審核中...</p>
	<?}if($situation==2){?>
		<input type="button" value="退出此團體" onclick="quit(<?echo $_SESSION['id']?>,<?echo$_GET['company_id']?>)">
	<?}?>
	<input type="button" value="返回" onclick="back_to_company_list()">

</html>
