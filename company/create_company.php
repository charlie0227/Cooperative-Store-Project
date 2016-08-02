<?php
require_once "../sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
	<body>
	<!--Add new company  add.php-->
	<form action="./company/add.php" method="post" enctype="multipart/form-data" id="company_ajaxForm">
	<tr><td>Company Name</td></tr>
	<tr>
		<td>
		<input name="name" type="text" id="company_name"><div class="star" id="star1" style="display:inline;">*</div>
		</td>
		<td>
			<input class = "abutton" style="width:auto;" id="company_match" type="button" value="match" ><div style = "display: inline; margin: 10px;" class="valid" id="repeat_acc">Reapted Account</div>
		</td>
	</tr>


		<tr><td>Phone</td></tr>
		<tr><td>
			<input type="text" name="phone" id="company_phone"><div style="display:inline;">*</div>
			</td></tr>
		<tr><td>Address</td></tr>
		<tr>
			<td>
			<input type="text" name="address" id="company_address"><div class="star" id="star3" style="display:inline;">*</div>
			</td></tr>	
		<tr>
		<td>Email</td></tr>
		<tr><td><input type="text" name="email" id="company_email"><div class="star" id="star3" style="display:inline;">*</div></td></tr>	
		<tr><td><input class = "abutton" type="submit" value="Submit" name="submit" onclick="company_submit()"></td></tr>	
	
	</form>
	
	</body>
</html>



