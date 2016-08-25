<?php
require_once "../sysconfig.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Kendo UI Snippet</title>

    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.common.min.css"/>
    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.rtl.min.css"/>
    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.silver.min.css"/>
    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.mobile.all.min.css"/>

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://kendo.cdn.telerik.com/2016.2.714/js/kendo.all.min.js"></script>
</head>
<body>
<?if($_SESSION['name']){?>
<a onclick="fblogout();location.href='./function/logout.php';" ><div class="title">logout</div></a>
<?}else{?>
<a href="#" class="big-link" data-reveal-id="show_box"><div class="title" onclick="login()">login</div></a>

<?}?>

  
<?if($_SESSION['id']){?>
<input type="button" value="確認" onclick="ttt(<?$_GET['store_id']?>)">
<?}else{?>
;
<?}?>

<script>
    function ttt(store_id){
	$.post("test.php",
	{
		datatype:'text',
		store_id:store_id
		
	},
	function(data){
		alert(data);Z
	});
	
	}
</script>
</body>
</html>