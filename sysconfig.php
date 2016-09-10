<?php
session_save_path("/net/cs/102/0216207/public_html/session_tmp");
session_start();
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "jangsc27_cs_project";
$db_user = "jangsc27_cs";
$db_password = "1234";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);
$root_dir ="/net/cs/102/0216207/public_html/";
date_default_timezone_set("Asia/Taipei");
function write_log($status,$data)  //狀態 資料       
{
	$status='<'.$status.'>';
	$URL = "/net/cs/102/0216207/public_html/log/log.txt";            
    $time= "[".date("Y-m-d H:i:s")."] ";
	//ip
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	else
	  $ip=$_SERVER['REMOTE_ADDR'];
    $ip='['.$ip.']';
	//
	$ip=str_pad($ip,17," ",STR_PAD_RIGHT);
	$status=str_pad($status,16," ",STR_PAD_RIGHT);
    $log=$time.$ip.$status.$data."\r\n";
    $fileopen = fopen($URL, "a+");               
    fseek($fileopen, 0);
    fwrite($fileopen,$log);
    fclose($fileopen);
}
#$_SESSION['account'] = account
#$_SESSION['name'] = name
#$_SESSION['id'] = id
?>