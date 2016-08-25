<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`news` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_POST['news_id']));
$result = $sth->fetchObject();
$content = $result->content;
$news_id=$_POST['news_id'];
if(!$result){
	//echo "False";
	//echo $_POST['news_id'];
}
else{?>
	<header>
		<h1><?echo $result->title?></h1>
		<h2><?echo $result->time?><h2>
	</header>
	<div style="max-width:700px; word-wrap:break-word;"><?echo $result->content?></div>
	<?if($_SESSION['id']==22||$_SESSION['id']==23||$_SESSION['id']==24){?>
	<input type="button" class="k-button" value="Delete" onclick="delete_news(<?echo $news_id?>)">
<?
	}
}
?>
