<?php
require_once "sysconfig.php";
unset($_SESSION['search']);
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>