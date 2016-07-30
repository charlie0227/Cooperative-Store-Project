<?php
require_once "sysconfig.php";
?>
<html>	
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
	<div id="Header">
		<p></br>Hello</p>
		<?php
		include("job.php");
		?>
	</div>
</head>
<body>
	<div style='clear:both;'></div>
	<div class="body1">
		<p>Employer</p>
		<form action="login.php" method="POST" >
			<input id="username" type="text" name="username" placeholder="Account"><br>
			<input id="password" type="password" name="password" placeholder="Password"><br>
			<input type="hidden" value=0 name="who">
			<input type="image" src="image/login.png" onclick="send()">
		</form>
		<input type="image" src="image/register.png" onclick="location.href='register_employer.php';">
	</div>
	<div class="body2">
		<p>Job Seeker</p>
		<form id="t" action="login.php" method="POST" >
			<input id="block" type="text" name="username" placeholder="Account"><br>
			<input id="block" type="password" name="password" placeholder="Password" ><br>
			<input type="hidden" value=1 name="who">
			<input type="image" src="image/login.png" onclick="send()">
		</form>
		<input type="image" src="image/register.png" onclick="location.href='register_jobseeker.php';">
	</div>
</body>
</html>
