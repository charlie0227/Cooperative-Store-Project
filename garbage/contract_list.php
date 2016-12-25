<?php
require_once "sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`contract` WHERE `member1_id`= ? OR `member2_id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_SESSION['id'],$_SESSION['id']));

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<script src="jquery-tablepage-1.0.js"></script>
<script src="contract.js"></script>
<script src="store.js"></script>
<script src="account.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="jquery-1.12.4.min.js"></script>
<script src="jquery-tablepage-1.0.js"></script>
<script type="text/javascript"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>

</style>
<script>
	$(document).ready( function() {
			$("#tbl").tablepage($("#table_page"), 5);
	});
	
			
			
</script>
</head>
<body>

		<table id='tbl'>
		<thead>
		<tr>
		<th style = "width: 12%;">NAME</th>
		<th style = "width: 18%;">PHONE</th>
		<th style = "width: 24%;">ADDRESS</th>
		<th style = "width: 24%;">CONTENT</th>
		<th style = "width: 12%;">IMAGE</th>
		<th style = "width: 10%;">CONTRACT</th>
		</tr>
		</thead>
		<tbody>
		
		<?
		while($store_match=$sth->fetchObject()){
			$sql_my = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id` =?";
			$sth_my = $db->prepare($sql_my);
			$sth_my->execute(array($store_match->store_id));		
			if($result = $sth_my->fetchObject()){  
					$you= ($store_match->member1_id==$_SESSION['id']) ? $store_match->member2_id:$store_match->member1_id;
					
					$sql_img = "SELECT * FROM `jangsc27_cs_project`.`image` where `store_id` = ?";
					$sth_img = $db->prepare($sql_img);
					$sth_img->execute(array($result->id));
					?>
					<tr>
					<td><p onclick="manage_store(<?echo $result->id?>,<?echo $_GET['gtype']?>)"><?echo $result->name?><p></td>
					<td><?echo $result->phone?></td>
					<td><?echo $result->address?></td>
					<td><?echo $result->content?></td>
					<td>
					<?
					while($img_result = $sth_img->fetch()){
						echo '<img src="data:'.$img_result['image_type'].';base64,'.$img_result['image'].'" heigh="150" width="150"/>';
					}?>
					</td>
					<td>
					<input class = "abutton" type="button" value="contract" onclick="get_contract(<?echo $_SESSION['id']?>,<?echo $you?>,<?echo $result->id?>)">
					</td>
					</tr>
			<?
			}
		}
		?>
		</table>
		<span id="table_page"></span>
</body>
</html>