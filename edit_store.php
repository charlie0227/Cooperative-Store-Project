<?php
require_once "sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-TW">
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
  <?
$sql = "SELECT name FROM `jangsc27_cs_project`.`store` ";
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);

$sql_edit = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id` =?";
$sth_edit = $db->prepare($sql_edit);
$sth_edit->execute(array($_GET['edit_id']));
$result_object = $sth_edit->fetchObject();

$sql_img = "SELECT * FROM `jangsc27_cs_project`.`image` where `store_id` = ?";
$sth_img = $db->prepare($sql_img);
$sth_img->execute(array($_GET['edit_id']));
?>
<script type="text/javascript">
//jquery ui autocomplete https://dotblogs.com.tw/a802216/2013/09/19/119070
$(function() {
    var availableTags = <? echo json_encode($result);?>;
	$( "#name" ).autocomplete({
      source: availableTags
    });
  });
//preview image http://jsnwork.kiiuo.com/archives/2258/jquery-javascript-%E6%95%99%E4%BD%A0%E5%A6%82%E4%BD%95%E8%A3%BD%E4%BD%9C%E5%9C%96%E7%89%87%E4%B8%8A%E5%82%B3%E5%89%8D%E7%9A%84%E9%A0%90%E8%A6%BD%E5%9C%96
$(function (){
 
    function format_float(num, pos)
    {
        var size = Math.pow(10, pos);
        return Math.round(num * size) / size;
    }
 
    function preview(input) {
 
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.preview').attr('src', e.target.result);
                var KB = format_float(e.total / 1024, 2);
                $('.size').text("ÀÉ®×¤j¤p¡G" + KB + " KB");
            }
 
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    $("body").on("change", ".upl", function (){
        preview(this);
    })
    
})  

$(document).ready(function(){
    $(".valid").hide();
	$("#zz").hide();
	$("#add").hide();
	$("input").focus(function(){
        $(this).css("background-color", "#cccccc");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    });
	$("#name").blur(function(){
		var str=document.getElementById("name").value; 
		if(str) 
		var i,c=0,array=<? echo json_encode($result);?>;
		for(i=0;i<array.length;i++){
			if(str==array[i]&&str!='<?echo $result_object->name?>')
				c=1;
		}
		if(c==1) {
			
			$("#zz").show();
			$("#edit_btn").hide();
		}
		else {
			$("#zz").hide();
			$("#edit_btn").show();
		}
	});
	$("#file").blur(function(){
		$("#img").hide();
	});
});



</script>
</head>
	<body>
	
	<!--show original store-->
	<form  action="edit_store_confirm.php" method="POST" enctype="multipart/form-data" id="edit_store_form">
	<table>
	<tr>
	<td>
		Store Name
	</td>
	</tr>
	<tr>
	<td>
		<input name="name" type="text" id="edit_store_name" value="<?echo $result_object->name?>"><div class="star" id="star1" style="display:inline;">*</div>
	</td>
	<td>
		<div class="valid"id="edit_store_zz">Reapted Account</div>
	</td>
	</tr>
	<tr>
	<td>
		Phone
	</td>
	</tr>
	<tr>
	<td>
		<input type="text" name="phone" id="edit_store_phone" value="<?echo $result_object->phone?>"><div class="star" id="star2" style="display:inline;">*</div>
	</td>
	</tr>		
	<tr>
	<td>
		Address
	</td>
	</tr>		
	<tr>
	<td>	
		<input type="text" name="address" id="edit_store_address" value="<?echo $result_object->address?>"><div class="star" id="star3" style="display:inline;">*</div>
	</td>
	</td>
	<tr>
	<td>
		Content
	</td>
	</tr>
	<tr>
	<td style = "width: 60%;">
		<textarea name="content" id="edit_store_content" style="width:100%;height:150px; "><?echo $result_object->content?></textarea>
	</td>
	</tr>
	<tr>
	<td>
		Images
	</td>
	</tr>	
	<tr>
	<td>
		<div>
			<img class="preview" style="max-width: 500px; max-height: 500px;">
			<div class="size"></div>
		</div>
	</td>
	<td>
		<div id="img">
		<?
		while($img_result = $sth_img->fetch()){
			echo '<img src="data:'.$img_result['image_type'].';base64,'.$img_result['image'].'" heigh="150" width="150"/>';
		}
		?>
		</div>
	</td>
	
	<td>
		<input name="files" type="file" class="upl" id="file">
	</td>
	</tr>
	<tr>
	<td>
		<input class = "abutton" type="submit" value="Edit" id="edit_btn" >
	</td>
	
	<td>
		<input type="hidden" id="edit_store_id" name="edit_id" value="<?echo $_GET['edit_id']?>">	
	</td>
	</tr>
	<tr>
	<td>	
		<input class = "abutton" type="button" value="back" onclick="manage_store(<?echo $_GET['edit_id']?>,<?echo $_GET['gtype']?>)">
	</td>		
	</tr>		
			

	</table>	
	</form>
	</body>
</html>



