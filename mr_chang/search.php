<?php
require_once "sysconfig.php";
$temp="WHERE ";
$count=false;
if(!$_POST['s_occupation'] && !$_POST['s_location'] && !$_POST['s_work_time'] && !$_POST['s_education'] && !$_POST['s_experience'] && !$_POST['s_salary'])
	$_SESSION['search']='';
else{	
	if($_POST['s_occupation']){
		$sql = "SELECT * FROM `jangsc27_cs`.`occupation` WHERE `occupation` LIKE ?";
		$sth = $db->prepare($sql);
		$sth->execute(array('%'.$_POST['s_occupation'].'%'));
		$result=$sth->fetchObject();
		$temp.=' `occupation_id` IN ('.$result->id;
		while($result=$sth->fetchObject()){
			$temp.=','.$result->id;
		}
		$temp.=')';
		$count=true;
	}
	if($_POST['s_location']){
		if($count)
			$temp.=' AND';
		$sql = "SELECT * FROM `jangsc27_cs`.`location` WHERE `location` LIKE ?";
		$sth = $db->prepare($sql);
		$sth->execute(array('%'.$_POST['s_location'].'%'));
		$result=$sth->fetchObject();
		$temp.=' `location_id` IN ('.$result->id;
		while($result=$sth->fetchObject()){
			$temp.=','.$result->id;
		}
		$temp.=')';
		$count=true;
	}
	if($_POST['s_work_time']){
		if($count)
			$temp.=' AND';
		$temp.=" `working_time` LIKE '%".$_POST['s_work_time']."%'";
		$count=true;
	}
	if($_POST['s_education']){
		if($count)
			$temp.=' AND';
		$temp.=" `education` LIKE '%".$_POST['s_education']."%'";
		$count=true;
	}
	if($_POST['s_experience']){
		if($count)
			$temp.=' AND';
		$temp.=" `experience` LIKE '%".$_POST['s_experience']."%'";
		$count=true;
	}
	if($_POST['s_salary'] && $_POST['s_salary']!=0){
		if($count)
			$temp.=' AND';
		$temp.=" `salary`";
		if($_POST['s_salary']==20000)
			$temp.=" <= 20000";
		if($_POST['s_salary']==40000)
			$temp.=" BETWEEN 20001 AND 40000";
		if($_POST['s_salary']==60000)
			$temp.=" BETWEEN 40001 AND 60000";
		if($_POST['s_salary']==80000)
			$temp.=" BETWEEN 60001 AND 80000";
		if($_POST['s_salary']==99999)
			$temp.=" >= 80001";
	}
	$_SESSION['search']=$temp;
}
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>
