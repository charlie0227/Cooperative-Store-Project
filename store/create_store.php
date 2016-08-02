<?php
require_once "../sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-TW">

</head>
	<body>
	<!--Add new store  add.php-->
	<form id="store_ajaxForm">
	<table>
	<tr><td>Store Name</td></tr>
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
		<tr><td>Phone</td></tr>
		<tr><td>
			<input type="text" name="phone" id="phone"><div style="display:inline;">*</div>
			</td></tr>
		<tr><td>Address</td></tr>
		<tr>
			<td>
			<input type="text" name="address" id="address"><div class="star" id="star3" style="display:inline;">*</div>
			</td></tr>	
		<tr>
		<td>Content</td></tr>
		<tr><td><textarea name="content" id="add_content" style="width:90%;height:150%;"></textarea></td></tr>	
		<tr><td>Images</td></tr>
		<tr><td><div>
				<img class="preview" style="max-width: 500px; max-height: 500px;">
				<div class="size"></div>
			</div>
			</td>
			<td><input name="files" type="file" id="files" class="upl"></td>
		<tr><td><input class = "abutton" type="button" value="Submit" onclick="store_submmit()"></td></tr>		 
	</table>
	</form>
	
	</body>
</html>



