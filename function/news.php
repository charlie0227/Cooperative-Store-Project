<?
require_once "../sysconfig.php";
?>

<div id = "new" name="qt1">
	<h1>Latest News</h1>
	<?if($_SESSION['id']==22||$_SESSION['id']==23||$_SESSION['id']==24){?>
	<a href="#" class="big-link" data-reveal-id="show_box"><input type="button" class="k-button" style="width:auto;" value="Add news" onclick="add_news()"/></a>
	<?}?>	
	
	
	<article id="news_content">
			
		</article>	
</div>


