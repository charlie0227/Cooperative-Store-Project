<?php
require_once "sysconfig.php";
$member1=$_SESSION['id'];//me==member1
$member2=$_GET['member2'];//you==mamber2
$store_id=$_GET['store_id'];
#find member2 information
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` WHERE `id`= ?";
$find = $db->prepare($sql);
$find->execute(array($member2));
$friend=$find->fetchObject();
#find store information
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$fstore = $db->prepare($sql);
$fstore->execute(array($store_id));
$find_store=$fstore->fetchObject();
#use store_id,member1_id,member2_id find contract
$small=$member1<$member2?$member1:$member2;
$big=$member1<$member2?$member2:$member1;
$sqlx = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `store_id`= ? and `member1_id`= ? and `member2_id`= ?";
$sthx = $db->prepare($sqlx);
$sthx->execute(array($store_id,$small,$big));
$result=$sthx->fetchObject();
if(!$result){#use id find contract
	$sqlx = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `id`= ? ";
	$sthx = $db->prepare($sqlx);
	$sthx->execute(array($_GET['contract_id']));
	$result=$sthx->fetchObject();	
}

$me = ($result->member1_id==$_SESSION['id']) ? 1:2;
$you= ($result->member1_id==$_SESSION['id']) ? 2:1;
if($me==1){//check1==me  check2==you
	$check1=$result->check1;
	$check2=$result->check2;
}
else{
	$check1=$result->check2;
	$check2=$result->check1;
}	
#intension::
#1.Last modify time
#2.lock edit when both checked
$data = new stdClass();
$data->store_id=$store_id;
$data->member1_id=$small;
$data->member2_id=$big;
$data->myname=$_SESSION['name'];
$data->youname=$friend->name;
$data->message=$result->content;
$data->check1=$check1?' checked':' unchecked';
$data->check2=$check2?' checked':' unchecked';

?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="contract.js"></script>
<script src="store.js"></script>
<script src="account.js"></script>
<script type="text/javascript">

</script>			
</head>
<body>
		<p>Hello  <?echo $_SESSION['name']?></p>  
		<p>You are signing up contract with <?echo $friend->name?><br></p>
		<p>Store Name: <?echo $find_store->name?> </p><p>Store ID: <?echo $store_id?></p>
		<div id="con_signup">
			<p>contract content:</p>
			<div id="con_unchecked">
				<textarea id="con_content" name="content" style="height: 100px;width: 300px;"><?echo $result->content?></textarea><br><br>
				<input class = "abutton" style = "width: 100px;"type="button" id="con_sure" name="sure" value="sure" onclick="edit_contract(<?echo $_SESSION['id']?>,<?echo $member2?>,<?echo $store_id?>,'sure','<? echo $_SESSION['name']?>','<?echo $friend->name?>')"><br>
			</div>
			<div id="con_checked">
				<p id="con_after" style="color: blue;background: beige;height: 100px;width: 300px;"></p>
				<input class = "abutton" style = "width: 100px;" type="button" id="con_edit" name="edit" value="edit" onclick="edit_contract(<?echo $_SESSION['id']?>,<?echo $member2?>,<?echo $store_id?>,'edit','<? echo $_SESSION['name']?>','<?echo $friend->name?>')">
			</div>
			<p id="con_me"></p>
			<p id="con_you"></p>
			<input class = "abutton" style = "width: 100px;"type="button" value="back" onclick="contract_list()"><br>
			<div id="contract_data" value=""></div>
		</div>	
</body>
</html>