var lastwordValue = '';
var lastforValue = '';
var search_sto;

function clear(){
	clearInterval(search_sto);
}
function show_store_list(){
	lastwordValue = $("#search_word").val();
	lastforValue = $("#search_for").val();
	
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if ($("#show_search_store") != null)
				document.getElementById("show_search_store").innerHTML = xhttp.responseText;
		}
	};
	var q = $("#search_for").val();
	var word = $("#search_word").val();
	xhttp.open("GET", "./store/store_search.php?q="+q+"&word="+word, true);
	xhttp.send();
}

function store_list(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#show_search_store").hide();
			show_store_list();
			$("#show_search_store").fadeIn(500);
			if ($("#search_word") != null){
				setInterval(function () {
					if ($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue ) ){
						$("#show_search_store").hide();
						show_store_list();
						$("#show_search_store").fadeIn(500);					}
					}, 500);
			}
		}
	};
	xhttp.open("GET", "./store/store_list.html", true);
	xhttp.send();
}
function find_address(id){
	$.post("./store/check_store.php",
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
		}
	};
	xhttp.open("GET", "./store/store.php?store_id="+id, true);
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
	xhttp.open("GET", "./store/create_store.php", true);
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
