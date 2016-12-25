var current_page = 0;
var drop_show = 0;
var ka = 5;
var scroll_switch = 1;
$(document).ready( function() {
	//當滑鼠滑入時將div的class換成divOver
	$('.sidebar').hover(function(){
			$(this).addClass('sidebar_over');		
		},function(){
			//滑開時移除divOver樣式
			$(this).removeClass('sidebar_over');	
		}
	);
	
	//click outside the button
	$(window).click(function() {
	//Hide the menus if visible
		if(!$(event.target).closest('#dropbtn').length&&!$(event.target).closest('#dropdown-content').length){
			if(drop_show==1){
				//console.log("Hide");
				$('#dropbtn').removeClass('choose_menu');
				$("#dropbtn").css("color","white");
				$('#dropdown-content').removeClass('dropdown-content1');
				drop_show = 0;
			}
		}
		
	});
	$('#dropbtn').click(function(event){
		if(drop_show==0){
			//console.log("Show");
			$('#dropbtn').addClass('choose_menu');
			$("#dropbtn").css("color","#5599FF");
			$('#dropdown-content').addClass('dropdown-content1');
			drop_show = 1;
		}
		else{
			$('#dropbtn').removeClass('choose_menu');
			$("#dropbtn").css("color","white");
			$('#dropdown-content').removeClass('dropdown-content1');
			drop_show = 0;
		}
		
	});
	
	
	//$('#dropdown').hover(	
	//   function () {
	//   }, 
	
	//   function () {
	//		$('#dropdown-content').removeClass('dropdown-content1');
			//$(this).css({"background-color":"blue"});
	//   }
	//);
	/*$("#dropdown").blur(function () {
		alert('hu');
            $('#dropdown-content').removeClass('dropdown-content1');
    });*/
})

//show_dropbox
//function show_dropbox(){
//	$('#dropdown-content').addClass('dropdown-content1');
//	drop_show = 1;
//}

//min sidebar
$(function(){
	news();
	get_n();
});
var m = 0;
function min_sidebar(){
	if(m==0){
		$('#sidebar').toggle('fast');
		$('#close_side').hide();
		$('#content').hide();
		$('#close_side').removeClass('close_left');	
		$('#close_side').addClass('close_right');	
		$('#close_side').fadeIn(500);
		$('#content').fadeIn(500);
		$("#content").css("left","250px");	
		m = 1;
	}
	else{
		$('#sidebar').toggle('normal');
		$('#close_side').hide();
		$('#content').hide();
		$('#close_side').removeClass('close_right');
		$('#close_side').addClass('close_left');	
		$('#close_side').fadeIn(500);
		$('#content').fadeIn(500);
		$("#content").css("left","300px");
		m = 0;
	}
}
function show_box_login(){
	document.getElementById("show_box").innerHTML='';
	document.getElementById("show_box").innerHTML+='<h3 style = "margin-left: 10px; margin-bottom: auto; margin-top: auto;">Username</h3>';
	document.getElementById("show_box").innerHTML+='<input style = "margin-bottom: 5px;margin-left: 10px;" class="k-textbox" id="username" type="text" name="username" placeholder="Account"><br>';
	document.getElementById("show_box").innerHTML+='<h3 style = "margin-left: 10px; margin-bottom: auto; margin-top: auto;">Password</h3>';
	document.getElementById("show_box").innerHTML+='<input style = "margin-bottom: 5px;margin-left: 10px;" class="k-textbox" id="password" type="password" name="password" placeholder="Password"><br>';
	document.getElementById("show_box").innerHTML+='<input class = "k-button" style = "width:50%; margin-bottom: 5px;" type="button" value="login" onclick="check_login()">';
	document.getElementById("show_box").innerHTML+='<a href="#" onclick="fblogin();"><img src="images/fb_login.png" style="width: 50%;height: 0%;" border="0" alt=""></a>';
}

function news(){
	$("#loading").show();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			current_page = 0;
			ka = 5;
			get_news_ready();
			$("#content").fadeIn(500);
			scroll_switch = 1;
			$("#loading").hide();
			//console.log("HERE");
		}
	};
	xhttp.open("GET", "function/news.php", true);
	xhttp.send();
	$(".mem_op").slideUp();
}

function goto_quick_contract(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			quick_contract_ready();
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "contract/quick_contract.php", true);
	xhttp.send();
	$(".mem_op").slideUp();
}
//js for captcha
var rval;
function checkEmail() {
	var remail = $("#email").val();
	emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
	alert(remail);
	if (remail.search(emailRule)!=-1) {
		$.post("function/send_auth.php",
		{
		  datatype:'text',
		  remail:remail
		  
		},
		function(data){
			rval = data;
			alert(rval);
		});
		document.getElementById("text1").innerHTML = 'Please check your e-mail >_<';
		document.getElementById("send").value = 'Send again 0.0';
	}
	else {
		alert("Wrong Email format");
		//$("#form").focus();
	}
}
function check_rval(){
	var c = $("#check_num").val();
	var result = rval.replace(/\r\n|\n/g,"");
	result = result.replace(/\s+/g, "");
	if(result==c){
		alert("Correct");
		document.getElementById('Done').disabled = false;
	}
	else{
		alert("Wrong");
	}
}

//menuBAR
var VisibleMenu = ''; // 記錄目前顯示的子選單的 ID
// 顯示或隱藏子選單
function switchMenu( theMainMenu, theSubMenu, theEvent ){
	var SubMenu = document.getElementById( theSubMenu );
	if( SubMenu.style.display == 'none' ){ // 顯示子選單
		SubMenu.style.minWidth = theMainMenu.clientWidth; // 讓子選單的最小寬度與主選單相同 (僅為了美觀)
		SubMenu.style.display = 'block';
		hideMenu(); // 隱藏子選單
		VisibleMenu = theSubMenu;
	}
	else{ // 隱藏子選單
		if( theEvent != 'MouseOver' || VisibleMenu != theSubMenu ){
			SubMenu.style.display = 'none';
			VisibleMenu = '';
		}
	}
}

// 隱藏子選單
function hideMenu(){
	if( VisibleMenu != '' ){
		document.getElementById( VisibleMenu ).style.display = 'none';
	}
	VisibleMenu = '';
}

// 顯示通知內容 (登入後才執行 放在login裡面)
function shownotice(id){
	$.post("member/check_application.php",
	{
	  datatype:'json',
	  member_id:id
	},
	function(data){
		var temp='{"list":'+data+'}';
		var obj=JSON.parse(temp);
		alert(obj.list[0].id);
	}
	
	);
}
function show_box_close(){
	$('.reveal-modal-bg').trigger('click');
}
//rgb
//gyg
////
//get news ready
function get_news_ready(){
	$("#loading").show();
	document.getElementById("news_content").innerHTML = "";
	$.post("function/get_news.php",
	{
		datatype:'json',
		first:0,
		num:5
	},
	function(data){
		//alert(data);
		//var temp='{"list":'+data+'}';
		var obj=JSON.parse(data);
		//obj[obj.length] 判斷管理員id
		for(var i=0; i<obj.length-1; i++){
			//alert(obj[0].id);
			var news_id = obj[i].id;
			$( "#news_content" ).append("<a href="+"#"+" "+"class="+"big-link"+" "+"style="+"text-decoration:none;display:block;width:600px;color:black;"+" "+"data-reveal-id="+"show_box"+">"+"<div class="+"news_div"+" "+"onclick="+"details("+news_id+")"+"><h2>"+obj[i].title+"</h2><p>Time  "+obj[i].time+"</p></div>"+"</a>");
			//$( "#news_content" ).append("<div id="+news_id+"></div>");
			if(obj[obj.length-1].admin==true)
				$( "#news_content" ).append( '<input type="button" class="k-button" value="Delete" onclick="delete_news('+news_id+')">');
		}
		//if(obj.del_but)
		//	$( "#news_content" ).append( '<input type="button" class="k-button" value="Delete" onclick="delete_news('+obj.del_but+')">');
	});
}
function get_n(){
	//js for news
	//ka = 5;
	$(document).scroll(function() {
		if(scroll_switch==1){
			if(document.getElementById("news_content")== null)
				return false; 
			var win = $(window);
			var doc_h = $(document).height();
			var win_h = win.height();
			var h = $(document).height() - win.height();
			var win_top = win.scrollTop();	
			
			Math.floor(win_top);
			
			if ($(document).height() - win.height() == win_top) {
				//find news
				$.post("function/get_news.php",
					{
						datatype:'json',
						first:ka,
						num:1
					},
					function(data){
						var obj=JSON.parse(data);
						if(obj.length==0){
							ka = 5;
							scroll_switch = 0;
							//alert("end"+ka);
						}
						else{
							var news_id = obj[0].id;
							$( "#news_content" ).append("<a href="+"#"+" "+"class="+"big-link"+" "+"style="+"text-decoration:none;display:block;width:600px;color:black;"+" "+"data-reveal-id="+"show_box"+">"+"<div class="+"news_div"+" "+"onclick="+"details("+news_id+")"+"><h2>"+obj[0].title+"</h2><p>Time  "+obj[0].time+"</p></div>"+"</a>");
							if(obj[1].admin==true)
								$( "#news_content" ).append( '<input type="button" class="k-button" value="Delete" onclick="delete_news('+news_id+')">');
							//$( "#news_content" ).append( '<input type="button" class="k-button" value="Delete" onclick="delete_news('+news_id+')">');
							ka++;
						}
						$('#loading').hide();
					});
			}
		}
		
		
	});
}

function details(news_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "function/news_detail.php?news_id="+news_id, true);
	xhttp.send();
	
}

function check_login(){
	$.post("function/check_login.php",
		{
		  datatype:'json',
		  username:document.getElementById("username").value,
		  password:document.getElementById("password").value
		},
		function(data){
			var obj=JSON.parse(data);
			if(obj.message=='Wrong Account or password !!'){
				alert(obj.message);
				show_box_login();
			}
			else
				location.reload();
		}
		
		);
}

function show_box_register(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
			register_ready();
		}
	};
	xhttp.open("GET", "function/register.php", true);
	xhttp.send();
}

function register_ready(){
$(document).ready( function() {
	//document.getElementsByClassName('reveal-modal-bg').onwheel = function(){ return false; }
	//var no_space = [^\s]; 
	//var reg_acc = $("#register_account").val();
	//if(reg_acc.search("\s")==-1){
	//	$("#valid1").show();
	//}
	//else{
	//	$("#valid1").hide();
	//}
	$(".gender_input").change(function(){
		if($(this).val()==""){
			$("#g_star").show();
		}
		else{
			$("#g_star").hide();
		}
	});
	$(".register_input input").change(function(){
		var reg_acc = $(".register_input input").val();
		//var temp = /\s/g.test(reg_acc);
		if(/\s/g.test(reg_acc)){
			//alert(temp);
			var c=$(this).next().next();
			c.show();
			//$("#NoSpace1").show();
		}
		else{
			var c=$(this).next().next();
			c.hide();
			//$("#NoSpace1").hide();
		}
		
		if($(this).val()==""){
			var c=$(this).next();
			c.show();
		}
		else{
			var c=$(this).next();
			c.hide();
		}
	});
})
	
}

function login(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("m-show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "qrcode.php", true);
	xhttp.send();
}

//delete news
function delete_news(news_id){
	$.post("function/delete_news.php",
		{
			datatype:'text',
			news_id: news_id
		},
		function(data){
			console.log(data);
			news();
		});
}

//add news
//function add_box_news(){
//	$.post("function/add_news.php",
//		{
//			datatype:'text',
//			news_id: news_id
//		},
//		function(data){
			//console.log(data);
			//news();
//		});
//}

function add_news(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "function/add_news_form.php", true);
	xhttp.send();
}

function add_news_submit(){
	$('#add_news_ajaxForm').submit(function() { 
    $(this).ajaxSubmit(function(data){
		show_box_close();
		news();
		console.log(data);
	});
		 return false;
	}); 
}

function test(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
			
	alert('hi');
		}
	};
	xhttp.open("GET", "function/qrcode.php", true);
	xhttp.send();
}