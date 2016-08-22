
<html>
<head>
</head>
<body>
<form style="display:inline;" action="function/register_account.php" method="POST">
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
	<div class="register_input" style="display:inline-flex">
		<input type="text" class="k-textbox" id="register_account" name="account" value=""><div style="color:red;">*</div>
	</div>
	
	<div hidden id="valid1" style="display:none; color:red;">Don't type space</div>
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
	<div class="register_input" style="display:inline-flex">
		<input class="k-textbox" type="password" id="register_password" name="password" value=""><div style="color:red;">*</div>
	</div>
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
	<div class="register_input" style="display:inline-flex">
		<input class="k-textbox" type="text" id="name" name="name" value=""><div style="color:red;">*</div>
	</div>
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
	<div class="register_input" style="display:inline-flex">
		<input class="k-textbox" type="text" id="phone" name="phone" value=""><div style="color:red;">*</div>
	</div>
	<div class="valid"id="valid3">do not type space</div>
</td>
</tr>	
		
<tr>
<td>
	Gender
</td>
</tr>

<tr><td>
<div class="gender_input" style="display:inline-flex">
		
			<input type="radio" id="male" name="gender" value="1" class="gender">
			<label for "male">Male</label>
		
		
			<input type="radio" id="female" name="gender" value="0" class="gender">
			<label for "female">Female</label>
		
		<div id="g_star" style="color:red;">*</div></td>
</div>

</tr>	
		<p></p>

<tr>
<td>
	Birth
</td>
</tr>
		
<tr>
<td>
	Year:
	<select class="k-select" name="year">
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
	Month:
	<select name="month">
	ก@<option value="01">1</option>
	ก@<option value="02">2</option>
	ก@<option value="03">3</option>
	ก@<option value="04">4</option>
	ก@<option value="05">5</option>
	ก@<option value="06">6</option>
	ก@<option value="07">7</option>
	ก@<option value="08">8</option>
	ก@<option value="09">9</option>
	ก@<option value="10">10</option>
	ก@<option value="11">11</option>
	ก@<option value="12">12</option>
	</select>
</td>
<td>
	Day:
	<select name="date">
	ก@<option value="01">1</option>
	ก@<option value="02">2</option>
	ก@<option value="03">3</option>
	ก@<option value="04">4</option>
	ก@<option value="05">5</option>
	ก@<option value="06">6</option>
	ก@<option value="07">7</option>
	ก@<option value="08">8</option>
	ก@<option value="09">9</option>
	ก@<option value="10">10</option>
	ก@<option value="11">11</option>
	ก@<option value="12">12</option>
	ก@<option value="13">13</option>
	ก@<option value="14">14</option>
	ก@<option value="15">15</option>
	ก@<option value="16">16</option>
	ก@<option value="17">17</option>
	ก@<option value="18">18</option>
	ก@<option value="19">19</option>
	ก@<option value="20">20</option>
	ก@<option value="21">21</option>
	ก@<option value="22">22</option>
	ก@<option value="23">23</option>
	ก@<option value="24">24</option>
	ก@<option value="25">25</option>
	ก@<option value="26">26</option>
	ก@<option value="27">27</option>
	ก@<option value="28">28</option>
	ก@<option value="29">29</option>
	ก@<option value="30">30</option>
	ก@<option value="31">31</option>
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
	<input id="send" type="button" class="abutton" style="width: auto;"value="Send Captcha" onClick="checkEmail()">
	<div id="text1"></div>
</td>		
</tr>
<tr>
<td>
	<div id="form">
		驗證碼：<input type="text" id="check_num" name="rval" size="15">
		<input type="button" class="abutton" style="width: auto;" value="check" onClick="check_rval()">
	</div>
</td>
<!--
	<div class="register_input" style="display:inline-flex">
		<input type="text" id="email" name="email" value=""><div style="color:red;">*</div>
	</div>
	<div class="valid"id="valid5">do not type space</div>
</td>		
-->
</tr>		
<tr>
<td>
	<input class = "abutton" id="Done" style = "width: 100px;"type="submit" value="Done" disabled>	
	<input class = "abutton" style = "width: 100px;" type="button" value="reset" onclick="reset();return false;">	
</td>		
</tr>	
	
<tr>
<td>
	<input class = "abutton" style = "width: 100px;" type="button" value="back" onclick="location.href=('../index.php')">
</tr>
</td>						
		
</table>
</form>

</body>
	
</html>