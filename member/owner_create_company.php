<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` ";
if($_GET['word']){
	$sql=$sql."WHERE `name` LIKE '%".$_GET['word']."%'";
}
$sth = $db->prepare($sql);
$sth->execute();
echo '<div id = "list"><table class="bordered">
		<tbody>';
if(!$sth->fetchObject()){
	echo '<tr><td>�䤣��A�����~</td></tr>';
	echo '<tr><td><input type="button" onclick="add_new_company()" value="�e���s�W"></td></tr>';
}
while($result = $sth->fetchObject()){?>
	<tr><td onclick="owner_show_company(<?echo $result->id?>)"><a href="#" class="big-link" data-reveal-id="show_box"><?echo $result->name?></a></td></tr>
<?}?> 
	</tbody>
</table></div>