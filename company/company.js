var lastwordValue = '';
var lastforValue = '';
var search_com;
var clear_interval =function (interval){
	clearInterval(interval);
}
function show_company_list(){
	$("#search_for").kendoDropDownList({
		optionLabel: "--項目--"
	});

	lastwordValue = $("#search_word").val();
	lastforValue = $("#search_for").val();

	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if(document.getElementById("company_bar")!= null)
				document.getElementById("show_search_company").innerHTML = xhttp.responseText;
		}
	};
	var q = $("#search_for").val();
	var word = $("#search_word").val();
	xhttp.open("GET", "company/company_search.php?q="+q+"&word="+word, true);
	xhttp.send();
}

function company_list(){
	$('#loading').show();
	$('#back_history').val('company');
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("content").innerHTML = xhttp.responseText;
			$("#show_search_company").hide();
			show_company_list();
			$('#loading').hide();
			$("#show_search_company").fadeIn(500);
			search_com=setInterval(function () {
				if(document.getElementById("company_bar")== null){
					clear_interval(search_com);
				}
				else if ($("#search_word").val() != lastwordValue || ($("#search_for").val() != lastforValue && $("#search_word").val() != "") ){
					$("#show_search_company").hide();
					$('#loading').show();
					show_company_list();
					$('#loading').hide();
					$("#show_search_company").fadeIn(500);
				}
			}, 500);
		}
	};
	xhttp.open("GET", "company/company_list.html", true);
	xhttp.send();
	$(".mem_op").slideUp();
}

function view_company(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#company_bar").hide();
			$("#into_company").hide();
			document.getElementById("into_company").innerHTML = xhttp.responseText;
			$("#into_company").fadeIn(500);
		}
	};
	xhttp.open("GET", "company/company.php?company_id="+id, true);
	xhttp.send();
	}
function back_to_company_list(){
	$("#into_company").hide();
	$("#company_bar").fadeIn(500);
}

function add_new_company(){
	company_list();
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#company_bar").hide();
			$("#into_company").hide();
			document.getElementById("into_company").innerHTML = xhttp.responseText;
			add_company_ready();
			$("#into_company").fadeIn(500);
		}
	};
	xhttp.open("GET", "company/create_company.php", true);
	xhttp.send();
}
function add_company_ready(){
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
	//preview image
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
}
function company_submit(){
	$('#company_ajaxForm').click(function() {
		var $name = $('#company_ajaxForm').find('input[name="name"]');
		var $phone = $('#company_ajaxForm').find('input[name="phone"]');
		var $address = $('#company_ajaxForm').find('input[name="address"]');
		var $url = $('#company_ajaxForm').find('input[name="url"]');
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
		    url: 'company/add.php',
		    type: 'POST',
		    cache: false,
		    data: data,
		    processData: false,
		    contentType: false
		}).done(function(res) {
			var obj = JSON.parse(res);
			view_company(obj.p);
			return false;
	}).fail(function(res) {alert(res);return false;});
		event.preventDefault();
	});
}

function view_company(id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			$("#company_bar").hide();
			$("#into_company").hide();
			document.getElementById("into_company").innerHTML = xhttp.responseText;
			$("#into_company").fadeIn(500);
		}
	};
	xhttp.open("GET", "company/company.php?company_id="+id, true);
	xhttp.send();
}

function apply(member_id,company_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "company/application_form.php?company_id="+company_id+"&member_id="+member_id, true);
	xhttp.send();
}
function apply_cancel(member_id,company_id,type){
	$.post("member/application_confirm.php",
	{
		datatype:'json',
		member_id:member_id,
		company_id:company_id,
		type:type

	},
	function(){
		view_company(company_id);
	});
}
function application_submit(){
	$.ajax({
		type:'POST',
		url:'company/application_join.php',
		data:$('#application_ajaxForm').serialize(),
		dataType:'json',
		success:function(r){
			//alert(r.result);
			show_box_close();
			view_company(r);
			return false;
		},
		error:function(){
			return false;
		}
	});
}
