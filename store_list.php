<?php
require_once "sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['store_id']));
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
            })
			
			
        </script>
</head>
<body>

		<table id='tbl'>
		<thead>
		<tr>
		<th style = "width: 240px;">NAME</th>
		<th style = "width: 360px;">PHONE</th>
		<th style = "width: 480px;">ADDRESS</th>
		<th style = "width: 480px;">CONTENT</th>
		<th style = "width: 240px;">IMAGE</th>
		</tr>
		</thead>
		<tbody>
		
		<?
		$check = 0;//for search or change my store
		$sql = "SELECT * FROM `jangsc27_cs_project`.`store` ";
		if($_GET['search']!=NULL){
			if($_GET['search']=="My Store"){
				
				$check = 1;
				$sql_my = "SELECT * FROM `jangsc27_cs_project`.`member_store` WHERE `member_id` =?";
				$sth_my = $db->prepare($sql_my);
				$sth_my->execute(array($_GET['searchfor']));
				$sth = $db->prepare($sql);
				$sth->execute();
			}
			else{
				$check = 0;
				if($_GET['search']=="1"){
					$sql = $sql."WHERE `id` LIKE :term ";
				}
				else if($_GET['search']=="2"){
					$sql = $sql."WHERE `name` LIKE :term ";
				}
				else if($_GET['search']=="3"){
					$sql = $sql."WHERE `phone` LIKE :term ";
				}
				else if($_GET['search']=="4"){
					$sql = $sql."WHERE `address` LIKE :term ";
				}
				else if($_GET['search']=="5"){
					$sql = $sql."WHERE `content` LIKE :term ";
				}
				$sth = $db->prepare($sql);
				$sth->execute(array(":term" => "%" . $_GET['searchfor'] . "%"));
			}
			
		}
		
		while($result = $sth->fetchObject()){  
			if($check=='1'){
				while($result_my = $sth_my->fetchObject()){
					if($result->id==$result_my->store_id){
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
							$ttt=$_GET['gtype'];
							echo '<img onclick="manage_store('.$result->id.','.$ttt.')" src="data:'.$img_result['image_type'].';base64,'.$img_result['image'].'" heigh="150" width="150"/>';
						}
						echo '</td></tr>';
					}
				}
				$sth_my->execute(array($_GET['searchfor']));
			
			}
			else{
				//Find image correspond to store_id
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
					$ttt=$_GET['gtype'];
					echo '<img onclick="manage_store('.$result->id.','.$ttt.')" src="data:'.$img_result['image_type'].';base64,'.$img_result['image'].'" heigh="150" width="150"/>';
				}
				echo '</td></tr>';
			}
			
			
		}
		?>
		</table>
		<span id="table_page"></span>
</body>
</html>