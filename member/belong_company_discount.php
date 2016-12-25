<?php
require_once "../sysconfig.php";
if(isset($_GET['company_id'])){
	$sql = "SELECT *,a.id as store_id FROM `jangsc27_cs_project`.`store` a JOIN `jangsc27_cs_project`.`contract` b ON a.`id` = b.`store_id` AND b.`company_id` = ?";
	$sth1 = $db->prepare($sql);
	$sth1->execute(array($_GET['company_id']));

	echo '<H2>合作店家</H2>';
		while($result_store = $sth1->fetchObject()){
			#name?>
			<a href="#" class="big-link" data-reveal-id="show_box"><input class="k-button" type="button" value="<?echo $result_store->name?>" onclick="show_belong_store_content(<?echo $result_store->store_id?>,'store_map')"></a>
			<?#discount
			$res=$result_store->content;
			$data = json_decode($res);
			echo '打卡享有 ';
			if($data->method=="dynamic"){
				$sql = "SELECT COUNT(*) AS num FROM `population` WHERE `company_id`= ? AND `store_id`= ?";
				$sth2 = $db->prepare($sql);
				$sth2->execute(array($_GET['company_id'],$result_store->store_id));
				$re=$sth2->fetchObject()->num;
				$temp=floor($re/$data->people);
				$discount=intval($data->big)-$temp;
				$discount=($discount<intval($data->small))?intval($data->small):$discount;
			}
			else
				$discount=intval($data->discount);
			$discount=($discount%10==0)?$discount/10:$discount;
			echo $discount.'折優惠!<br>';
		}
}
?>
