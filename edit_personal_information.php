<?
require_once "sysconfig.php";
?>
<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" href="ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8">

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollzer.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script type="text/javascript" src="../jquery/jquery.ui.datepicker-zh-TW.js"></script>
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->	
<script src="assets/js/main.js"></script>

<?
$sql = "SELECT * FROM `jangsc27_cs_project`.`member` where `id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
$result=$sth->fetchObject();
?>
<script type="text/javascript">
$(document).ready(function(){
    $(".valid").hide();
	$("input").focus(function(){
        $(this).css("background-color", "#cccccc");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
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
</script>
</head>
<body>
<table>
	<tr>
	<td>
		Account
	</td>
	</tr>
	<tr>
	<td>
		<?echo $result->account?><br>
	</td>
	</tr>
	<tr>
	<td>
		name
	</td>
	</tr>	
	<tr>
	<td>
		<input type="text" id="edit_person_name" name="name" value="<?echo $result->name?>">
		<div class="star" ></div>
		<div class="valid"id="valid6" id="star6">do not type space</div>
	</td>
	</tr>
	<tr>
	<td>
		Phone
	</td>
	</tr>	
	<tr>
	<td>
		<input type="text" id="phone"name="phone" value="<?echo $result->phone?>">
		<div class="star" id="star3">*</div>
	</td>
	</tr>	
	<tr>
	<td>
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
		<input type="radio" id="male" name="gender" value="1" class="gender"<?if($result->gender==1) echo ' checked="checked" '?>>
		<label for "male">Male</label>
		<input type="radio" id="female" name="gender" value="0" class="gender"<?if($result->gender==0) echo ' checked="checked" '?>>
		<label for "female">Female</label>
		<div class="star" id="star4">*</div>
	</td>
	</tr>

	<tr>
	<td>
		birth
		<?
		$year=substr($result->birth,0,4);
		$month=substr($result->birth,5,2);
		$day=substr($result->birth,8,2);
		?>
	</td>
	</tr>
	
	<tr>
	<td>
		年:<select name="year" id="year">
		　   <option value="1911"<?if($year==1911) echo ' selected="selected" '?>>1911</option>
			 <option value="1912"<?if($year==1912) echo ' selected="selected" '?>>1912</option>
			 <option value="1913"<?if($year==1913) echo ' selected="selected" '?>>1913</option>
			 <option value="1914"<?if($year==1914) echo ' selected="selected" '?>>1914</option>
			 <option value="1915"<?if($year==1915) echo ' selected="selected" '?>>1915</option>
			 <option value="1916"<?if($year==1916) echo ' selected="selected" '?>>1916</option>
			 <option value="1917"<?if($year==1917) echo ' selected="selected" '?>>1917</option>
			 <option value="1918"<?if($year==1918) echo ' selected="selected" '?>>1918</option>
			 <option value="1919"<?if($year==1919) echo ' selected="selected" '?>>1919</option>
			 <option value="1920"<?if($year==1920) echo ' selected="selected" '?>>1920</option>
			 <option value="1921"<?if($year==1921) echo ' selected="selected" '?>>1921</option>
			 <option value="1922"<?if($year==1922) echo ' selected="selected" '?>>1922</option>
			 <option value="1923"<?if($year==1923) echo ' selected="selected" '?>>1923</option>
			 <option value="1924"<?if($year==1924) echo ' selected="selected" '?>>1924</option>
			 <option value="1925"<?if($year==1925) echo ' selected="selected" '?>>1925</option>
			 <option value="1926"<?if($year==1926) echo ' selected="selected" '?>>1926</option>
			 <option value="1927"<?if($year==1927) echo ' selected="selected" '?>>1927</option>
			 <option value="1928"<?if($year==1928) echo ' selected="selected" '?>>1928</option>
			 <option value="1929"<?if($year==1929) echo ' selected="selected" '?>>1929</option>
			 <option value="1930"<?if($year==1930) echo ' selected="selected" '?>>1930</option>
			 <option value="1931"<?if($year==1931) echo ' selected="selected" '?>>1931</option>
			 <option value="1932"<?if($year==1932) echo ' selected="selected" '?>>1932</option>
			 <option value="1933"<?if($year==1933) echo ' selected="selected" '?>>1933</option>
			 <option value="1934"<?if($year==1934) echo ' selected="selected" '?>>1934</option>
			 <option value="1935"<?if($year==1935) echo ' selected="selected" '?>>1935</option>
			 <option value="1936"<?if($year==1936) echo ' selected="selected" '?>>1936</option>
			 <option value="1937"<?if($year==1937) echo ' selected="selected" '?>>1937</option>
			 <option value="1938"<?if($year==1938) echo ' selected="selected" '?>>1938</option>
			 <option value="1939"<?if($year==1939) echo ' selected="selected" '?>>1939</option>
			 <option value="1940"<?if($year==1940) echo ' selected="selected" '?>>1940</option>
			 <option value="1941"<?if($year==1941) echo ' selected="selected" '?>>1941</option>
			 <option value="1942"<?if($year==1942) echo ' selected="selected" '?>>1942</option>
			 <option value="1943"<?if($year==1943) echo ' selected="selected" '?>>1943</option>
			 <option value="1944"<?if($year==1944) echo ' selected="selected" '?>>1944</option>
			 <option value="1945"<?if($year==1945) echo ' selected="selected" '?>>1945</option>
			 <option value="1946"<?if($year==1946) echo ' selected="selected" '?>>1946</option>
			 <option value="1947"<?if($year==1947) echo ' selected="selected" '?>>1947</option>
			 <option value="1948"<?if($year==1948) echo ' selected="selected" '?>>1948</option>
			 <option value="1949"<?if($year==1949) echo ' selected="selected" '?>>1949</option>
			 <option value="1950"<?if($year==1950) echo ' selected="selected" '?>>1950</option>
			 <option value="1951"<?if($year==1951) echo ' selected="selected" '?>>1951</option>
			 <option value="1952"<?if($year==1952) echo ' selected="selected" '?>>1952</option>
			 <option value="1953"<?if($year==1953) echo ' selected="selected" '?>>1953</option>
			 <option value="1954"<?if($year==1954) echo ' selected="selected" '?>>1954</option>
			 <option value="1955"<?if($year==1955) echo ' selected="selected" '?>>1955</option>
			 <option value="1956"<?if($year==1956) echo ' selected="selected" '?>>1956</option>
			 <option value="1957"<?if($year==1957) echo ' selected="selected" '?>>1957</option>
			 <option value="1958"<?if($year==1958) echo ' selected="selected" '?>>1958</option>
			 <option value="1959"<?if($year==1959) echo ' selected="selected" '?>>1959</option>
			 <option value="1960"<?if($year==1960) echo ' selected="selected" '?>>1960</option>
			 <option value="1961"<?if($year==1961) echo ' selected="selected" '?>>1961</option>
			 <option value="1962"<?if($year==1962) echo ' selected="selected" '?>>1962</option>
			 <option value="1963"<?if($year==1963) echo ' selected="selected" '?>>1963</option>
			 <option value="1964"<?if($year==1964) echo ' selected="selected" '?>>1964</option>
			 <option value="1965"<?if($year==1965) echo ' selected="selected" '?>>1965</option>
			 <option value="1966"<?if($year==1966) echo ' selected="selected" '?>>1966</option>
			 <option value="1967"<?if($year==1967) echo ' selected="selected" '?>>1967</option>
			 <option value="1968"<?if($year==1968) echo ' selected="selected" '?>>1968</option>
			 <option value="1969"<?if($year==1969) echo ' selected="selected" '?>>1969</option>
			 <option value="1970"<?if($year==1970) echo ' selected="selected" '?>>1970</option>
			 <option value="1971"<?if($year==1971) echo ' selected="selected" '?>>1971</option>
			 <option value="1972"<?if($year==1972) echo ' selected="selected" '?>>1972</option>
			 <option value="1973"<?if($year==1973) echo ' selected="selected" '?>>1973</option>
			 <option value="1974"<?if($year==1974) echo ' selected="selected" '?>>1974</option>
			 <option value="1975"<?if($year==1975) echo ' selected="selected" '?>>1975</option>
			 <option value="1976"<?if($year==1976) echo ' selected="selected" '?>>1976</option>
			 <option value="1977"<?if($year==1977) echo ' selected="selected" '?>>1977</option>
			 <option value="1978"<?if($year==1978) echo ' selected="selected" '?>>1978</option>
			 <option value="1979"<?if($year==1979) echo ' selected="selected" '?>>1979</option>
			 <option value="1980"<?if($year==1980) echo ' selected="selected" '?>>1980</option>
			 <option value="1981"<?if($year==1981) echo ' selected="selected" '?>>1981</option>
			 <option value="1982"<?if($year==1982) echo ' selected="selected" '?>>1982</option>
			 <option value="1983"<?if($year==1983) echo ' selected="selected" '?>>1983</option>
			 <option value="1984"<?if($year==1984) echo ' selected="selected" '?>>1984</option>
			 <option value="1985"<?if($year==1985) echo ' selected="selected" '?>>1985</option>
			 <option value="1986"<?if($year==1986) echo ' selected="selected" '?>>1986</option>
			 <option value="1987"<?if($year==1987) echo ' selected="selected" '?>>1987</option>
			 <option value="1988"<?if($year==1988) echo ' selected="selected" '?>>1988</option>
			 <option value="1989"<?if($year==1989) echo ' selected="selected" '?>>1989</option>
			 <option value="1990"<?if($year==1990) echo ' selected="selected" '?>>1990</option>
			 <option value="1991"<?if($year==1991) echo ' selected="selected" '?>>1991</option>
			 <option value="1992"<?if($year==1992) echo ' selected="selected" '?>>1992</option>
			 <option value="1993"<?if($year==1993) echo ' selected="selected" '?>>1993</option>
			 <option value="1994"<?if($year==1994) echo ' selected="selected" '?>>1994</option>
			 <option value="1995"<?if($year==1995) echo ' selected="selected" '?>>1995</option>
			 <option value="1996"<?if($year==1996) echo ' selected="selected" '?>>1996</option>
			 <option value="1997"<?if($year==1997) echo ' selected="selected" '?>>1997</option>
			 <option value="1998"<?if($year==1998) echo ' selected="selected" '?>>1998</option>
			 <option value="1999"<?if($year==1999) echo ' selected="selected" '?>>1999</option>
			 <option value="2000"<?if($year==2000) echo ' selected="selected" '?>>2000</option>
			 <option value="2001"<?if($year==2001) echo ' selected="selected" '?>>2001</option>
			 <option value="2002"<?if($year==2002) echo ' selected="selected" '?>>2002</option>
			 <option value="2003"<?if($year==2003) echo ' selected="selected" '?>>2003</option>
			 <option value="2004"<?if($year==2004) echo ' selected="selected" '?>>2004</option>
			 <option value="2005"<?if($year==2005) echo ' selected="selected" '?>>2005</option>
			 <option value="2006"<?if($year==2006) echo ' selected="selected" '?>>2006</option>
			 <option value="2007"<?if($year==2007) echo ' selected="selected" '?>>2007</option>
			 <option value="2008"<?if($year==2008) echo ' selected="selected" '?>>2008</option>
			 <option value="2009"<?if($year==2009) echo ' selected="selected" '?>>2009</option>
			 <option value="2010"<?if($year==2010) echo ' selected="selected" '?>>2010</option>
			 <option value="2011"<?if($year==2011) echo ' selected="selected" '?>>2011</option>
			 <option value="2012"<?if($year==2012) echo ' selected="selected" '?>>2012</option>
			 <option value="2013"<?if($year==2013) echo ' selected="selected" '?>>2013</option>
			 <option value="2014"<?if($year==2014) echo ' selected="selected" '?>>2014</option>
			 <option value="2015"<?if($year==2015) echo ' selected="selected" '?>>2015</option>
			 <option value="2016"<?if($year==2016) echo ' selected="selected" '?>>2016</option>
			 <option value="2017"<?if($year==2017) echo ' selected="selected" '?>>2017</option>
			 <option value="2018"<?if($year==2018) echo ' selected="selected" '?>>2018</option>
			 <option value="2019"<?if($year==2019) echo ' selected="selected" '?>>2019</option>
			 <option value="2020"<?if($year==2020) echo ' selected="selected" '?>>2020</option>
		</select>
	</td>
	<td>	
		月:<select name="month" id="month">
		　<option value="01"<?if($month==01) echo ' selected="selected" '?>>1</option>
		　<option value="02"<?if($month==02) echo ' selected="selected" '?>>2</option>
		　<option value="03"<?if($month==03) echo ' selected="selected" '?>>3</option>
		　<option value="04"<?if($month==04) echo ' selected="selected" '?>>4</option>
		　<option value="05"<?if($month==05) echo ' selected="selected" '?>>5</option>
		　<option value="06"<?if($month==06) echo ' selected="selected" '?>>6</option>
		　<option value="07"<?if($month==07) echo ' selected="selected" '?>>7</option>
		　<option value="08"<?if($month==08) echo ' selected="selected" '?>>8</option>
		　<option value="09"<?if($month==09) echo ' selected="selected" '?>>9</option>
		　<option value="10"<?if($month==10) echo ' selected="selected" '?>>10</option>
		　<option value="11"<?if($month==11) echo ' selected="selected" '?>>11</option>
		　<option value="12"<?if($month==12) echo ' selected="selected" '?>>12</option>
		</select>
	</td>
	<td>	
		日:<select name="date" id="date">
		 <option value="01"<?if($day==01) echo ' selected="selected" '?>>01</option>
		 <option value="02"<?if($day==02) echo ' selected="selected" '?>>02</option>
		 <option value="03"<?if($day==03) echo ' selected="selected" '?>>03</option>
		 <option value="04"<?if($day==04) echo ' selected="selected" '?>>04</option>
		 <option value="05"<?if($day==05) echo ' selected="selected" '?>>05</option>
		 <option value="06"<?if($day==06) echo ' selected="selected" '?>>06</option>
		 <option value="07"<?if($day==07) echo ' selected="selected" '?>>07</option>
		 <option value="08"<?if($day==08) echo ' selected="selected" '?>>08</option>
		 <option value="09"<?if($day==09) echo ' selected="selected" '?>>09</option>
		 <option value="10"<?if($day==10) echo ' selected="selected" '?>>10</option>
		 <option value="11"<?if($day==11) echo ' selected="selected" '?>>11</option>
		 <option value="12"<?if($day==12) echo ' selected="selected" '?>>12</option>
		 <option value="13"<?if($day==13) echo ' selected="selected" '?>>13</option>
		 <option value="14"<?if($day==14) echo ' selected="selected" '?>>14</option>
		 <option value="15"<?if($day==15) echo ' selected="selected" '?>>15</option>
		 <option value="16"<?if($day==16) echo ' selected="selected" '?>>16</option>
		 <option value="17"<?if($day==17) echo ' selected="selected" '?>>17</option>
		 <option value="18"<?if($day==18) echo ' selected="selected" '?>>18</option>
		 <option value="19"<?if($day==19) echo ' selected="selected" '?>>19</option>
		 <option value="20"<?if($day==20) echo ' selected="selected" '?>>20</option>
		 <option value="21"<?if($day==21) echo ' selected="selected" '?>>21</option>
		 <option value="22"<?if($day==22) echo ' selected="selected" '?>>22</option>
		 <option value="23"<?if($day==23) echo ' selected="selected" '?>>23</option>
		 <option value="24"<?if($day==24) echo ' selected="selected" '?>>24</option>
		 <option value="25"<?if($day==25) echo ' selected="selected" '?>>25</option>
		 <option value="26"<?if($day==26) echo ' selected="selected" '?>>26</option>
		 <option value="27"<?if($day==27) echo ' selected="selected" '?>>27</option>
		 <option value="28"<?if($day==28) echo ' selected="selected" '?>>28</option>
		 <option value="29"<?if($day==29) echo ' selected="selected" '?>>29</option>
		 <option value="30"<?if($day==30) echo ' selected="selected" '?>>30</option>
		 <option value="31"<?if($day==31) echo ' selected="selected" '?>>31</option>
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
		<input type="text"id="email" name="email" value="<?echo $result->email?>">
		<div class="star" id="star5">*</div>
		<div class="valid"id="valid5">do not type space</div>
	</td>
	</tr>	
		
	<tr>
	<td>
		<input class = "abutton" style = "width: 100px;"type="button" value="OK" onclick="func_edit_confirm()">
	</td>
	</tr>
		
</table>	
</body>
</html>