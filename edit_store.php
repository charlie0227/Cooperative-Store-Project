<?php
require_once "../sysconfig.php";
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
			?><img onclick="window.open('http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $img_result['image']?>')" src="<?echo $img_result['image']?>" style="width: 30%;height: 30%;"/><?
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



