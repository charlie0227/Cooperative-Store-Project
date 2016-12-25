<?php
require_once "../sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-TW">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <?
$sql = "SELECT name FROM `jangsc27_cs_project`.`store` ";
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);

$sql_edit = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id` =?";
$sth_edit = $db->prepare($sql_edit);
$sth_edit->execute(array($_GET['edit_id']));
$result_object = $sth_edit->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`store_image` WHERE `store_id`= ?";
$sth2 = $db->prepare($sql);
$sth2->execute(array($_GET['edit_id']));
$result_img = $sth2->fetchObject();
?>

</head>
	<body>
	<!--show original store-->
	<form  action="member/edit_store_confirm.php" method="POST" enctype="multipart/form-data" id="edit_store_form">
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
		URL
	</td>
	</tr>
	<tr>
	<td style = "width: 60%;">
			<input type="text" name="url" id="edit_store_url" value="<?echo $result_object->url?>"><div class="star" id="star3" style="display:inline;">*</div>
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
		<?if($result_img){?>
			<img id="store_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
			<?}?>
		</div>
	</td>
	
	<td>
		<input name="files" type="file" class="upl" id="file">
	</td>
	</tr>
	<tr>
	<td>
		<input class = "abutton" type="submit" value="Edit" id="edit_btn" onclick="edit_store_submit()">
	</td>
	
	<td>
		<input type="hidden" name="store_id" value="<?echo $_GET['edit_id']?>">	
	</td>
	</tr>
	<tr>
	<td>	
		<input class = "abutton" type="button" value="back" onclick="show_own_store_content(<?echo $_GET['edit_id']?>)">
	</td>		
	</tr>		
			

	</table>	
	</form>
	</body>
</html>



