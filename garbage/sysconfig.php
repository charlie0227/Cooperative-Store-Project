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
#$_SESSION['account'] = account
#$_SESSION['name'] = name
#$_SESSION['id'] = id
?>