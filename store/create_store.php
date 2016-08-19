<?php
require_once "../sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<!--Add new store  add.php-->
<form action="store/add.php" method="post" enctype="multipart/form-data" id="store_ajaxForm">
<table>
	<tr>
		<td>店家名稱</td>
	</tr>
	<tr>
		<td>
			<div class="edit_input" style="display:inline-flex">
			<input type="text" name="name">
			<div style="color:red">*</div>
		</td>
		<td><div id="auto"></div></td>
	</tr>
	<tr>
		<td>電話</td>
	</tr>
	<tr>
		<td>
			<div class="edit_input" style="display:inline-flex">
			<input type="text" name="phone">
			<div style="color:red">*</div>
		</td>
	</tr>
	<tr>
		<td>地址</td>
	</tr>
	<tr>
		<td>
			<div class="edit_input" style="display:inline-flex">
			<input type="text" name="address">
			<div style="color:red">*</div>
		</td>
	</tr>	
	<tr>
		<td>網址</td>
	</tr>
	<tr>
		<td><input type="text" name="url"><div></div></td>
	</tr>	
	<tr>
		<td>商標圖片</td>
	</tr>
	<tr>
		<td>
		<div>
			<img class="preview" style="max-width: 500px; max-height: 500px;">
			<div class="size"></div>
		</div>
		</td>
		<td><input name="files" type="file" id="files" class="upl"><div></div></td>
	</tr>
	<tr>
		<td><input class = "abutton" type="submit" value="送出" name="submit" onclick="store_submit()"></td>
	</tr>	
</table>
</form>
</body>
</html>