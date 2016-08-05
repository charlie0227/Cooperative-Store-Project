$(document).ready( function() {
	//當滑鼠滑入時將div的class換成divOver
	$('.sidebar').hover(function(){
			$(this).addClass('sidebar_over');		
		},function(){
			//滑開時移除divOver樣式
			$(this).removeClass('sidebar_over');	
		}
	);
})

$(document).ready(function(){
	news();
});
$(document).ready(function(){
	$.post("search_bar.php",
	{
	  datatype:'json'
	},
	function(data){
		var temp='{"list":'+data+'}';
		var obj=JSON.parse(temp);
		var availableTags=[];
		var arr = new Array();
		for(var i=0;i<obj.list.length;i++){
			var obj_tmp = new Object;
			obj_tmp.value = obj.list[i].name;
			obj_tmp.address = obj.list[i].address;
			obj_tmp.id = obj.list[i].id
			obj_tmp.label = obj.list[i].name;
			obj_tmp.type = obj.list[i].type;
			arr = arr.concat(obj_tmp);
		}
		$( "#search_bar" ).autocomplete({
		  source: arr,
		  select: function( event, ui ) {
				alert('type'+ui.item.type +'id:'+ui.item.id);
			}
		}).data("ui-autocomplete")._renderItem = function (ul, item) {
         return $("<li></li>")
             .data("item.autocomplete", item)
             .append("<a href=#>" + item.label + "</a></br>" + item.address)
             .appendTo(ul);
     };
	  });
});
function news(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#content").hide();
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#content").fadeIn(500);
		}
	};
	xhttp.open("GET", "news.php", true);
	xhttp.send();
}

//js for captcha
var rval;
function checkEmail() {
	var remail = $("#email").val();
	emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
	if (remail.search(emailRule)!=-1) {
		$.post("send_auth.php",
		{
		  datatype:'text',
		  remail:remail
		  
		},
		function(data){
			rval = data;
			//alert(rval);
		});
		document.getElementById("text1").innerHTML = 'Please check your e-mail >_<';
		document.getElementById("send").value = 'Send again 0.0';
	}
	else {
		alert("False");
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
	$.post("./member/check_application.php",
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
	$('.reveal-modal-bg').css({'display' : 'none'});      
	$('#show_box').css({
		'visibility' : 'hidden', 
		'top' : '0px'
	});	
}
//js for news
$(document).ready(function() {
    var win = $(window);

    // Each time the user scrolls
    win.scroll(function() {
        // End of the document reached?
        if ($(document).height() - win.height() == win.scrollTop()) {
            $('#loading').show();

            // Uncomment this AJAX call to test it
            /*
            $.ajax({
                url: 'get-post.php',
                dataType: 'html',
                success: function(html) {
                    $('#posts').append(html);
                    $('#loading').hide();
                }
            });
            */

            $('#posts').append(randomPost());
            $('#loading').hide();
        }
    });
});

// Generate a random post
function randomPost() {
    // Paragraphs that will appear in the post
    var paragraphs = [
        '<p>Shyan-Ming Yuan Taiwan No.1</p>',
        '<p>分散式系統、容錯計算 CSCW、電腦輔助教學</p>',
        '<p>1.Cloud storage 2.Cloud based IP Surveillance 3.GPU computing</p>',
        '<p>CEO, Save&Safe Technology, Taiwan, 2001 - 2002 Absence for industry </p>',
        '<p>Professor, CIS Department, National Chiao Tung University, Taiwan, 1995 - Present</p>',
        '<p>Member of Technical Staff, ATC, CCL, ITRI, Taiwan, 1989-1990</p>'
    ];

    // Shuffle the paragraphs
    for (var i = paragraphs.length - 1; !!i; --i) {
        var j = Math.floor(Math.random() * i);
        var p = paragraphs[i];
        paragraphs[i] = paragraphs[j];
        paragraphs[j] = p;
    }

    // Generate the post
    var post = '<li>';
    post += '<article>';
    post += '<header><h1>Breaking news!</h1></header>';
    post += paragraphs.join('');	//join: array to string
    post += '</article>';
    post += '</li>';

    return post;
}

function check_login(){
	$.post("check_login.php",
		{
		  datatype:'json',
		  username:document.getElementById("username").value,
		  password:document.getElementById("password").value
		},
		function(data){
			var obj=JSON.parse(data);
			location.reload();
			alert(obj.id);
			alert(obj.message);
		}
		
		);
}

	