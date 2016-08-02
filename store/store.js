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
			search_com = setInterval(function () {
				if ($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue && $("#search_word").val() != "") ){
					$("#show_search_store").hide();
					show_store_list();
					$("#show_search_store").fadeIn(500);					}
				}, 500);
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
function view_store(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#store_bar").hide();
			$("#into_store").hide();
			document.getElementById("into_store").innerHTML = xhttp.responseText;
			initMap();//set google map
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

function store_submmit(){
	$.ajax({
		url: './store/add.php',
		data: $('#store_ajaxForm').serialize(),
		type:"POST",
		dataType:'json',

		success: function(data){
			show_store_list();
			view_store(data.p);
		}
	});
}

function add_new_store(){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#store_bar").hide();
			$("#into_store").hide();
			document.getElementById("into_store").innerHTML = xhttp.responseText;
			$("#into_store").fadeIn(500);
		}
	};
	xhttp.open("GET", "./store/create_store.php", true);
	xhttp.send();
}
