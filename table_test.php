<?php
require_once "sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8" />
		<script src="jquery-tablepage-1.0.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="jquery-1.12.4.min.js"></script>
		<script src="jquery-tablepage-1.0.js"></script>
		<script type="text/javascript"></script>
		<script>
            $(document).ready( function() {
                    $("#tbl").tablepage($("#table_page"), 5);
            })
        </script>
		
		
		
		
		
		
		<!--change color of block-->
		<script language="javascript">
			$(function(){
				//當滑鼠滑入時將div的class換成divOver
				$('.sidebar').hover(function(){
						$(this).addClass('sidebar_over');		
					},function(){
						//滑開時移除divOver樣式
						$(this).removeClass('sidebar_over');	
					}
				);
			});
		</script>

		<style>
			
			#slist{
				height: 120px;
			}
			img{
				max-width: 240px;
				width:expression(this.width>600?:this.width);
				overflow: hidden;
				height: 120px
			}
			
			.sidebar{ 
				display:block; 
				background:#FFDD55; 
				margin-bottom: 5px; 
				text-decoration: none;
				color: #FFFFFF;
				height: 50px;
			}

			/*  滑入時變換底色樣式 */  
			.sidebar_over{
				background:#FFEE99;
			} 
			
			#add1{
			    border: 1px solid #ccc;
				border-radius: 4px;
				padding: 5px;
			}
			input[type=text], select {
			width: 90%;
			padding: 5px 5px;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			}
			input[type=password], select {
			width: 90%;
			padding: 5px 5px;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			}
			#edit_button{
				border: 1px solid #ccc;
				border-radius: 4px;
				padding: 5px;
			}
			#verify_button{
				border: 1px solid #ccc;
				border-radius: 4px;
				padding: 5px;
			}
			#s1{
				border: 1px solid #ccc;
				border-radius: 4px;
				padding: 5px;
			}
		</style>
		<!--change content-->
		<script>
		$(document).ready(function(){
			$("#show_store").click(function(){
				alert("YOLO");
				$("#stores").show();
				$("#new").hide();
			});
			$("#show_news").click(function(){
				alert("YOLO");
				$("#new").show();
				$("#stores").hide();
			});
		});
		</script>
		
		<!--new-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		 <?php
		$sql = "SELECT name FROM `jangsc27_cs_project`.`store` ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
		/*
		if($_POST["search"])
		{
			if($_POST["name"]!=NULL){
				$sql = "SELECT `name` FROM `jangsc27_cs_project`.`store` LIKE `%?%`";
				$sth = $sth = $db->prepare($sql);
				$sth->execute(array($_POST['name']));
			}
				
		}
		*/
		?>
		<script type="text/javascript">
		//search
		$(document).ready(function(){
			$("#s1").click(function(){
				var str=document.getElementById("name").value; 
				if(str) 
				var i,c=0,array=<? echo json_encode($result);?>;
				for(i=0;i<array.length;i++){
					if(str==array[i])
						c=1;
				}
				if(c==1) {
					$("#zz").show();
					$("#add").hide();
					$("#s1").show();
				}
					
				else {
					$("#zz").hide();
					$("#add").show();
					$("#s1").hide();
					$('#name').attr('readonly', true);
				}
			});
		});




		function messageGo(){
		  var name    = $('#name').val();                                   
		  var phone   = $('#phone').val();  
		  var address = $('#address').val();                                   
		  var content = $('#content').val();  
		  var files   = $('#files').val();  
			$("#loading")
			.ajaxStart(function(){
				$(this).show();
			})
			.ajaxComplete(function(){
				$(this).hide();
			});

			$.ajax({
				//告訴程式表單要傳送到哪裡                                         
				url:"add.php",                                                              
				//需要傳送的資料
				data:"&name="+name+"&phone="+phone+"&address="+address+"&content="+content+"&files="+files,  
				 //使用POST方法     
				type : "POST",                                                                    
				//接收回傳資料的格式，在這個例子中，只要是接收true就可以了
				dataType:'json', 
				 //傳送失敗則跳出失敗訊息      
				error:function(){                                                                 
				//資料傳送失敗後就會執行這個function內的程式，可以在這裡寫入要執行的程式  
				alert("失敗");
				},
				//傳送成功則跳出成功訊息
				success:function(){                                                           
				//資料傳送成功後就會執行這個function內的程式，可以在這裡寫入要執行的程式  
				alert("成功");
				}
			});
		};
		</script>

	</head>
	
	<body>
		
		
		
		<!--<div style = "width:600px; margin:0 auto; font-size:13px;" id="sitebody">-->
　		<div style = "width:100%; height:80px; text-align:center; line-height:80px; font-size:15px; color:#fffaf3; font-weight:bold; background-color:#f9c81e;" id="header"><h1>Home</h1></div>
　		<div style = "width:100%;">
			<div style = "width:20%; float:left; height:1080px; text-align:center; line-height:50px; font-size:15px; color:#ffffff; font-weight:bold; background-color:#FFDD55;"id="sidebar">
				<!--login status-->
				<?if($_SESSION['name']){?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">Hi, <?echo $_SESSION['name']?> </h3>
					<input style = "margin-bottom: 10px; width: 90%; border: 1px solid #ccc; border-radius:4px; padding:5px;" type="button" value="logout" onclick="location.href='logout.php';">
				<?}else{?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">會員登入</h3>
					<form action="check_login.php" method="POST" >
					<input style = "margin-bottom: 5px;" id="username" type="text" name="username" placeholder="Account">
					<input style = "margin-bottom: 5px;" id="password" type="password" name="password" placeholder="Password">
					<input style = "width: 90%; border: 1px solid #ccc; border-radius:4px; padding:5px; margin-bottom: 5px;"type="submit" value="login">
					</form>
				
				<?}?>
				
				<a class = "sidebar" id = "show_news">最新消息</a>
				<a class = "sidebar" id = "show_member">會員專區</a>
				<a class = "sidebar" id = "show_store">商店列表</a>
			</div>
			<div style = "width:60%; height:720px; text-align:left; line-height:30px; font-size:15px; margin-left:20px; color:#f9c81e; font-weight:bold;  float:left; "id="content">
				<div id = "new">
					<h2>最新消息</h2>
					<ul>
					  <li>替補軍團狂轟45分勇士勝騎士拔頭籌LYS<2016/6/3></li>
					  <li>金鶯七轟打紅襪 釀酒人近十戰七勝<2016/6/3></li>
					  <li>蛋白質攝取過量 恐傷腎病變<2016/6/3></li>
					</ul>
				</div>
				<div hidden id = "stores">
					<table width = "100%">
						<tr>
						<form action="store_list.php" method="POST">
						<td style = "height:30px;">Choose</td>
						<td style = "height:30px;">
						<select name="search">
						<option value="1">ID</option>
						<option value="2">NAME</option>
						<option value="3">PHONE</option>
						<option value="4">ADDRESS</option>
						<option value="5">CONTENT</option>
						</td>
						<td style = "height:30px;"><input type="text" name="something" placeholder="Search"></td>
						<td style = "height:30px;"><input id ="s1" type="button" value="search"></td>
						<td style = "height:30px;"><input id ="add1" type="button" value="add store" onclick="window.open('create_store.php','Add','width=700,height=300')"></td>
						</form>
						</tr>
					</table>
					
					
					
					
					
					
					
					<!--Show all store-->
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
					$sql = "SELECT * FROM `jangsc27_cs_project`.`store` ";
					$sth = $db->prepare($sql);
					$sth->execute();
					while($result = $sth->fetchObject()){  
						//Find image correspond to store_id
						$sql_img = "SELECT * FROM `jangsc27_cs_project`.`image` where `store_id` = ?";
						$sth_img = $db->prepare($sql_img);
						$sth_img->execute(array($result->id));
						echo '<tr>
						<td id="slist"><a href="http://people.cs.nctu.edu.tw/~cwchen05030530/store.php?store_id='.$result->id.'">'.$result->name.'</a></td>
						<td id="slist">'.$result->phone.'</td>
						<td id="slist">'.$result->address.'</td>
						<td id="slist">'.$result->content.'</td>
						<td id="slist">';
						while($img_result = $sth_img->fetch()){
							echo '<img src="data:'.$img_result['image_type'].';base64,'.$img_result['image'].'" heigh="150" width="150"/>';
						}?></td>
						<td id="slist">
						<?
						if($_SESSION['id']){
							$sql_ms = "SELECT * FROM `jangsc27_cs_project`.`member_store` where `store_id` = ?";
							$sth_ms = $db->prepare($sql_ms);
							$sth_ms->execute(array($result->id));
							$ms_result = $sth_ms->fetchObject();
							if($ms_result->member_id==$_SESSION['id']){?>
								<form action="NNN.php" method="POST" >
								<input id="edit_button" type="submit" value="Edit">
								</form>
							<?}
							else{?>
								<form action="varify_store.php" method="POST" >
								<input type="hidden" name="member_id" value="<?echo $_SESSION['id']?>">
								<input type="hidden" name="varify_id" value="<?echo $result->id?>">
								<input id="verify_button" type="submit" value="Varify"></form>
							<?}
						}?>
						</td>
						</tr>
					<?}
					echo '</tbody></table>';
					?>
					<span id="table_page"></span>
					
				</div>
			</div>
		</div>
		<div style='clear:both;'></div>		
　		<div style = "width:100%; height:80px;text-align:center;line-height:80px;font-size:15px;color:#fffaf3;font-weight:bold;background-color:#f9c81e; "id="footer">footer</div>
		
		
	</body>
</html>
