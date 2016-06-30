<?php
session_save_path("session_tmp");
session_start();
$db_host = "dbhome.cs.nctu.edu.tw";
$db_name = "jangsc27_cs_project";
$db_user = "jangsc27_cs";
$db_password = "1234";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password);

?>