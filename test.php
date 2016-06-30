<?php
require_once "sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['store_id']));
?>

<html>
<head>
<script>
function searchforstore() {
	alert("TEESt");
	var str = document.getElementById("search_type").value;
	alert(str);
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
		var sth = document.getElementById("searchfor").value;
        xmlhttp.open("GET","test2.php?search="+str+"&searchfor="+sth,true);
		xmlhttp.send();
		
    }
}


</script>
</head>
<body>

<form>
<select name="search_type" id="search_type" onchange="showUser(this.value)">
    <option value="1">ID</option>
	<option value="2">NAME</option>
	<option value="3">PHONE</option>
	<option value="4">ADDRESS</option>
	<option value="5">CONTENT</option>
  </select>
</form>
<td style = "height:30px;"><input type="text" name="searchfor" id="searchfor" placeholder="Search"></td>
<td style = "height:30px;"><input type="button" name="search_btn" value="search" onclick="searchforstore()"></td>
</td>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>