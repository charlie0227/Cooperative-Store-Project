<?php
require_once "sysconfig.php";
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
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<script src="jquery-1.12.4.min.js"></script>
</head>
<body>
	<table><tr>
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
			<td><?echo $result->email?></td>';
			</tr>
		<?}?>
	</table><?
	if($situation==0)
		echo '<input type="button" value="加入此團體" onclick="apply('.$_SESSION['id'].','.$_GET['company_id'].')">';
	if($situation==1)
		echo '<p>等待審核中...</p>';
	if($situation==2)
		echo '<input type="button" value="退出此團體" onclick="quit('.$_SESSION['id'].','.$_GET['company_id'].')">';
	?>
	</body>
</html>
