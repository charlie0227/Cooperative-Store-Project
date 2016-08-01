<?php
require_once "sysconfig.php";
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="assets/js/main.js"></script>

<script type="text/javascript" language="JavaScript">
	var rval;
		function checkEmail() {
			var remail = $("#email").val();
			var emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
			if (remail.search(emailRule)!=-1) {
				$.post("send_auth.php",
				{
				  datatype:'text',
				  remail:remail
				  
				},
				function(data){
					rval = data;
					//alert(rval);
				});
				document.getElementById("text1").innerHTML = 'Please check your e-mail >_<';
				document.getElementById("send").value = 'Send again 0.0';
			}
			else {
				alert("False");
				//$("#form").focus();
			}
		}
		function check_rval(){
			var c = $("#check_num").val();
			var result = rval.replace(/\r\n|\n/g,"");
			result = result.replace(/\s+/g, "");
			if(result==c){
				alert("Correct");
			}
			else{
				alert("Wrong");
			}
		}
</script>

<script type="text/javascript" language="JavaScript">

<?
$sql = "SELECT account FROM `jangsc27_cs_project`.`member`";
$sth = $db->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
?>


/*
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
	$("#password").blur(function(){
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
	$("#name").blur(function(){
		var str=$(this).val();
		if(str) 
			$("#star6").hide();
		else $("#star6").show();
		if(str.match(" ")) 
			$("#valid6").show();
		else $("#valid6").hide();
	});
});
*/
</script>
</head>

<body>
<form style="display:inline;" action="register_account.php" method="POST">
<table>
<tr>
<td>
	<h3>Fill in Your info</h3>
</td>
</tr>

<tr>
<td>
	Account
</td>
</tr>	
	
<tr>
<td>
	<input type="text" id="register_account" name="account">
	<div class="star" id="star1">*</div>
	<div class="valid"id="valid1">do not type space</div>
	<div class="valid"id="register_zz">Reapted Account</div>
</td>
</tr>
		
<tr>
<td>
	Password
</td>
</tr>
<tr>
<td>
	<input type="password" id="register_password" name="password">
	<div class="star" id="star2">*</div>
	<div class="valid"id="valid2">do not type space</div>
</td>
</tr>			

<tr>
<td>
	name
</td>
</tr>

<tr>
<td>
	<input type="text" id="name" name="name">
	<div class="star" id="star6">*</div>
	<div class="valid"id="valid6">do not type space</div>
</td>
</tr>		

<tr>
<td>
	Phone
</td>
</tr>
	
<tr>
<td>
	<input type="text" id="phone" name="phone">
	<div class="star" id="star3">*</div>
	<div class="valid"id="valid3">do not type space</div>
</td>
</tr>	
		
<tr>
<td>
	Gender
</td>
</tr>

<tr>
<td>
	<input type="radio" id="male" name="gender" value="1" class="gender">
	<label for "male">Male</label>
</td>
<td>
	<input type="radio" id="female" name="gender" value="0" class="gender">
	<label for "female">Female</label>
	<div class="star" id="star4">*</div>
</td>
</tr>	
		<p></p>

<tr>
<td>
	Birth
</td>
</tr>
		
<tr>
<td>
	年:
	<select name="year">
		　  <option value="1911">1911</option>
			<option value="1912">1912</option>
			<option value="1913">1913</option>
			<option value="1914">1914</option>
			<option value="1915">1915</option>
			<option value="1916">1916</option>
			<option value="1917">1917</option>
			<option value="1918">1918</option>
			<option value="1919">1919</option>
			<option value="1920">1920</option>
			<option value="1921">1921</option>
			<option value="1922">1922</option>
			<option value="1923">1923</option>
			<option value="1924">1924</option>
			<option value="1925">1925</option>
			<option value="1926">1926</option>
			<option value="1927">1927</option>
			<option value="1928">1928</option>
			<option value="1929">1929</option>
			<option value="1930">1930</option>
			<option value="1931">1931</option>
			<option value="1932">1932</option>
			<option value="1933">1933</option>
			<option value="1934">1934</option>
			<option value="1935">1935</option>
			<option value="1936">1936</option>
			<option value="1937">1937</option>
			<option value="1938">1938</option>
			<option value="1939">1939</option>
			<option value="1940">1940</option>
			<option value="1941">1941</option>
			<option value="1942">1942</option>
			<option value="1943">1943</option>
			<option value="1944">1944</option>
			<option value="1945">1945</option>
			<option value="1946">1946</option>
			<option value="1947">1947</option>
			<option value="1948">1948</option>
			<option value="1949">1949</option>
			<option value="1950">1950</option>
			<option value="1951">1951</option>
			<option value="1952">1952</option>
			<option value="1953">1953</option>
			<option value="1954">1954</option>
			<option value="1955">1955</option>
			<option value="1956">1956</option>
			<option value="1957">1957</option>
			<option value="1958">1958</option>
			<option value="1959">1959</option>
			<option value="1960">1960</option>
			<option value="1961">1961</option>
			<option value="1962">1962</option>
			<option value="1963">1963</option>
			<option value="1964">1964</option>
			<option value="1965">1965</option>
			<option value="1966">1966</option>
			<option value="1967">1967</option>
			<option value="1968">1968</option>
			<option value="1969">1969</option>
			<option value="1970">1970</option>
			<option value="1971">1971</option>
			<option value="1972">1972</option>
			<option value="1973">1973</option>
			<option value="1974">1974</option>
			<option value="1975">1975</option>
			<option value="1976">1976</option>
			<option value="1977">1977</option>
			<option value="1978">1978</option>
			<option value="1979">1979</option>
			<option value="1980">1980</option>
			<option value="1981">1981</option>
			<option value="1982">1982</option>
			<option value="1983">1983</option>
			<option value="1984">1984</option>
			<option value="1985">1985</option>
			<option value="1986">1986</option>
			<option value="1987">1987</option>
			<option value="1988">1988</option>
			<option value="1989">1989</option>
			<option value="1990">1990</option>
			<option value="1991">1991</option>
			<option value="1992">1992</option>
			<option value="1993">1993</option>
			<option value="1994">1994</option>
			<option value="1995">1995</option>
			<option value="1996">1996</option>
			<option value="1997">1997</option>
			<option value="1998">1998</option>
			<option value="1999">1999</option>
			<option value="2000">2000</option>
			<option value="2001">2001</option>
			<option value="2002">2002</option>
			<option value="2003">2003</option>
			<option value="2004">2004</option>
			<option value="2005">2005</option>
			<option value="2006">2006</option>
			<option value="2007">2007</option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
			<option value="2019">2019</option>
			<option value="2020">2020</option>
		</select>
</td>
<td>
	月:
	<select name="month">
	　<option value="01">1</option>
	　<option value="02">2</option>
	　<option value="03">3</option>
	　<option value="04">4</option>
	　<option value="05">5</option>
	　<option value="06">6</option>
	　<option value="07">7</option>
	　<option value="08">8</option>
	　<option value="09">9</option>
	　<option value="10">10</option>
	　<option value="11">11</option>
	　<option value="12">12</option>
	</select>
</td>
<td>
	日:
	<select name="date">
	　<option value="01">1</option>
	　<option value="02">2</option>
	　<option value="03">3</option>
	　<option value="04">4</option>
	　<option value="05">5</option>
	　<option value="06">6</option>
	　<option value="07">7</option>
	　<option value="08">8</option>
	　<option value="09">9</option>
	　<option value="10">10</option>
	　<option value="11">11</option>
	　<option value="12">12</option>
	　<option value="13">13</option>
	　<option value="14">14</option>
	　<option value="15">15</option>
	　<option value="16">16</option>
	　<option value="17">17</option>
	　<option value="18">18</option>
	　<option value="19">19</option>
	　<option value="20">20</option>
	　<option value="21">21</option>
	　<option value="22">22</option>
	　<option value="23">23</option>
	　<option value="24">24</option>
	　<option value="25">25</option>
	　<option value="26">26</option>
	　<option value="27">27</option>
	　<option value="28">28</option>
	　<option value="29">29</option>
	　<option value="30">30</option>
	　<option value="31">31</option>
	</select>
</td>
</tr>		
		
		
<tr>
<td>
Email Address
</td>		
</tr>		
		
<tr>
<td>
	<input type="text" id="email" name="email" size="15">
	<input id="send" type="button" value="Send Captcha" onClick="checkEmail()">
	<div id="text1"></div>
	<div class="star" id="star5">*</div>
	<div class="valid"id="valid5">do not type space</div>
</td>		
</tr>
<tr>
<td>
	<div id="form">
		驗證碼：<input type="text" id="check_num" name="rval" size="15">
		<input type="button" value="check" onClick="check_rval()">
	</div>
</td>
</tr>		
<tr>
<td>
	<input class = "abutton" style = "width: 100px;"type="submit" value="OK" >	
	<input class = "abutton" style = "width: 100px;" type="button" value="reset" onclick="reset();return false;">	
</td>		
</tr>	
	
<tr>
<td>
	<input class = "abutton" style = "width: 100px;" type="button" value="back" onclick="location.href=('index.php')">
</tr>
</td>						
		
</table>
</form>

</body>
	
</html>


