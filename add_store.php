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
        //�i�D�{�����n�ǰe�����                                         
        url:"add.php",                                                              
        //�ݭn�ǰe�����
        data:"&name="+name+"&phone="+phone+"&address="+address+"&content="+content+"&files="+files,  
         //�ϥ�POST��k     
        type : "POST",                                                                    
        //�����^�Ǹ�ƪ��榡�A�b�o�ӨҤl���A�u�n�O����true�N�i�H�F
        dataType:'json', 
         //�ǰe���ѫh���X���ѰT��      
        error:function(){                                                                 
        //��ƶǰe���ѫ�N�|����o��function�����{���A�i�H�b�o�̼g�J�n���檺�{��  
        alert("����");
        },
        //�ǰe���\�h���X���\�T��
        success:function(){                                                           
        //��ƶǰe���\��N�|����o��function�����{���A�i�H�b�o�̼g�J�n���檺�{��  
        alert("���\");
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