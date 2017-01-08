var lastwordValue = '';
var lastforValue = '';
var search_sto;
var gompany_id = '';
var my_lat;
var my_lng;
var glo_options;
var clear_interval =function (interval){
	clearInterval(interval);
}
function show_store_list(){
	$('#loading').show();
	if(document.getElementById('switch').getAttribute("value")=="1"){
		document.getElementById("search_btn").setAttribute("hidden",true);
		$('#wrapper').show();
		$('.t_head').show();
		$('#show_search_store').hide();
		$('#p1').show();
		$('#search_for').show();
		document.getElementById("nearby_btn").setAttribute("hidden",true);
		$("#search_for").kendoDropDownList();
		lastwordValue = $("#search_word").val();
		lastforValue = $("#search_for").val();

		var q = $("#search_for").val();
		var word = $("#search_word").val();
		//alert(my_lat);
		//alert(my_lng);
		if (window.navigator.geolocation==undefined) {
			alert("do not support my location");
		}
		else {
			var geolocation=window.navigator.geolocation; //���o Geolocation ����
			var option={
			  enableAcuracy:false,
			  maximumAge:0,
			  timeout:600000
			  };
			geolocation.getCurrentPosition(successCallback,
									   errorCallback,
									   option
									   );
			}
			function successCallback(position) {
				var options={
					q:q,
					word:word,
					lat:position.coords.latitude,
					lng:position.coords.longitude
				};
				load_content(undefined,undefined,options);

				}

			function errorCallback(position) {
				var options={
					q:q,
					word:word
				};
				load_content(undefined,undefined,options);

			}
	}
	else{
		$('#show_search_store').show();
		$('.t_head').hide();
		$('#wrapper').hide();
		$('#p1').hide();
		$('#search_for').hide();
		document.getElementById("search_btn").removeAttribute("hidden");
		document.getElementById("nearby_btn").removeAttribute("hidden");
		document.getElementById("search_for").setAttribute("hidden",true);
		document.getElementById("search_word").setAttribute("value","台北車站");
		show_store('show_search_store');
		document.getElementById('show_search_store').setAttribute("style","height:750px");
	}
}

function my_switch(){
	if(document.getElementById('switch').getAttribute("value")=="1"){
		document.getElementById("switch").setAttribute("value", "2");
		$("#switch").attr("src","images/shop.png")
		show_store_list();
	}
	else{
		document.getElementById("switch").setAttribute("value", "1");
		document.getElementById("search_word").setAttribute("value","");
		$("#switch").attr("src","images/googlemap.png")
		show_store_list();
	}
}

function store_list(){
	$('#loading').show();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
		if(document.getElementById('switch').getAttribute("value")=="1"){
		$("#show_search_store").hide();
		show_store_list();
		$("#show_search_store").fadeIn(500);
		search_sto=setInterval(function () {
			if(document.getElementById("store_bar")== null){
				clear_interval(search_sto);
			}
			else if (($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue ))&&(document.getElementById('switch').getAttribute("value")=="1") ){
				$("#show_search_store").hide();
				show_store_list();
				$("#show_search_store").fadeIn(500);
			}

		}, 500);
		}
		}
	};
	xhttp.open("GET", "store/store_list.html", true);
	xhttp.send();
	$(".mem_op").slideUp();
}
function store_list_app(){
	$('#loading').show();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
		if(document.getElementById('switch').getAttribute("value")=="1"){
		$("#show_search_store").hide();
		show_store_list();
		$("#show_search_store").fadeIn(500);
		search_sto=setInterval(function () {
			if(document.getElementById("store_bar")== null){
				clear_interval(search_sto);
			}
			else if (($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue ))&&(document.getElementById('switch').getAttribute("value")=="1") ){
				$("#show_search_store").hide();
				show_store_list();
				$("#show_search_store").fadeIn(500);
			}

		}, 500);
		}
		}
	};
	xhttp.open("GET", "store/store_list_app.html", true);
	xhttp.send();
	$(".mem_op").slideUp();
}
function find_address(id){
	$.post("store/check_store.php",
		{
		  datatype:'text',
		  store_id:id
		},
		function(data){
			geocodeAddress(data);
		}

		);
		//showAddress('<?echo $temp->address?>')
}
function view_store(id,map_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#store_bar").hide();
			$("#into_store").hide();
			document.getElementById("into_store").innerHTML = xhttp.responseText;
			initMap(map_id);//set google map
			find_address(id);//geocodeAddress(address)
			$("#into_store").fadeIn(500);
			$("#qrcode").kendoQRCode({
				value: "https://www.charlie27.me/~xu3u4tp6/store/m_store.php?store_id="+id,
				errorCorrection: "M",
				size: 120,
				border: {
					color: "#000000",
					width: 5
				}
			});
		}
	};
	xhttp.open("GET", "store/store.php?store_id="+id, true);
	xhttp.send();
}
function back_to_store_list(){
	$("#into_store").hide();
	$("#store_bar").fadeIn(500);
}
function add_new_store(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#store_bar").hide();
			$("#into_store").hide();
			document.getElementById("into_store").innerHTML = xhttp.responseText;
			add_store_ready();
			$("#into_store").fadeIn(500);
		}
	};
	xhttp.open("GET", "store/create_store.php", true);
	xhttp.send();
}
function add_store_ready(){
	$(".edit_input input").change(function(){
		if($(this).val()==""){
			var c=$(this).next();
			c.show();
		}
		else{
			var c=$(this).next();
			c.hide();
		}
	});
}
/*
function store_submit(){
	$('#store_ajaxForm').submit(function() {
		$(this).ajaxSubmit(function(data){
			var obj=JSON.parse(data);
			if(obj.error)
				alert(obj.error);
			show_store_list();
			view_store(obj.p,'store_map');
		});
		 return false;
	});
}
*/
function store_submit(){
	$('#store_ajaxForm').click(function() {
		var $name = $('#store_ajaxForm').find('input[name="name"]');
		var $phone = $('#store_ajaxForm').find('input[name="phone"]');
		var $address = $('#store_ajaxForm').find('input[name="address"]');
		var $url = $('#store_ajaxForm').find('input[name="url"]');
		$name.val(escapeHtml($name.val()));
		$phone.val(escapeHtml($phone.val()));
		$address.val(escapeHtml($address.val()));
		$url.val(escapeHtml($url.val()));
		var data = new FormData();
		data.append('name',$name.val());
		data.append('phone',$phone.val());
		data.append('address',$address.val());
		data.append('url',$url.val());
		data.append('files[]',$('#files')[0].files[0]);
		$.ajax({
		    url: 'store/add.php',
		    type: 'POST',
		    cache: false,
		    data: data,
		    processData: false,
		    contentType: false
		}).done(function(res) {
			alert(res);
			var obj = JSON.parse(res);
			view_store(obj.p,'store_map');
			return false;
	}).fail(function(res) {alert(res);return false;});
		event.preventDefault();
	});
	/*$.ajax({
		type:'POST',
		url:'store/add.php',
		data:$('#store_ajaxForm').serialize(),
		dataType:'json',
		success:function(data){
			var obj=JSON.parse(data);
			if(obj.error)
				alert(obj.error);
			view_store(obj.p,'store_map');
			return false;
		},
		error:function(){
			alert("BITCH");
			return false;
		}
	});*/
}
//preview image http://jsnwork.kiiuo.com/archives/2258/jquery-javascript-%E6%95%99%E4%BD%A0%E5%A6%82%E4%BD%95%E8%A3%BD%E4%BD%9C%E5%9C%96%E7%89%87%E4%B8%8A%E5%82%B3%E5%89%8D%E7%9A%84%E9%A0%90%E8%A6%BD%E5%9C%96
(function (){
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
		console.log('a');
        preview(this);
    })

})

function show_box_map(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
			//show_store_near_in_database();
			show_store_near();
		}
	};
	xhttp.open("GET", "store/store_near.html", true);
	xhttp.send();
}

function m_list(id){
	$( "#list" ).append('<h3>你所擁有的優惠</h3>');
	belong_list_search('company_id',id);
	/*var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("list").innerHTML = xhttp.responseText;
			belong_list_search('company_id');
		}
	};
	xhttp.open("GET", "member/belong_list_company.php?store_id="+id, true);
	xhttp.send();*/

}
function belong_list_search(order,store_id){
	$('#loading').show();
	$.post("member/discount_list.php",
	{
		datatype:'json',
		q:order,
		store_id:store_id
	},
	function(data){
		//alert(data);
		var obj=JSON.parse(data);
		for(var i=0; i<obj.length; i++){
			//discount calculate
			var res=obj[i].content;
			var content=JSON.parse(res);
			var discount="";
			var discount_intro="";
			if(content.method=="dynamic"){
				discount=parseInt(content.big)-Math.floor(parseInt(obj[i].num)/parseInt(content.people));
				discount=(discount<parseInt(content.small))?parseInt(content.small):discount;
				//discount introduction
				var big=(parseInt(content.big)%10==0)?parseInt(content.big)/10:parseInt(content.big);
				var how_many=content.people-(obj[i].num % content.people);
				var small=(parseInt(content.small)%10==0)?parseInt(content.small)/10:parseInt(content.small);
				discount_intro="原始折扣"+big+"折 再消費"+how_many+"人可再折扣1% 最低至"+small+"折";
			}
			else{
				discount=parseInt(content.discount);
				discount_intro="固定折扣";
			}
			discount=(discount%10==0)?discount/10:discount;
			//append into table
			gompany_id = obj[i].company_id;
			$( "#list" ).append('<table>\
				<tr><p>'+obj[i].company_name+'</p></tr>\
				<tr><p>'+obj[i].store_name+'</p></tr>\
				<tr><p>'+discount+'折</p></tr>\
				<tr><p>'+discount_intro+'</p></tr>\
				<tr><input class="k-button" style="font-size: 100px;"type="button" value="打卡" onclick="population_add('+obj[i].company_id+','+store_id+')"></tr>\
				</table>');

		}
		$('#loading').hide();
	});
}
function show_discount(company_id,store_id){
	$.post("store/discount.php",
		{
			datatype:'text',
			company_id:company_id,
			store_id:store_id
		},
		function(data){
			alert(data);
		});
}
function population_add(company_id,store_id){
	$.post("store/population_add.php",
		{
			datatype:'text',
			company_id:company_id,
			store_id:store_id
		},
		function(data){
			alert(data);
		});
}

//scroll part
var items_per_page = 15;
var scroll_in_progress = false;
var myScroll;

load_content = function(refresh, next_page,options) {
	if(!refresh)
		glo_options=options;
	// This is a DEMO function which generates DEMO content into the scroller.
	// Here you should place your AJAX request to fetch the relevant content (e.g. $.post(...))

	//console.log(refresh, next_page);
	setTimeout(function() { // This immitates the CALLBACK of your AJAX function
		if (!refresh) {
			// Loading the initial content
			$('#loading').show();
			$.get('store/store_search.php',glo_options,function(data){
					var obj = JSON.parse(data);
					//have data or no
					if(obj.error==1){
						$('#wrapper > #scroller > table.t_body').html('');
						$('#wrapper > #scroller > table.t_body').append('<tr>查無資料</tr>');
					}
					else{
						list = obj.result;
						//clear
						$('#wrapper > #scroller > table.t_body').html('');
						//add top10
						for(var i=0 ; i<items_per_page && i<list.length; i++)
							$('#wrapper > #scroller > table.t_body').append('<tr onclick="view_store('+list[i].id+','+"'store_map'"+')"><td>'+list[i].name+'</td><td>'+list[i].phone+'</td><td>'+list[i].address+'</td><td>'+list[i].distance+'</td></tr>');
					}
					//callback function
					if (myScroll) {
						myScroll.destroy();
						$(myScroll.scroller).attr('style', ''); // Required since the styles applied by IScroll might conflict with transitions of parent layers.
						myScroll = null;
					}
					trigger_myScroll();

					//jquery show
					$('#wrapper > #scroller > table.t_body tr').hide();
					$('#wrapper > #scroller > table.t_body tr').first().show( 100, function showNext() {
						$( this ).next( "tr" ).show( 100, showNext );
					});
					$('#loading').hide();
				}
			);
		} else if (refresh && !next_page) {
			$('#loading').show();
			// Refreshing the content
			$.get('store/store_search.php',glo_options,function(data){
					var obj = JSON.parse(data);
					//have data or no
					if(obj.error==1){
						$('#wrapper > #scroller > table.t_body').html('');
						$('#wrapper > #scroller > table.t_body').append('<tr>查無資料</tr>');
					}
					else{
						list = obj.result;
						//clear
						$('#wrapper > #scroller > table.t_body').html('');
						//add top10
						for(var i=0 ; i<items_per_page && i<list.length; i++)
							$('#wrapper > #scroller > table.t_body').append('<tr onclick="view_store('+list[i].id+','+"'store_map'"+')"><td>'+list[i].name+'</td><td>'+list[i].phone+'</td><td>'+list[i].address+'</td><td>'+list[i].distance+'</td></tr>');
					}
					//callback function
					myScroll.refresh();
					pullActionCallback();
					//jquery show
					//$('#wrapper > #scroller > ul > li').hide();
					//$('#wrapper > #scroller > ul > li').first().show( 100, function showNext() {
					//	$( this ).next( "li" ).show( 100, showNext );
					//});
				}
			);
		} else if (refresh && next_page) {
			$('#loading').show();
			// Loading the next-page content and refreshing
			//add next 10
			for(var i=(next_page-1)*items_per_page ; i<next_page*items_per_page && i<list.length; i++)
				$('#wrapper > #scroller > table.t_body').append('<tr onclick="view_store('+list[i].id+','+"'store_map'"+')"><td>'+list[i].name+'</td><td>'+list[i].phone+'</td><td>'+list[i].address+'</td><td>'+list[i].distance+'</td></tr>');
		//callback function
			myScroll.refresh();
			pullActionCallback();
		}
	}, 200);
};

function pullDownAction() {
	load_content('refresh');
	$('#wrapper > #scroller > table').data('page', 1);

	// Since "topOffset" is not supported with iscroll-5
	$('#wrapper > .scroller').css({top:0});

}
function pullUpAction(callback) {
	if ($('#wrapper > #scroller > table').data('page')) {
		var next_page = parseInt($('#wrapper > #scroller > table').data('page'), 10) + 1;
	} else {
		var next_page = 2;
	}
	load_content('refresh', next_page);
	$('#wrapper > #scroller > table').data('page', next_page);

	if (callback) {
		callback();
	}
}
function pullActionCallback() {
	if (pullDownEl && pullDownEl.className.match('loading')) {

		pullDownEl.className = 'pullDown';
		pullDownEl.querySelector('.pullDownLabel').innerHTML = '向下拖曳更新';

		myScroll.scrollTo(0, parseInt(pullUpOffset)*(-1), 200);

	} else if (pullUpEl && pullUpEl.className.match('loading')) {

		$('.pullUp').removeClass('loading').html('');

	}
}

var pullActionDetect = {
	count:0,
	limit:10,
	check:function(count) {
		if (count) {
			pullActionDetect.count = 0;
		}
		// Detects whether the momentum has stopped, and if it has reached the end - 200px of the scroller - it trigger the pullUpAction
		setTimeout(function() {
			if (myScroll.y <= (myScroll.maxScrollY + 200) && pullUpEl && !pullUpEl.className.match('loading')) {
				$('.pullUp').addClass('loading').html('<span class="pullUpIcon">&nbsp;</span><span class="pullUpLabel">Loading...</span>');
				pullUpAction();
			} else if (pullActionDetect.count < pullActionDetect.limit) {
				pullActionDetect.check();
				pullActionDetect.count++;
			}
		}, 200);
	}
}

function trigger_myScroll(offset) {
	pullDownEl = document.querySelector('#wrapper .pullDown');
	if (pullDownEl) {
		pullDownOffset = pullDownEl.offsetHeight;
	} else {
		pullDownOffset = 0;
	}
	pullUpEl = document.querySelector('#wrapper .pullUp');
	if (pullUpEl) {
		pullUpOffset = pullUpEl.offsetHeight;
	} else {
		pullUpOffset = 0;
	}

	if ($('#wrapper table tr').length < items_per_page) {
		// If we have only 1 page of result - we hide the pullup and pulldown indicators.
		$('#wrapper .pullDown').hide();
		$('#wrapper .pullUp span').hide();
		offset = 0;
	} else if (!offset) {
		// If we have more than 1 page of results and offset is not manually defined - we set it to be the pullUpOffset.
		offset = pullUpOffset;
	}

	myScroll = new IScroll('#wrapper', {
		probeType:1, tap:true, click:false, preventDefaultException:{tagName:/.*/}, mouseWheel:true, scrollbars:true, fadeScrollbars:true, interactiveScrollbars:false, keyBindings:false,
		deceleration:0.0002,
		startY:(parseInt(offset)*(-1))
	});

	myScroll.on('scrollStart', function () {
		scroll_in_progress = true;
	});
	myScroll.on('scroll', function () {

		scroll_in_progress = true;

		if ($('#wrapper table tr').length >= items_per_page) {
			if (this.y >= 5 && pullDownEl && !pullDownEl.className.match('flip')) {
				pullDownEl.className = 'pullDown flip';
				pullDownEl.querySelector('.pullDownLabel').innerHTML = '放開以更新';
				this.minScrollY = 0;
			} else if (this.y <= 5 && pullDownEl && pullDownEl.className.match('flip')) {
				pullDownEl.className = 'pullDown';
				pullDownEl.querySelector('.pullDownLabel').innerHTML = '向下拖曳更新';
				this.minScrollY = -pullDownOffset;
			}

			//console.log(this.y);
			pullActionDetect.check(0);

		}
	});
	myScroll.on('scrollEnd', function () {
		//console.log('scroll ended');
		setTimeout(function() {
			scroll_in_progress = false;
		}, 100);
		if ($('#wrapper table tr').length >= items_per_page) {
			if (pullDownEl && pullDownEl.className.match('flip')) {
				pullDownEl.className = 'pullDown loading';
				pullDownEl.querySelector('.pullDownLabel').innerHTML = 'Loading...';
				pullDownAction();
			}
			// We let the momentum scroll finish, and if reached the end - loading the next page
			pullActionDetect.check(0);
		}
	});

	// In order to prevent seeing the "pull down to refresh" before the iScoll is trigger - the wrapper is located at left:-9999px and returned to left:0 after the iScoll is initiated
	setTimeout(function() {
		$('#wrapper').css({left:0});
	}, 1000);
}
