<?php
require_once "../sysconfig.php";
	$sql = "SELECT `content` FROM `jangsc27_cs_project`.`contract` WHERE company_id =? AND store_id = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($_POST['company_id'],$_POST['store_id']));
	$result=$sth->fetchObject()->content;
	
	$data = json_decode($result);
	if($data){
		if($data->method=="dynamic"){
			$sql = "SELECT COUNT(*) AS num FROM `population` WHERE `company_id`= ? AND `store_id`= ?";
			$sth = $db->prepare($sql);
			$sth->execute(array($_POST['company_id'],$_POST['store_id']));
			$result=$sth->fetchObject()->num;
			$temp=floor($result/$data->people);
			$discount=$data->big-$temp;
			if($discount<$data->small){
				echo $data->small;
			}
			else{
				echo $discount;
			}
		
		}
		else{
			echo $data->discount;
		}
	}
	else{
		echo "還未跟此家店簽約喔~~~";
	}
	
	
?>
