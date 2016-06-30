<?php
require_once "sysconfig.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-TW">
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
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
	<!--login status-->
	<?if($_SESSION['name']){?>
		Hello  <?echo $_SESSION['name']?>  <?echo $_SESSION['id']?>  
		<input type="button" value="logout" onclick="location.href='logout.php';">
	<?}else{?>
		<form action="check_login.php" method="POST" >
		<input id="username" type="text" name="username" placeholder="Account">
		<input id="password" type="password" name="password" placeholder="Password">
		<input type="submit" value="login" >
		</form>
	
	<?}?>
	
	
	<!--Show all store-->
		<table>
		<tr>
		<form action="store_list.php" method="GET">
		<td>Choose</td>
		<td>
		<select name="search">
		<option value="1">ID</option>
		<option value="2">NAME</option>
		<option value="3">PHONE</option>
		<option value="4">ADDRESS</option>
		<option value="5">CONTENT</option>
		<option value="6">MY STORE</option>
		</td>
		<td><input type="text" name="something" placeholder="Search"></td>
		<td><button id="s1" type="submit">search</button></td>
		<td><input type="button" value="add store" onclick="window.open('create_store.php','Add','width=700,height=300')"></td>
		</form>
		</tr>
		<tr>
		<td>ID</td>
		<td>NAME</td>
		<td>PHONE</td>
		<td>ADDRESS</td>
		<td>CONTENT</td>
		<td>IMAGE</td>
		</tr> 
		<?
		$sql = "SELECT * FROM `jangsc27_cs_project`.`store` ";
		if($_GET["something"]!=NULL){
			if($_GET["search"]=="1"){
				$sql = $sql."WHERE `id` LIKE :term ";
			}
			else if($_GET["search"]=="2"){
				$sql = $sql."WHERE `name` LIKE :term ";
			}
			else if($_GET["search"]=="3"){
				$sql = $sql."WHERE `phone` LIKE :term ";
			}
			else if($_GET["search"]=="4"){
				$sql = $sql."WHERE `address` LIKE :term ";
			}
			else if($_GET["search"]=="5"){
				$sql = $sql."WHERE `content` LIKE :term ";
			}
		}
		$sth = $db->prepare($sql);
		$sth->execute(array(":term" => "%" . $_GET["something"] . "%"));
		
		while($result = $sth->fetchObject()){  
			//Find image correspond to store_id
			$sql_img = "SELECT * FROM `jangsc27_cs_project`.`image` where `store_id` = ?";
			$sth_img = $db->prepare($sql_img);
			$sth_img->execute(array($result->id));
			echo '<tr>
			<td>'.$result->id.'</td>
			<td><a href="http://people.cs.nctu.edu.tw/~cwchen05030530/store.php?store_id='.$result->id.'">'.$result->name.'</a></td>
			<td>'.$result->phone.'</td>
			<td>'.$result->address.'</td>
			<td>'.$result->content.'</td>
			<td>';
			while($img_result = $sth_img->fetch()){
				echo '<img src="data:'.$img_result['image_type'].';base64,'.$img_result['image'].'" heigh="150" width="150"/>';
			}?></td>
			<td>
			<?
			if($_SESSION['id']){
				$sql_ms = "SELECT * FROM `jangsc27_cs_project`.`member_store` where `store_id` = ?";
				$sth_ms = $db->prepare($sql_ms);
				$sth_ms->execute(array($result->id));
				$ms_result = $sth_ms->fetchObject();
				if($ms_result->member_id==$_SESSION['id']){?>
					<form action="NNN.php" method="POST" >
					<input type="submit" value="Edit">
					</form>
				<?}
				else{?>
					<form action="varify_store.php" method="POST" >
					<input type="hidden" name="member_id" value="<?echo $_SESSION['id']?>">
					<input type="hidden" name="varify_id" value="<?echo $result->id?>">
					<input type="submit" value="Varify"></form>
				<?}
			}?>
			</td></tr>	
		<?}
		
		
		
		?>
	</body>
</html>