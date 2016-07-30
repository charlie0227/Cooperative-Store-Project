<?php
require_once "sysconfig.php";
$_SESSION['way']=$_POST['way'];
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>