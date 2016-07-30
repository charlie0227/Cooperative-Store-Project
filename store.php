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
	<link href="store.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style.css">
    <title>Geocoding</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
	<!--<script src="jquery-1.12.4.min.js"></script>-->
	<script src="contract.js"></script>
	<script src="store.js"></script>
	<script src="account.js"></script>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA7kv2J21zjjZ6-_0abHxjqRTlRgz5vSA1MZbuL2l0P1cs_mO7FRT360m_w5W8HA98LDNckSGFAzJMBg"type="text/javascript"></script>
	<script type="text/javascript" src="jquery-an-showbox.js"></script> 
	<link rel="stylesheet" type="text/css" href="jquery-an-showbox.css">
    <script type="text/javascript">
	

		 $("#address").blur(function(){
			 alert("test");
		 });
		
		showAddress($("address"));
	});
	
    </script>
	
	<!--For showbox-->
	<script type="text/javascript">
$(document).ready(function(){
		
		var menuBar = '<div style="padding-top: 5px;width: 250px;position: relative;left: 50%;margin-left: -125px;"><div style="float:left;margin-top: 5px;width:80px;"><div id="gplus" class="g-plusone" data-size="medium"></div></div><div style="float:left;margin-top:5px;width:90px;"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a></div><div style="float:left;margin-top:5px;width:80px;" id="fblike"><fb:like send="false" layout="button_count" width="100" show_faces="false"></fb:like></div></div>';
		
		var update  = function(){
			if(typeof(FB) !== 'undefined')
				 FB.XFBML.parse(document.getElementById('fblike'));
			if(typeof(gapi) !== 'undefined') {
				gapi.plusone.render(document.getElementById('gplus'),{
					'href':location.href,
					'annotation':'bubble',
					'width': 90,
					'align': 'left',
					'size': 'medium'
				});
			}
			if(typeof(twttr) !== 'undefined') {
				$('#showbox .twitter-share-button').attr('data-url',location.href);
				twttr.widgets.load();
			}		            
		};
		
		var init_socials = function(doc) {
		    var s = 'script';
            var d = doc;
            var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
	          if (d.getElementById(id)) {return;}
	          js = d.createElement(s); js.src = url; js.id = id;
	          fjs.parentNode.insertBefore(js, fjs);
	        };
            load('https://connect.facebook.net/en_US/all.js#xfbml=1', 'fbjssdk');
            load('https://apis.google.com/js/plusone.js', 'gplus1js');
            load('https://platform.twitter.com/widgets.js', 'tweetjs');
		}
		
		ShowBox.init('#photos1 a',{
			closeCallback:function(){
				alert('ShowBox closed1');
			},
			menuBarContent: menuBar,
			onUpdate: update
		});
		
		ShowBox.init('#photos2 a',{
			closeCallback:function(){
				alert('ShowBox closed2');
			},
			menuBarContent: '<div style="padding-top:5px">Hello World</div>',
			onUpdate: update
		});
		
        init_socials(document);
        
	
});
</script> 
</head>
<body onload="initialize();showAddress('<?echo $temp->address?>')" onunload="GUnload()">
	<table class='bordered'><tr>
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
			</table>
			<table>
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
			
						<tr id="verify1"><td><input class = "abutton" style = "width: 100px;"type="button" onclick="go_verify(<?echo $_SESSION['id']?>,<?echo $result->id?>,<?echo $_GET['gtype']?>)" value="Verify"></td></tr>
						<?
					}
					else{
						?>
						<tr id="contract1"><td><input class = "abutton" style = "width: 100px;" type="button" value="contract" onclick="get_contract(<?echo $_SESSION['id']?>,<?echo $result_store->member_id?>,<?echo $result->id?>)"></td></tr>
						<?
					}
				}
				
				
				
				
				
			}
			
			?>
			<input type="hidden" id="address_map" value="<?echo $temp->address?>">
			<!--<button type="button" onclick="initialize();showAddress('<?echo $temp->address?>')">test</button>-->
			<?
			if($_GET['gtype']=='1'){?>
				<tr id="back"><td ><button class = "abutton" style = "width: 100px;" type="button" onclick="back(<?echo $_GET['gtype']?>)">Back</button></td></tr>
			<?}
			else{?>
				<tr id="back"><td><button class = "abutton" style = "width: 100px;" type="button" onclick="back(<?echo $_GET['gtype']?>)">Back</button></td></tr>
			<?}
			?>
			</table>
			
			<?php
			while($img_result = $sth_img->fetch()){
				?><div id="photos1"><ul><li><a href="http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $img_result['image']?>"><img src="<?echo $img_result['image']?>" style="width: 30%;height: 30%;"/></a></li></ul></div><?
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
