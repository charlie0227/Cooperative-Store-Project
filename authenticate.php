
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script type="text/javascript" language="JavaScript">
	var rval;
		function checkEmail() {
			var remail = $("#email").val();
			emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
			if (remail.search(emailRule)!=-1) {
			
				$.post("send_auth.php",
				{
				  datatype:'text',
				  remail:remail
				  
				},
				function(data){
					rval = data;
					alert(rval);
				});
			}
			else {
				alert("False");
				$("#form").focus();
			}
		}
		function check_rval(){
			var c = $("#check_num").val();
			alert(c+'-'+rval);
			//!strcmp(c,rval)
			var result = rval.replace(/\r\n|\n/g,"");
			result = result.replace(/\s+/g, "");
			alert(result+'-'+c);
			if(result==c){
				alert("GJ");
			}
			else{
				alert("GG");
			}
		}
	</script>
</head>

<body>
	<div id="content">
	<form id="form">
		Your Email：<input type="text" id="email" name="email" size="15">
		<input type="button" value="send" onClick="checkEmail()">
	</form>
	<form id="form">
		驗證碼：<input type="text" id="check_num" name="rval" size="15">
		<input type="button" value="check" onClick="check_rval()">
	</form>
	</div>
</body>
</html>