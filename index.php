<?php
require_once "sysconfig.php";

$_SESSION['type']='2';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8" />
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA7kv2J21zjjZ6-_0abHxjqRTlRgz5vSA1MZbuL2l0P1cs_mO7FRT360m_w5W8HA98LDNckSGFAzJMBg"
        type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="jquery-1.12.4.min.js"></script>
		<script src="contract.js"></script>
		<script src="store.js"></script>
		<script src="account.js"></script>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="jquery-tablepage-1.0.js"></script>
		<script type="text/javascript"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<script type="text/javascript" src="jquery-an-showbox.js"></script>
		<link rel="stylesheet" type="text/css" href="jquery-an-showbox.css">
		<link rel="stylesheet" href="style.css">
		<script>
            $(document).ready( function() {
                    $("#tbl").tablepage($("#table_page"), 5);
            })
        </script>
		
		<?
			$sql = "SELECT name FROM `jangsc27_cs_project`.`store` ";
			$sth = $db->prepare($sql);
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
			
			$sql = "SELECT account FROM `jangsc27_cs_project`.`member`";
			$sth = $db->prepare($sql);
			$sth->execute();
			$register_result = $sth->fetchAll(PDO::FETCH_COLUMN,0);
		?>
		
		<!--create store-->
		<script type="text/javascript">
		//function for add new store
		function func_for_add_store(){
			$(function() {
			var availableTags = <? echo json_encode($result);?>;
			$( "#name1" ).autocomplete({
			  source: availableTags
			});
		  });
			
			$(document).ready(function(){
						$(".valid").hide();
						$("#repeat_acc").hide();
						$("#add1").hide();
						$("input").focus(function(){
							$(this).css("background-color", "#cccccc");
						});
						$("input").blur(function(){
							$(this).css("background-color", "#ffffff");
						});
						$("#m1").click(function(){
							var str=document.getElementById("name1").value; 
							if(str) 
							var i,c1=0,array=<? echo json_encode($result);?>;
							for(i=0;i<array.length;i++){
								if(str==array[i])
									c1=1;
							}
							if(c1==1) {
								$("#repeat_acc").show();
								$("#add1").hide();
								$("#m1").show();
							}
								
							else {
								$("#repeat_acc").hide();
								$("#add1").show();
								$("#m1").hide();
								$('#name1').attr('readonly', true);
							}
						});
						
						$('#create_ajaxForm').ajaxForm({ 
							dataType: 'json',
							success:function(data){ 
								if(data.error)
									alert(data.error);
								else
									manage_store(data.p,1);
							}
						}); 
						
					});
		}
		//function for edit_store.php
function func_edit_store(){
	$(function() {
		var availableTags = <? echo json_encode($result);?>;
		$( "#edit_store_name" ).autocomplete({
		  source: availableTags
		});
	  });
	//preview image http://jsnwork.kiiuo.com/archives/2258/jquery-javascript-%E6%95%99%E4%BD%A0%E5%A6%82%E4%BD%95%E8%A3%BD%E4%BD%9C%E5%9C%96%E7%89%87%E4%B8%8A%E5%82%B3%E5%89%8D%E7%9A%84%E9%A0%90%E8%A6%BD%E5%9C%96
	$(function (){
	 
		function format_float(num, pos)
		{
			var size = Math.pow(10, pos);
			return Math.round(num * size) / size;
		}
	 
		function preview(input) {
	 
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('.preview').attr('src', e.target.result);
					var KB = format_float(e.total / 1024, 2);
					$('.size').text("檔案大小：" + KB + " KB");
				}
	 
				reader.readAsDataURL(input.files[0]);
			}
		}
	 
		$("body").on("change", ".upl", function (){
			preview(this);
		})
		
	})  

	$(document).ready(function(){
		$(".valid").hide();
		$("#edit_store_zz").hide();
		$("#add").hide();
		$("input").focus(function(){
			$(this).css("background-color", "#cccccc");
		});
		$("input").blur(function(){
			$(this).css("background-color", "#ffffff");
		});
		$("#edit_store_name").blur(function(){
			var str=document.getElementById("edit_store_name").value; 
			if(str) 
			var i,c=0,array=<? echo json_encode($result);?>;
			for(i=0;i<array.length;i++){
				if(str==array[i]&&str!='<?echo $result_object->name?>')
					c=1;
			}
			if(c==1) {
				
				$("#edit_store_zz").show();
				$("#edit_btn").hide();
			}
			else {
				$("#edit_store_zz").hide();
				$("#edit_btn").show();
			}
		});
		$("#file").blur(function(){
			$("#img").hide();
		});
		$('#edit_store_form').ajaxForm({ 
			dataType: 'text',
			success:function(data){
				manage_store(data,1);
			}
		}); 
		
	});
}//for store list change to my store or all store
function chage_store(temp,type){ //1 for member 2 for store list
	if(temp=='2'){
		var str = document.getElementById("store_list_change_store").value;
		if(str=='My Store'){
			document.getElementById("store_list_change_store").value='All Store';
		}
		else if(str=='All Store'){
			document.getElementById("store_list_change_store").value='My Store';
			
		}
	}
	else{
		var str='My Store';
	}
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if(type=='2'){
					$("#div_show_all_store").show();
					$("#show_one_store_for_store_list").hide();
					document.getElementById("div_show_all_store").innerHTML = xmlhttp.responseText;
				}
				else{
					$("#my_member").show();
					$("#show_one_store_for_my_member").hide();
					document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				}
							$("#tbl").tablepage($("#table_page"), 5);
				
			}
		};
		var sth = '<?echo $_SESSION['id']?>';
		xmlhttp.open("GET","store_list.php?search="+str+"&searchfor="+sth+"&gtype="+type,true);
		xmlhttp.send();
		
	}
}
//function for register
function func_for_register(){
	$(function() {
	var availableTags = <? echo json_encode($result);?>;
	$( "#register_account" ).autocomplete({
	  source: availableTags
	});
  });
	$("#membership").show();
		$("#new").hide();
		$("#stores").hide();
	$(document).ready(function(){
		$(".valid").hide();
		$("input").focus(function(){
			$(this).css("background-color", "#cccccc");
		});
		$("input").blur(function(){
			$(this).css("background-color", "#ffffff");
		});
		$("#register_account").blur(function(){
			var str=$(this).val();
			if(str) 
				$("#star1").hide();
			else $("#star1").show();
			if(str.match(" ")) 
				$("#valid1").show();
			else $("#valid1").hide();
			
			var i,c=0,array=<? echo json_encode($register_result);?>;
			for(i=0;i<array.length;i++){
				if(str==array[i])
					c=1;
			}
			if(c==1) 
				$("#register_zz").show();
			else $("#register_zz").hide();
		});
		$("#register_password").blur(function(){
			var str=$(this).val();
			if(str) 
				$("#star2").hide();
			else $("#star2").show();
			if(str.match(" ")) 
				$("#valid2").show();
			else $("#valid2").hide();
		});
		$("#phone").blur(function(){
			var str=$(this).val();
			if(str) 
				$("#star3").hide();
			else $("#star3").show();
			if(str.match(" ")) 
				$("#valid3").show();
			else $("#valid3").hide();
		});
		$(".gender").blur(function(){
			var str=$(this).val();
			if(str) 
				$("#star4").hide();
			else $("#star4").show();
		});
		$("#email").blur(function(){
			var str=$(this).val();
			if(str) 
				$("#star5").hide();
			else $("#star5").show();
			if(str.match(" ")) 
				$("#valid5").show();
			else $("#valid5").hide();
		});
		$("#name").blur(function(){
			var str=$(this).val();
			if(str) 
				$("#star6").hide();
			else $("#star6").show();
			if(str.match(" ")) 
				$("#valid6").show();
			else $("#valid6").hide();
		});
	});
}

		//jquery ui autocomplete https://dotblogs.com.tw/a802216/2013/09/19/119070
		
		//preview image http://jsnwork.kiiuo.com/archives/2258/jquery-javascript-%E6%95%99%E4%BD%A0%E5%A6%82%E4%BD%95%E8%A3%BD%E4%BD%9C%E5%9C%96%E7%89%87%E4%B8%8A%E5%82%B3%E5%89%8D%E7%9A%84%E9%A0%90%E8%A6%BD%E5%9C%96
		$(function (){
		 
			function format_float(num, pos)
			{
				var size = Math.pow(10, pos);
				return Math.round(num * size) / size;
			}
		 
			function preview(input) {
		 
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function (e) {
						$('.preview').attr('src', e.target.result);
						var KB = format_float(e.total / 1024, 2);
						$('.size').text("檔案大小：" + KB + " KB");
					}
		 
					reader.readAsDataURL(input.files[0]);
				}
			}
		 
			$("body").on("change", ".upl", function (){
				preview(this);
			})
			
		})  

		$(document).ready(function(){
			$(".valid").hide();
			$("#repeat_acc").hide();
			$("#add1").hide();
			$("input").focus(function(){
				$(this).css("background-color", "#cccccc");
			});
			$("input").blur(function(){
				$(this).css("background-color", "#ffffff");
			});
			$("#m1").click(function(){
				var str=document.getElementById("name1").value; 
				if(str) 
				var i,c1=0,array=<? echo json_encode($result);?>;
				for(i=0;i<array.length;i++){
					if(str==array[i])
						c1=1;
				}
				if(c1==1) {
					$("#repeat_acc").show();
					$("#add1").hide();
					$("#m1").show();
				}
					
				else {
					$("#repeat_acc").hide();
					$("#add1").show();
					$("#m1").hide();
					$('#name1').attr('readonly', true);
				}
			});
		});

		function my_reset() {
			$(".valid").hide();
			$("#repeat_acc").hide();
			$("#add1").hide();
			$("#m1").show();
			$('#name1').attr('readonly', false);
		}


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
			
		</style>
		<!--change content-->
		<script type="text/javascript" language="javascript">
		
		
		
		
		$(document).ready(function(){
			//$('#login').ajaxForm({ 
			//	dataType: 'text',
			//	success:function(data){
			//	var aaa="login fail!!";
			//		if(data==aaa)
			//			alert("啊");
			//		alert(data);
			//	}
			//});
			
			$("#show_store").click(function(){ //3
				$("#div_show_all_store").show();
				$("#show_one_store_for_store_list").hide();
				$("#stores").show();
				$("#new").hide();
				$("#membership").hide();
				$("#please_login").hide();
				document.getElementById("my_member").innerHTML="";
				document.getElementById("div_show_all_store").innerHTML="";
				//session_change_value("3");
			});
			$("#show_news").click(function(){ //1
				$("#new").show();
				$("#stores").hide();
				$("#membership").hide();
				$("#please_login").hide();
				//session_change_value("1");
			});
			$("#show_member").click(function(){ //2
				$("#membership").show();
				$("#new").hide();
				$("#stores").hide();
				$("#please_login").show();
				document.getElementById("my_member").innerHTML="";
				document.getElementById("div_show_all_store").innerHTML = "";
				//session_change_value("2");
			});
			
		});
		
		
		
		
		</script>
		<!--mem func-->
		<script>
		$(document).ready(function(){
			$("#show_add_store").click(function(){
				$("#add_new_store").show();
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
		<!-- member's function-->
		function func_edit_password_confirm(){
			var a = document.getElementById('old_password').value;
			var b = document.getElementById('new1_password').value;
			var c = document.getElementById('new2_password').value;
			
			$.post("edit_password_confirm.php",
			{
			  datatype:'json',
			  old_password:a,
			  new1_password:b,
			  new2_password:c
			},
			function(data){
				var obj=JSON.parse(data);
				if(obj.result=="Edit Success!\nPlease login again!"){
					document.location.href="logout.php"
				}
				else{
					alert(obj.result);
				}
			}
			);
		}

		function func_edit_confirm(){
			var a = document.getElementById('edit_person_name').value;
			var b = document.getElementById('phone').value;
			var g="0";
			if(document.getElementById('male').checked){
				g="1";
			}
			var c = document.getElementById('year').value;
			var d = document.getElementById('month').value;
			var e = document.getElementById('date').value;
			var f = document.getElementById('email').value;
			
			
			$.post("edit_confirm.php",
			{
			  datatype:'json',
			  name:a,
			  phone:b,
			  gender:g,
			  year:c,
			  month:d,
			  date:e,
			  email:f
			},
			function(data){
				var obj=JSON.parse(data);
				alert(obj.result);
				
			}
			);
			
			
		}

		function func_edit_store_confirm(){
			var a = document.getElementById('edit_store_name').value;
			var b = document.getElementById('edit_store_phone').value;
			var c = document.getElementById('edit_store_address').value;
			var d = document.getElementById("edit_store_content").value;
			var e = document.getElementById("edit_store_id").value;
			/*
			alert(a);
			alert(b);
			alert(c);
			alert(d);
			alert(e);*/
			$.post("edit_store_confirm.php",
			{
			  datatype:'json',
			  name:a,
			  phone:b,
			  address:c,
			  content:d,
			  edit_id:e
			},
			function(data){
				var obj=JSON.parse(data);
				manage_store(obj.result,1);
			}
			);
			
			
		}
		
		











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
　		<div style = "border-radius: 10px;" id="the_header"><h1>Home</h1></div>
　		<div style = "width:100%;">
			<div id="sidebar">
				<!--login status-->
				<?if($_SESSION['name']){?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">Hi, <?echo $_SESSION['name']?> </h3>
					<input class = "abutton" style = "width: 90%;" type="button" value="logout" onclick="location.href='logout.php';">
				<?}else{?>
					<h3 style = "text-align:left; margin-left: 10px; margin-bottom: auto; margin-top: auto;">會員登入</h3>
					<input style = "margin-bottom: 5px;" id="username" type="text" name="username" placeholder="Account">
					<input style = "margin-bottom: 5px;" id="password" type="password" name="password" placeholder="Password">
					<input class = "abutton" style = "width:90%; margin-bottom: 5px;" type="button" value="login" onclick="check_login()">
					<input class = "abutton" style = "width:90%; margin-bottom: 5px;" type="button" value="register" onclick="go_register()">
				<?}?>
				<a href="#qt1" class = "sidebar" id = "show_news">最新消息</a>
				<a href="#qt2" class = "sidebar" id = "show_member">會員專區</a>
				<a href="#qt3" class = "sidebar" id = "show_store" onclick="searchforstore(2)">商店列表</a>
			</div>
			<div id="content">
				<div id = "new" name="qt1">
					<h2>最新消息</h2>
					<ul>
					  <li>替補軍團狂轟45分勇士勝騎士拔頭籌LYS<2016/6/3></li>
					  <li>金鶯七轟打紅襪 釀酒人近十戰七勝<2016/6/3></li>
					  <li>蛋白質攝取過量 恐傷腎病變<2016/6/3></li>
					</ul>
				</div>
				<!--memeber func-->
				<div hidden id="please_login">	
					<?if(!$_SESSION['name']){?>
						<p><-----------</p>
						<p>Please Login first</p>
					<?}?>
				</div>
				<div hidden id = "membership" name="qt2">
					
					<?if($_SESSION['name']){?>
						<h2>會員專區</h2>
						<table>
						<tr>
						 <td><input class="abutton" id = "show_add_store"  type="button" value="add new store" onclick="add_store()"></td>
						 <td><input class="abutton" type="button" value="manage store" onclick="chage_store(1,1)"></td>
						 <td><input class="abutton" type="button" value="manage contract" onclick="contract_list()"></td>
						 <td><input class="abutton" type="button" value="edit personal information" onclick="edit_personal()"></td>
						 <td><input class="abutton" type="button" value="edit password" onclick="edit_password()"></td>
						</tr>
						</table>	
					<?}?>
					
					<div id="my_member">
						
					</div>
					<div id='show_one_store_for_my_member'></div>
				</div>
				<!--storelist-->
				<div hidden id = "stores" name="qt3">
					
					<table width = "100%">
						<div id="search_box">
						<tr>
						<form action="index.php" method="POST">
						<td style = "height:30px;">Choose</td>
						<td style = "height:30px;">
						<select name="search_type" id="search_type">
							<option value="1">ID</option>
							<option value="2">NAME</option>
							<option value="3">PHONE</option>
							<option value="4">ADDRESS</option>
							<option value="5">CONTENT</option>
						 </select>
						</td>
						<td style = "height:30px;"><input type="text" name="searchfor" id="searchfor" placeholder="Search"></td>
						<td style = "height:30px;"><input class = "abutton" type="button" name="search_btn" value="search" onclick="searchforstore(2)"></td>
						</form>
						<?
						if($_SESSION['id']){?>
							<td style = "height:30px;"><input class = "abutton" type="button" id="store_list_change_store" value="My Store" onclick="chage_store(2,2)"></td>
						<?}?>
						<td style = "height:30px;"><input id ="add1" type="button" value="add store" onclick="window.open('create_store.php','Add','width=700,height=300')"></td>
						</tr>
						</div>
					</table>
					<!--Show all store-->
					<div id='div_show_all_store'></div>
					
					<div id='show_one_store_for_store_list'></div>
				</div>
				
			</div>
		</div>
		<div style='clear:both;'></div>		
　		<div id="footer">footer</div>
	</body>
</html>
