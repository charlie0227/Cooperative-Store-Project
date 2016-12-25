<?
require_once "../sysconfig.php";
$gettime=date ("Y-m-d H:i:s");
$nowtime = strtotime($gettime); 

$member_id=$_SESSION['id'];
$store_id=$_POST['store_id'];
$company_id=$_POST['company_id'];

if(isset($_SESSION['id'])&&isset($_POST['store_id'])&&isset($_POST['company_id'])){	
	$sql = "SELECT * FROM `jangsc27_cs_project`.`population` WHERE `member_id` = ? AND `store_id` = ? AND `company_id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($member_id,$store_id,$company_id));
	$flag=0;//no less than 3 hours visit
	while($result=$sth->fetchObject()){
		$record_time=strtotime($result->time);
		$diff=round(abs($nowtime - $record_time) / (60*60),2);
		if($diff<3){
			$flag=1;//have repeat visit
			$temp_time=$result->time;
		}
	}
	if($flag){
		echo '已有登入資料請勿在短時間重複打卡';
		write_log('Checkin error','check in too fast! member_id: '.$member_id.' store_id: '.$store_id.' company_id: '.$company_id);
	}
	else{
		$sql = "INSERT INTO `jangsc27_cs_project`.`population`(`member_id`, `store_id`, `company_id`, `time`)  VALUES (?,?,?,?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($member_id,$store_id,$company_id,$gettime));
		echo '打卡成功!!';
		write_log('Checkin Success','member_id: '.$member_id.' store_id: '.$store_id.' company_id: '.$company_id);
	}
}
else{
	echo '輸入錯誤';
	write_log('Checkin error','check in wrong value');
}
?>