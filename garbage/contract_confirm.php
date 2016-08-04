<?
require_once "sysconfig.php";
$store_id=$_POST['store_id'];
$member1_id=$_POST['member1_id'];
$member2_id=$_POST['member2_id'];
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` WHERE `id`= ?";
$find = $db->prepare($sql);
$find->execute(array($member1_id));
$myname=$_POST['myname'];
$youname=$_POST['youname'];
$content=$_POST['content'];
$big  =$member1_id>$member2_id?$member1_id:$member2_id;
$small=$member1_id<$member2_id?$member1_id:$member2_id;
$me = ($small==$_SESSION['id']) ? 1:2;
$you= ($small==$_SESSION['id']) ? 2:1;

$data = new stdClass();
if($_POST['status']=='check'){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `store_id`= ? and `member1_id` = ? and `member2_id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id,$small,$big));
	$result=$sth->fetchObject();
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member` WHERE `id`= ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($member1_id));
	$myname=$sth->fetchObject()->name;
	$sql = "SELECT * FROM `jangsc27_cs_project`.`member` WHERE `id`= ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($member2_id));
	$youname=$sth->fetchObject()->name;
	if($me==1){//check1==me  check2==you
		$check1=$result->check1;
		$check2=$result->check2;
	}
	else{
		$check1=$result->check2;
		$check2=$result->check1;
		}	
	$data->message="";
	if($result){#already
		$data->message=$result->content;
	}
}
if($_POST['status']=='edit'){
	$sql = "UPDATE `jangsc27_cs_project`.`contract` SET `check".$me."` = ? WHERE `contract`.`store_id` = ? AND `contract`.`member1_id` = ? AND `contract`.`member2_id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array(0,$store_id,$small,$big));
	
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `store_id`= ? and `member1_id` = ? and `member2_id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id,$small,$big));
	$result=$sth->fetchObject();
	if($me==1){//check1==me  check2==you
		$check1=$result->check1;
		$check2=$result->check2;
		
	}
	else{
		$check1=$result->check2;
		$check2=$result->check1;
	}	
	$data->message=$result->content;
}
if($_POST['status']=='sure'){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `store_id`= ? and `member1_id` = ? and `member2_id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id,$small,$big));
	$result=$sth->fetchObject();
	if($result){//repeat
	
		$data->m1=($content==$result->content);
		$data->m2=$you;
		if($content!=$result->content)
			$if_change_anything=0;
		else
			if($you==1)
				$if_change_anything=$result->check1;
			else
				$if_change_anything=$result->check2;

		$sqlx = "UPDATE `jangsc27_cs_project`.`contract` SET `content` = ? , `check".$me."` = ? , `check".$you."` = ? WHERE `contract`.`store_id` = ? AND `contract`.`member1_id` = ? AND `contract`.`member2_id` = ?";
		$sthx = $db->prepare($sqlx);
		$sthx->execute(array($content,1,$if_change_anything,$store_id,$small,$big));
	}
	else{//new
		$sqlz = "INSERT INTO `jangsc27_cs_project`.`contract` (store_id,member1_id,member2_id,check".$me.",check".$you.",content) VALUES(?,?,?,?,?,?)";
		$sthz = $db->prepare($sqlz);
		$sthz->execute(array($store_id,$small,$big,1,0,$content));
	}
	$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `store_id`= ? and `member1_id` = ? and `member2_id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id,$small,$big));
	$result=$sth->fetchObject();
	if($me==1){//check1==me  check2==you
		$check1=$result->check1;
		$check2=$result->check2;
		
	}
	else{
		$check1=$result->check2;
		$check2=$result->check1;
	}	
	$data->message=$content;
}
$data->error=$if_change_anything;
$data->store_id=$store_id;
$data->member1_id=$member1_id;
$data->member2_id=$member2_id;
$data->myname=$myname;
$data->youname=$youname;
$data->check1=$check1?' checked':' unchecked';
$data->check2=$check2?' checked':' unchecked';
echo json_encode($data);
?>