<?php
require_once "../sysconfig.php";
?>
<html>
<head>
</head>
<meta charset="utf-8" />
<body>
<form style="display:inline;" action="function/add_news.php" method="POST" id="add_news_ajaxForm">
<h3>Add news</h3>
<p>Title</p>
<input class="k-textbox" name="title" id="news_title" style="width:300px;"></br>
<p>Content</p>
<textarea class="k-textbox" name="content" id="news_content" style="width:90%;height:150%;"></textarea></br>
<input class = "k-button" style="width: auto;" type="submit" value="Submit" name="submit" onclick="add_news_submit()">
</form>

</body>
	
</html>

