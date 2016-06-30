<?php
require_once "sysconfig.php";
unset($_SESSION['account']);
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['edit']); 
unset($_SESSION['way']);
unset($_SESSION['search']);
//echo $_SERVER["HTTP_REFERER"];
header('Location:index.php');
?>