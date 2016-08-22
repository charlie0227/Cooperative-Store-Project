function contract_ready(){
	var d = new Date();
	document.getElementById("date_sta").value=d.toLocaleDateString();
	document.getElementById("now_date").innerHTML=d.getFullYear()-1911+'  年  '+(d.getMonth()+1)+'  月  '+d.getDate()+'  日';
	
	d.setFullYear(d.getFullYear()+1);
	d.setDate(d.getDate()-1);
	document.getElementById("date_end").value=d.toLocaleDateString();
	
	function date_staChange() {
		var date_staDate = date_sta.value(),
		endDate = date_end.value();

		if (date_staDate) {
			date_staDate = new Date(date_staDate);
			date_staDate.setDate(date_staDate.getDate());
			date_end.min(date_staDate);
		} else if (endDate) {
			date_sta.max(new Date(endDate));
		} else {
			endDate = new Date();
			date_sta.max(endDate);
			date_end.min(endDate);
		}
	}

	function endChange() {
		var endDate = date_end.value(),
		date_staDate = date_sta.value();

		if (endDate) {
			endDate = new Date(endDate);
			endDate.setDate(endDate.getDate());
			date_sta.max(endDate);
		} else if (date_staDate) {
			date_end.min(new Date(date_staDate));
		} else {
			endDate = new Date();
			date_sta.max(endDate);
			date_end.min(endDate);
		}
	}

	var date_sta = $("#date_sta").kendoDatePicker({
		change: date_staChange
	}).data("kendoDatePicker");

	var date_end = $("#date_end").kendoDatePicker({
		change: endChange
	}).data("kendoDatePicker");

	date_sta.max(date_end.value());
	date_end.min(date_sta.value());
	
}
function select_store(company_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "contract/select_store.php?company_id="+company_id, true);
	xhttp.send();
}
function select_company(store_id){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("show_box").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "contract/select_company.php?store_id="+store_id, true);
	xhttp.send();
}
function contract_make(store_id,company_id,who){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			show_box_close();
			if(who=='store'){
				$('#into_company').hide();
				document.getElementById("into_company_contract").innerHTML = xhttp.responseText;
			}
			if(who=='company'){
				$('#into_store').hide();
				document.getElementById("into_store_contract").innerHTML = xhttp.responseText;
			}	
			contract_ready();
			$.post("contract/contract.php",
			{
				store_id:store_id,
				company_id:company_id,
				who:who,
			    datatype:'json'
			},
			function(data){
				var obj=JSON.parse(data);
				document.getElementById("store_name1").innerHTML =obj.store_name;
				document.getElementById("store_name2").innerHTML =obj.store_name;
				document.getElementById("company_name1").innerHTML =obj.company_name;
				document.getElementById("company_name2").innerHTML =obj.company_name;
				if(obj.who=='store'){
					document.getElementById("s_owner").innerHTML ='<input type="text" id="store_owner"/>';
					document.getElementById("s_address").innerHTML ='<input type="text" id="store_address"/>';
					document.getElementById("s_phone").innerHTML ='<input type="text" id="store_phone"/>';
					document.getElementById("fill_store").innerHTML ='<input type="button" class="k-button" style="margin: 2px;" onclick="fill('+store_id+','+company_id+",'"+who+"'"+')" value="填入"/>';
					document.getElementById("back_to_where").innerHTML ='<input type="button" class="k-button" value="返回" onclick="back_to_company()"/>';
				}
				if(obj.who=='company'){
					document.getElementById("c_owner").innerHTML ='<input type="text" class="k-textbox" id="company_owner"/>';
					document.getElementById("c_address").innerHTML ='<input type="text"class="k-textbox" id="company_address"/>';
					document.getElementById("c_phone").innerHTML ='<input type="text" class="k-textbox" id="company_phone"/>';
					document.getElementById("fill_company").innerHTML ='<input type="button" class="k-button" style="margin: 2px;" onclick="fill('+store_id+','+company_id+",'"+who+"'"+')" value="填入"/>';
					document.getElementById("back_to_where").innerHTML ='<input type="button" class="k-button" value="返回" onclick="back_to_store()"/>';
				}
				document.getElementById("store_id").value = store_id;
				document.getElementById("company_id").value = company_id;
				discount_content();
			});
		}
	};
	xhttp.open("GET", "contract/contract.html", true);
	xhttp.send();
}
function back_to_company(){
	$('#into_company').show();
	document.getElementById("into_company_contract").innerHTML ="";
}
function back_to_store(){
	$('#into_store').show();
	document.getElementById("into_store_contract").innerHTML ="";
}
function fill(store_id,company_id,who){
	$.post("contract/contract.php",
	{
		store_id:store_id,
		company_id:company_id,
		who:who,
		datatype:'json'
	},function(data){
		var obj=JSON.parse(data);
		if(obj.who=='store'){
			document.getElementById("store_owner").value =obj.store_name;
			document.getElementById("store_address").value =obj.store_address;
			document.getElementById("store_phone").value =obj.store_phone;
		}
		if(obj.who=='company'){
			document.getElementById("company_owner").value =obj.company_name;
			document.getElementById("company_address").value =obj.company_address;
			document.getElementById("company_phone").value =obj.company_phone;
			
		}
	});
}

function discount_content(){
	$("#tabstrip").kendoTabStrip({
		animation:  {
			open: {
				effects: "fadeIn"
			}
		}
	});
}
function send_contract(){
	$.post("contract/contract_create.php",
			{
				status:0,
				date_sta:document.getElementById("date_sta").value,
				date_end:document.getElementById("date_end").value,
				content:document.getElementById("date_end").value,
				store_id:document.getElementById("store_id").value,
				store_owner:document.getElementById("store_owner").value,
				store_address:document.getElementById("store_address").value,
				store_phone:document.getElementById("store_phone").value,
				company_id:document.getElementById("company_id").value,
				company_owner:document.getElementById("store_owner").value,
				company_address:document.getElementById("store_address").value,
				company_phone:document.getElementById("store_phone").value,
			    datatype:'json'
			},function(data){
				
		});
	
}