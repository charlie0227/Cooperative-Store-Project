<?php
require_once "sysconfig.php";
$_SEESION['type'] = $_GET["session_val"];
'<script>alert("TESTTT")</script>';
'<script>alert("'.$_GET["session_val"].'")</script>';
?>