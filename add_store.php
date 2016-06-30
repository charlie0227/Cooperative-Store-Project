<?php
require_once "sysconfig.php";
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>


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
	<!--Add new store-->
	<form id="form" action="add.php" method="POST" enctype="multipart/form-data"></br>
	<br><input name="name" type="text" placeholder="name"></br>
	<br><input name="phone" type="text" placeholder="phone"></br>
	<br><input name="address" type="text" placeholder="address"></br>
	<br><input name="content" type="text" placeholder="content"></br>
	<br><input name="files" type="file" ></br>
	<img id="loading" src="loading.gif" style="display:none;">
	<br><input type="submit" value="new">
		<input type="button" value="close" onclick="window.colse()">
	</br>
	</form>
	</body>
</html>