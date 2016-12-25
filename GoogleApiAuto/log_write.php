<?php
if(isset($_POST['log']) && isset($_POST['name'])){
	$log = $_POST['log']."\r\n";
	$name = $_POST['name'];
	$URL = "/home/xu3u4tp6/public_html/GoogleApiAuto/log/".$name;
	if (($fileopen = fopen($URL, "a+")) !== false) { 
		fseek($fileopen, 0);
		fwrite($fileopen,$log);
		fclose($fileopen); 
	}
}
?>