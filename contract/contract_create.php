<?php
require_once "../sysconfig.php";

$status  =$_POST['status'];
$date_sta=isset($_POST['date_sta'])?date("Y-m-d",strtotime($_POST['date_sta'])):"0000-00-00";
$date_end=isset($_POST['date_end'])?date("Y-m-d",strtotime($_POST['date_end'])):"0000-00-00";
$date_sign=isset($_POST['date_sign'])?$_POST['date_sign']:"";
$content =isset($_POST['content'])?$_POST['content']:"";

$store_id     =$_POST['store_id'];
$store_owner  =isset($_POST['store_owner'])?$_POST['store_owner']:"";
$store_address=isset($_POST['store_address'])?$_POST['store_address']:"";
$store_phone  =isset($_POST['store_phone'])?$_POST['store_phone']:"";

$company_id     =$_POST['company_id'];
$company_owner  =isset($_POST['company_owner'])?$_POST['company_owner']:"";
$company_address=isset($_POST['company_address'])?$_POST['company_address']:"";
$company_phone  =isset($_POST['company_phone'])?$_POST['company_phone']:"";


$sql="INSERT INTO `jangsc27_cs_project`.`contract`(`status`, `date_sta`, `date_end`, `date_sign`, `content`, `store_id`, `store_owner`, `store_address`, `store_phone`, `company_id`, `company_owner`, `company_address`, `company_phone`)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$sth = $db->prepare($sql);
$sth->execute(array($status,$date_sta,$date_end,$date_sign,$content,$store_id,$store_owner,$store_address,$store_phone,$company_id,$company_owner,$company_address,$company_phone));

echo $status.$date_sta.$date_end.$date_sign.$content.$store_id.$store_owner.$store_address.$store_phone.$company_id.$company_owner.$company_address.$company_phone;
$sth=$db->prepare($sql);
?>
