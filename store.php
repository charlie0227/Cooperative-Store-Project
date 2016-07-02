<?php
require_once "sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `id`= ?";
$sth = $db->prepare($sql);
$sth->execute(array($_GET['store_id']));
$result = $sth->fetchObject();
$temp = $result;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Geocoding</title>
	<script src="jquery-1.12.4.min.js"></script>
	<script src="contract.js"></script>
	<script src="store.js"></script>
	<script src="account.js"></script>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA7kv2J21zjjZ6-_0abHxjqRTlRgz5vSA1MZbuL2l0P1cs_mO7FRT360m_w5W8HA98LDNckSGFAzJMBg"
        type="text/javascript"></script>

    <script type="text/javascript">
	

		 $("#address").blur(function(){
			 alert("test");
		 });
		
		showAddress($("address"));
	});
	
    </script>
	
</head>
<body onload="initialize();showAddress('<?echo $temp->address?>')" onunload="GUnload()">
	<table><tr>
		<th>NAME</th>
		<th>PHONE</th>
		<th>ADDRESS</th>
		<th>CONTENT</th>
		</tr> 
		<?php
		if($result)
		{
			//Find image correspond to store_id
			$sql_img = "SELECT * FROM `jangsc27_cs_project`.`image` where `store_id` = ?";
			$sth_img = $db->prepare($sql_img);
			$sth_img->execute(array($result->id));
			echo '<tr>
			<td>'.$result->name.'</td>
			<td>'.$result->phone.'</td>
			<td>'.$result->address.'</td>
			<td>'.$result->content.'</td>';
			
			?>
			</tr>
			
			<?
			//edit
			if($_SESSION['id']){
				$sql_id = "SELECT * FROM `jangsc27_cs_project`.`member_store` WHERE `member_id`=? AND `store_id`=?";
				$sth_id = $db->prepare($sql_id);
				$sth_id->execute(array($_SESSION['id'],$result->id));
				$result_id = $sth_id->fetchObject();
				if($result_id){
					if($_GET['gtype']=="1"){
						
					
			?>
						
						<tr><td><input class = "abutton" style = "width: 100px;"type="button" onclick="go_edit_store(<?echo $_SESSION['id']?>,<?echo $result->id?>,<?echo $_GET['gtype']?>)" value="Edit"></td></tr>
					
			<?
					}
				}
				else{
					$sql_store = "SELECT * FROM `jangsc27_cs_project`.`member_store` WHERE `store_id`=?";
					$sth_store = $db->prepare($sql_store);
					$sth_store->execute(array($result->id));
					$result_store = $sth_store->fetchObject();
					if(!$result_store){
						?>
			
						<tr><td><input class = "abutton" style = "width: 100px;"type="button" onclick="go_verify(<?echo $_SESSION['id']?>,<?echo $result->id?>,<?echo $_GET['gtype']?>)" value="Verify"></td></tr>
						<?
					}
					else{
						?>
						<tr><td><input class = "abutton" style = "width: 100px;" type="button" value="contract" onclick="get_contract(<?echo $_SESSION['id']?>,<?echo $result_store->member_id?>,<?echo $result->id?>)"></td></tr>
						<?
					}
				}
				
				
				
				
				
			}
			
			?>
			<input type="hidden" id="address_map" value="<?echo $temp->address?>">
			<!--<button type="button" onclick="initialize();showAddress('<?echo $temp->address?>')">test</button>-->
			<?
			if($_GET['gtype']=='1'){?>
				<tr><td><button class = "abutton" style = "width: 100px;" type="button" onclick="back(<?echo $_GET['gtype']?>)">Back</button></td></tr>
			<?}
			else{?>
				<tr><td><button class = "abutton" style = "width: 100px;" type="button" onclick="back(<?echo $_GET['gtype']?>)">Back</button></td></tr>
			<?}
			?>
			</table>
			
			<?php
			while($img_result = $sth_img->fetch()){
				?><img onclick="window.open('http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $img_result['image']?>')" src="<?echo $img_result['image']?>" style="width: 30%;height: 30%;"/><?
			}
			?>
			<div id="map" style="width:500px; height:500px;display:inline-block;"></div>
			
		<?}
		else{?>
		</table><?
			
		}
		
		
		?>
	
		
</body>
</html>
