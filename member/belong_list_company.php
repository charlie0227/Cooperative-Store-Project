<?
require_once "../sysconfig.php";

$sql = "SELECT * FROM `jangsc27_cs_project`.`company` a JOIN `jangsc27_cs_project`.`member_belong` b ON a.`id` = b.`company_id` AND b.`member_id` = ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id']));
echo '<table>';
echo '以下是你所屬的團體以及擁有的優惠';
while($result=$sth->fetchObject()){?>
	<tr><td><input class="k-button" type="button" onclick="show_discount(<?echo $result->id?>,<?echo $_GET['store_id']?>)" value="<?echo $result->name?>"></td>
	<td>
	<?
	
	$sql = "SELECT `content` FROM `jangsc27_cs_project`.`contract` WHERE company_id =? AND store_id = ?";
	$sth1 = $db->prepare($sql);
	$sth1->execute(array($result->id,$_GET['store_id']));
	$res=$sth1->fetchObject()->content;
	
	$data = json_decode($res);
	if($data){
		echo '打卡享有 ';
		if($data->method=="dynamic"){
			$sql = "SELECT COUNT(*) AS num FROM `population` WHERE `company_id`= ? AND `store_id`= ?";
			$sth2 = $db->prepare($sql);
			$sth2->execute(array($re->id,$_GET['store_id']));
			$re=$sth2->fetchObject()->num;
			$temp=floor($re/$data->people);
			$discount=$data->big-$temp;
			if($discount<$data->small){
				$discount=split ('[0]', $data->small);
				echo $discount[0];
			}
			else{
				$discount=split ('[0]', $discount);
				echo $discount[0];
			}
		
		}
		else{
			$discount=split ('[0]', $data->discount);
			echo $discount[0];
		}
		echo '優惠!';
	}
	else{
		echo "還未跟此家店簽約喔~~~";
	}
	echo "</td></tr>"
	?>
	
<?}
echo '</table>';
?>
