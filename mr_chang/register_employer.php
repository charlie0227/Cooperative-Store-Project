<?php
require_once "sysconfig.php";
?>
<html>
<head>
<script src="jquery-1.11.1.min.js"></script><p id="demo"></p>
<script type="text/javascript">

<?
$sql = "SELECT account FROM `jangsc27_cs`.`employer`";
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
?>
$(document).ready(function(){
    $(".valid").hide();
	$("#zz").hide();
	$("input").focus(function(){
        $(this).css("background-color", "#cccccc");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    });
	$("#account").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star1").hide();
		else $("#star1").show();
		if(str.match(" ")) 
			$("#valid1").show();
		else $("#valid1").hide();
		var i,c=0,array=<? echo json_encode($result);?>;
		for(i=0;i<array.length;i++){
			if(str==array[i])
				c=1;
		}
		if(c==1) 
			$("#zz").show();
		else $("#zz").hide();
	});
	$("#word").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star2").hide();
		else $("#star2").show();
		if(str.match(" ")) 
			$("#valid2").show();
		else $("#valid2").hide();
	});
	$("#phone").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star3").hide();
		else $("#star3").show();
		if(str.match(" ")) 
			$("#valid3").show();
		else $("#valid3").hide();
	});
	$("#email").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star4").hide();
		else $("#star4").show();
		if(str.match(" ")) 
			$("#valid4").show();
		else $("#valid4").hide();
	});
});
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
	<body>
	<h1>Fill in Your resume</h1>
	<form id="register" style="display:inline;" action="register_account.php" method="POST">
	    <p>Account</p>
		<input type="text" name="account" id="account">
		<div class="star" id="star1">*</div>
		<div class="valid"id="valid1">do not type space</div>
		<div class="valid"id="zz">Reapted Account</div>
	    <p>Password</p>
		<input type="password" name="password" id="word">
		<div class="star" id="star2">*</div>
		<div class="valid"id="valid2">do not type space</div>
	    <p>Phone</p>
		<input type="text" name="phone" id="phone">
		<div class="star" id="star3">*</div>
		<div class="valid"id="valid3">do not type space</div>
		<p>Email Address</p>
		<input type="text" name="email" id="email">
		<div class="star" id="star4">*</div>
		<div class="valid"id="valid4">do not type space</div>
		<input type="hidden" name="who" value=1></br></br></br>
		<input type="image" src="image/submit.png" onclick="send()">
		<input type="image" src="image/reset.png" onclick="reset();return false;">
	</form>
	<input type="image" src="image/back.png" onclick="location.href=('logout.php')">
	</body>
</html>

