<?php
require_once "../sysconfig.php";
write_log('Logout','id: '.$_SESSION['id'].' account: '.$_SESSION['account'].' name: '.$_SESSION['name']);
unset($_SESSION['account']);
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['edit']); 
unset($_SESSION['way']);
unset($_SESSION['search']);
//echo $_SERVER["HTTP_REFERER"];
header('Location:../index.php');
?>