<?php
require_once "../sysconfig.php";
$data=new stdClass();

$date=$_POST['who'];
$store_id=$_POST['store_id'];
$company_id=$_POST['company_id'];

echo json_encode($data);
?>
