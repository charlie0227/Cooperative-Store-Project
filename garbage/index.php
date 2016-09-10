<?php
require_once "../sysconfig.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Kendo UI Snippet</title>

    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.common.min.css"/>
    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.rtl.min.css"/>
    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.silver.min.css"/>
    <link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.mobile.all.min.css"/>

    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://kendo.cdn.telerik.com/2016.2.714/js/kendo.all.min.js"></script>
	<style>
	html {
  background: #f2f2f2;
}

body {
	margin: 100px 20px;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight: 300;
  background: #fff;
  width: 80%;
  margin: 40px auto;
  padding: 20px;
  border: 1px solid #ddd;
}

li {
	margin-bottom: 10px;
}

.button {
	display: inline-block;
	background: hsl(40, 100%, 60%);
	color: hsl(40, 100%, 20%);
	text-decoration: none;
	padding: 5px 10px;
}

[data-notifications] {
	position: relative;
}

[data-notifications]:after {
	content: attr(data-notifications);
	position: absolute;
	background: red;
	border-radius: 50%;
	display: inline-block;
	padding: 0.3em;
	color: #f2f2f2;
	right: -15px;
	top: -15px;
}
	</style>
</head>
<body>
<ol>
  <li>
    <a data-notifications="19"><input type="button" data-notifications="19"  value="New Comments on Your Posts"></a>
  </li>
  <li>
    <a class="button" href="#">Number of Post Likes</a>
  </li>
<ol>


</body>
</html>