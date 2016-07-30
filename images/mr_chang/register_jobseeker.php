<?php
require_once "sysconfig.php";
?>
<html>
<head>
<script src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">
<?
$sql = "SELECT account FROM `jangsc27_cs`.`user`";
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
?>
$(document).ready(function(){
    $(".valid").hide();
	$("input").focus(function(){
        $(this).css("background-color", "#cccccc");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    });
	$("#account").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star1").hide();
		else $("#star1").show();
		if(str.match(" ")) 
			$("#valid1").show();
		else $("#valid1").hide();
		var i,c=0,array=<? echo json_encode($result);?>;
		for(i=0;i<array.length;i++){
			if(str==array[i])
				c=1;
		}
		if(c==1) 
			$("#zz").show();
		else $("#zz").hide();
	});
	$("#word").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star2").hide();
		else $("#star2").show();
		if(str.match(" ")) 
			$("#valid2").show();
		else $("#valid2").hide();
	});
	$("#phone").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star3").hide();
		else $("#star3").show();
		if(str.match(" ")) 
			$("#valid3").show();
		else $("#valid3").hide();
	});
	$(".gender").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star4").hide();
		else $("#star4").show();
	});
	$("#email").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star5").hide();
		else $("#star5").show();
		if(str.match(" ")) 
			$("#valid5").show();
		else $("#valid5").hide();
	});
	$("#salary").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star6").hide();
		else $("#star6").show();
		if(str.match(" ")) 
			$("#valid6").show();
		else $("#valid6").hide();
	});
});
</script>
</head>
<link href="style.css" rel="stylesheet" type="text/css" />
	<body>
	<h1>Fill in Your resume</h1>
	<form style="display:inline;" action="register_account.php" method="POST">
		<p>Account</p>
		<input type="text" name="account" id="account">
		<div class="star" id="star1">*</div>
		<div class="valid"id="valid1">do not type space</div>
		<div class="valid"id="zz">Reapted Account</div>
		<p>Password</p>
		<input type="password" name="password" id="word">
		<div class="star" id="star2">*</div>
		<div class="valid"id="valid2">do not type space</div>
	    <p>Phone</p>
		<input type="text" name="phone" id="phone">
		<div class="star" id="star3">*</div>
		<div class="valid"id="valid3">do not type space</div>
		<p>Gender</p>
		<input type="radio" id="male" name="gender" value="male" class="gender">
		<label for "male">Male</label>
		<input type="radio" id="female" name="gender" value="female" class="gender">
		<label for "female">Female</label>
		<div class="star" id="star4">*</div>
		<p>Age</p>
		<select name="age">
			<option value=12>12</option><option value=12>13</option><option value=12>14</option>
			<option value=15>15</option><option value=16>16</option><option value=17>17</option>
			<option value=18>18</option><option value=19>19</option><option value=20>20</option>
			<option value=21>21</option><option value=22>22</option><option value=23>23</option>
			<option value=24>24</option><option value=25>25</option><option value=26>26</option>
			<option value=27>27</option><option value=28>28</option><option value=29>29</option>
			<option value=30>30</option><option value=31>31</option><option value=32>32</option>
			<option value=33>33</option><option value=34>34</option><option value=35>35</option>
		</select>
		<p>Email Address</p>
		<input type="text" name="email" id="email">
		<div class="star" id="star5">*</div>
		<div class="valid"id="valid5">do not type space</div>
		<p>Expected Salary</p>
		<input type="text" name="salary" id="salary">
		<div class="star" id="star6">*</div>
		<div class="valid"id="valid6">do not type space</div>
		<p>Major Education</p>
		<select name="education">
			<option value="Graduate School">Graduate School</option>
			<option value="Undergraduate School">Undergraduate School</option>
			<option value="Senior High School">Senior High School</option>
			<option value="Junior High School">Junior High School</option>
			<option value="Elementary School">Elementary School</option>
		</select>
		<p>Specialty</p>
		<?php
			$sql = "SELECT * FROM `jangsc27_cs`.`specialty`";
			$sth = $db->prepare($sql);
			$sth->execute();
			while($result = $sth->fetchObject()){
				echo '<input type="checkbox" value="'.$result->id.'" name="'.$result->id.'">'.$result->specialty;
			}
		?>
		</select>
		<input type="hidden" name="who" value=0></br></br></br>
		<input type="image" src="image/submit.png" onclick="send()">
		<input type="image" src="image/reset.png" onclick="reset();return false;">
	</form>
	<input type="image" src="image/back.png" onclick="location.href=('logout.php')">
	</body>
</html>
