<!DOCTYPE html>
<html>
<head lang="zh-cn">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet"> 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> 
	<script type="text/javascript" src="../jquery/jquery.ui.datepicker-zh-TW.js"></script>
    <meta charset="UTF-8">
    <title>Progress</title>
	<!--<link rel="stylesheet" href="assets/css/main.css" />-->
<style>
    .progress{
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        height: 20px;
        background: #f5f5f5;
        border-bottom: 1px solid #ddd;
    }

    .progress-inner{
        width: 1%;
        background: #d43f3a;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
    }
</style>
</head>
<body>
<div class="progress">
    <div class="progress-inner" id="progress"></div>
</div><br><br>

<h1>sign the contract</h1>
<p id="demo">0</p>

<form hidden action="ptest.php" method="post" id='doc1' name='doc1'>

<label>Your name</label><input type="text" id='name1' name="name1"><br><br>
<label>Object signing</label><input type="text" id='name2' name="name2"><br><br>
Gender 
	<label><input name="gender" type="radio" value="male" checked>Male</label>
	<label><input name="gender" type="radio" value="female">Female</label><br><br>
<label>Telephone Number</label><input type="text" id='tel_num' name="tel_num"><br><br>
<label>address</label><input type="text" id='address' name="address"><br><br>
<label>e-mail</label><input type="email" id='email' name="email"><br><br>
<label>Discount</label>
<select name='SD' id="SD">
  <option selected value="Dynamic Discount">Dynamic Discount</option>
  <option value="Fixed Discount">Fixed Discount</option>
</select> <br>
<!-- Dynamic discount -->
<p id='dynamic_discount1' name='dynamic_discount1'>
For every
	<label><input name="dy_d1" type="radio" value="1000" checked>1000</label>
	<label><input name="dy_d1" type="radio" value="500">500</label>
	<label><input name="dy_d1" type="radio" value="other">other</label>
	<p hidden id='people_other'>
	<input id='people_other' type="text" />
	</p>
</p>
<p id='dynamic_discount2' name='dynamic_discount2'>
discount raise
	<label><input name="dy_d2" type="radio" value="0.1" checked>0.1</label>
	<label><input name="dy_d2" type="radio" value="0.01">0.01</label>
	<label><input name="dy_d2" type="radio" value="other">other</label>
</p>
<p hidden id='raise_other'>
<input id='raise_other' type="text"/>
</p>
<p id='dynamic_discount3' name='dynamic_discount3'>
Lowest discount
	<label><input name="dy_d3" type="radio" value="0.9" checked>10%off</label>
	<label><input name="dy_d3" type="radio" value="0.8">20%off</label>
	<label><input name="dy_d3" type="radio" value="other">other</label>
</p>
<p hidden id='lowest_other'>
<input id='lowest_other' type="text" min="0" max="100"/>
</p>
<!-- fix discount -->
<p hidden id='fix_discount' name='fix_discount'>
Discount
<label><input name="fix_d" type="radio" value="0.95" checked>5%off</label>
<label><input name="fix_d" type="radio" value="0.9">10%off</label>
<label><input name="fix_d" type="radio" value="other">other</label>
</p>
<p hidden id='fix_other'>
<input id='fix_other' type="text" min="0" max="100"/>
</p>

Effective Date<br>
<input id="datepicker1" type="text" /> <script language="JavaScript"> $(document).ready(function(){ $("#datepicker1").datepicker(); }); </script>
<!--<input type="submit" id="submit_self" value='send'>-->
</form>

<p hidden id="doc2"></p> 
<script>
$("#fix_discount").change(function(){
	var form = document.getElementById("doc1");
	for (var i=0; i<form.fix_d.length; i++)
	{
	   if (form.fix_d[i].checked)
	   {
		  var language = form.fix_d[i].value;
		  break;

	   }
	}
	
	var  fix_dv = form.fix_d.value;
	if(fix_dv=="other"){
		alert(fix_dv);
		$("#fix_other").show();
	}
	else{
		$("#fix_other").hide();
	}
}); 

$("#dynamic_discount1").change(function(){
	var form = document.getElementById("doc1");
	for (var i=0; i<form.dy_d1.length; i++)
	{
	   if (form.dy_d1[i].checked)
	   {
		  var language = form.dy_d1[i].value;
		  break;

	   }

	}
	
	var  dy_dv1 = form.dy_d1.value;
	if(dy_dv1=="other"){
		alert(dy_dv1);
		$("#people_other").show();
	}
	else{
		$("#people_other").hide();
	}
});

$("#dynamic_discount2").change(function(){
	var form = document.getElementById("doc1");
	for (var i=0; i<form.dy_d2.length; i++)
	{
	   if (form.dy_d2[i].checked)
	   {
		  var language = form.dy_d2[i].value;
		  break;

	   }

	}
	
	var  dy_dv2 = form.dy_d2.value;
	if(dy_dv2=="other"){
		alert(dy_dv2);
		$("#raise_other").show();
	}
	else{
		$("#raise_other").hide();
	}
});

$("#dynamic_discount3").change(function(){
	var form = document.getElementById("doc1");
	for (var i=0; i<form.dy_d3.length; i++)
	{
	   if (form.dy_d3[i].checked)
	   {
		  var language = form.dy_d3[i].value;
		  break;

	   }

	}
	
	var  dy_dv3 = form.dy_d3.value;
	if(dy_dv3=="other"){
		alert(dy_dv3);
		$("#lowest_other").show();
	}
	else{
		$("#lowest_other").hide();
	}
});

$("#SD").change(function(){
	var form = document.getElementById("doc1");
	var  sd = form.SD.value;
		
		if(sd=="Fixed Discount"){
			alert(sd);
			$("#fix_discount").show();
			$("#dynamic_discount1").hide();
			$("#dynamic_discount2").hide();
			$("#dynamic_discount3").hide();
			$("#people_other").hide();
			$("#raise_other").hide();
			$("#lowest_other").hide();
		}
		else{
			$("#dynamic_discount1").show();
			$("#dynamic_discount2").show();
			$("#dynamic_discount3").show();
			$("#fix_discount").hide();
			$("#fix_other").hide();
			
		}
});


var progress = 0;
function Ga() {
	var $progress = document.getElementById('progress');
	if (progress<100){
		progress = progress+20;
	}
	$progress.style.width = progress + '%';
	if (progress==20){	
		$("#doc1").show();
	}
	else if (progress==40){
		$("#doc1").hide();
		$("#doc2").show(function(){
			var form = document.getElementById("doc1");
			var name = "Your name: "
			var gen = "Gender: "
			var tel = "Telephone number: "
			var addr = "Your ddress: "
			var email = "Your email: "
			var dtype = "Discount type: "
			var details = ""
			var fe = "For every "
			var dr = " people, discount raises "
			var low = "Lowest discount: "
			var d = "Discount: "
			var eff = "Effective date: "
			var obj = "Object signing: "
			if ($('#SD').val()=="Dynamic Discount"){
				dd1 = form.dy_d1.value;
				dd2 = form.dy_d2.value;
				dd3 = form.dy_d3.value;
				if (dd1=="other"){
					dd1 = form.people_other.value;
				}
				if (dd2=="other"){
					dd2 = form.raise_other.value;
				}
				if (dd3=="other"){
					dd3 = form.lowest_other.value;
				}
				details = fe + dd1 + dr + dd2 +"<br>"+
						  low + dd3;
			}
			else if ($('#SD').val()=="Fixed Discount"){
			    fd = form.fix_d.value;
				if(fd=="other"){
					fd = form.fix_other.value
				}
				details = d + fd
			}
			document.getElementById("doc2").innerHTML = name + $('#name1').val() +"<br>"+
														obj + $('#name2').val() +"<br>"+
														gen + form.gender.value +"<br>"+
														tel + $('#tel_num').val()+"<br>"+
														addr + $('#address').val()+"<br>"+
														email + $('#email').val()+"<br>"+
														dtype + $('#SD').val()+"<br>"+
														details +"<br>"+
														eff + $('#datepicker1').val()
														
														;
		});
		
	}
	else if (progress==60){
		$("#doc2").hide();
	}
    return progress;              // The function returns the product of p1 and p2
}
function Sa() {
	var $progress = document.getElementById('progress');
	if (progress>0){
		progress = progress-20;
	}
	$progress.style.width = progress + '%';
	if (progress==0){
		$("#doc1").hide();
	}
	else if (progress==20){
		$("#doc1").show();
		$("#doc2").hide();
	}
	else if (progress==40){
		$("#doc1").hide();
		$("#doc2").show();
	}
	else if (progress==60){
		$("#doc2").hide();
	}
    return progress;              // The function returns the product of p1 and p2
}
document.getElementById("demo").innerHTML = progress;


</script>
<button type="buttom" id='back' onclick="document.getElementById('demo').innerHTML = Sa() ">
BACK</button>
<button type="submit" id='next' onclick="document.getElementById('demo').innerHTML = Ga() ">
NEXT</button>
</body>
</html>
