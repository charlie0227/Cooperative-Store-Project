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
                $('.size').text("檔案大小：" + KB + " KB");
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
	$("#s1").click(function(){
		var str=document.getElementById("name").value; 
		if(str) 
		var i,c=0,array=<? echo json_encode($result);?>;
		for(i=0;i<array.length;i++){
			if(str==array[i])
				c=1;
		}
		if(c==1) {
			$("#zz").show();
			$("#add").hide();
			$("#s1").show();
		}
			
		else {
			$("#zz").hide();
			$("#add").show();
			$("#s1").hide();
			$('#name').attr('readonly', true);
		}
	});
});

function my_reset() {
	$(".valid").hide();
	$("#zz").hide();
	$("#add").hide();
	$("#s1").show();
	$('#name').attr('readonly', false);
}


</script>
</head>
	<body>
	<!--Add new store  add.php-->
	<form action="add.php" method="post" enctype="multipart/form-data" id="create_ajaxForm">
	<table>
	<tr>
	<td>
		Store Name
	</td>
	</tr>
	<tr>
		<td>
			
			<input name="name" type="text" id="name1"><div class="star" id="star1" style="display:inline;">*</div>
		</td>
		
		<td>
			<input class = "abutton" style="width:auto;" id="m1" type="button" value="match" ><div style = "display: inline; margin: 10px;" class="valid" id="repeat_acc">Reapted Account</div>
		</td>
	</tr>
	</table>
	<table id="add1">
		
		<tr>
		<td>
			Phone
		</td>
		</tr>
		<tr>
			<td>
			
			<input type="text" name="phone" id="phone"><div style="display:inline;">*</div>
			</td>
		</tr>
		<tr>
		<td>
			Address
		</td>
		</tr>
		<tr>
			<td>
			
			<input type="text" name="address" id="address"><div class="star" id="star3" style="display:inline;">*</div>
			</td>
		</tr>	
		<tr>
		<td>
			Content
		</td>
		</tr>
		<tr>
			<td>
			
			<textarea name="content" id="add_content" style="width:90%;height:150%;"></textarea>
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
			
			<input name="files" type="file" id="files" class="upl">
			</td>
			
		</tr>
		<tr>
		<td>
			<input class = "abutton" type="submit" value="Submit" >
		</td>
		</tr>	
		
	</table>
	</form>
	
	</body>
</html>



