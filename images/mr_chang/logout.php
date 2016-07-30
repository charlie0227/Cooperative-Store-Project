<?php
require_once "sysconfig.php";
unset($_SESSION['admin']);
unset($_SESSION['authority']);
unset($_SESSION['edit']);
unset($_SESSION['way']);
unset($_SESSION['search']);
header('Location:index.php');
?>