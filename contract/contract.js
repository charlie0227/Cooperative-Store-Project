var status;
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
				$('#into_company_contract').hide();
				document.getElementById("into_company_contract").innerHTML = xhttp.responseText;
				
			}
			if(who=='company'){
				$('#into_store').hide();
				$('#into_store_contract').hide();
				document.getElementById("into_store_contract").innerHTML = xhttp.responseText;
			}	
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
					document.getElementById("s_owner").innerHTML ='<input type="text" class="k-textbox" id="store_owner"/>';
					document.getElementById("s_address").innerHTML ='<input type="text" class="k-textbox" id="store_address"/>';
					document.getElementById("s_phone").innerHTML ='<input type="text" class="k-textbox" id="store_phone"/>';
					document.getElementById("fill_store").innerHTML ='<input type="button" class="k-button" style="margin: 2px;" onclick="fill('+store_id+','+company_id+",'"+who+"'"+')" value="填入"/>';
					document.getElementById("back_to_where").innerHTML ='<input type="button" class="k-button" value="返回" onclick="back_to_company()"/>';
					status=1;
					
				}
				if(obj.who=='company'){
					document.getElementById("c_owner").innerHTML ='<input type="text" class="k-textbox" id="company_owner"/>';
					document.getElementById("c_address").innerHTML ='<input type="text"class="k-textbox" id="company_address"/>';
					document.getElementById("c_phone").innerHTML ='<input type="text" class="k-textbox" id="company_phone"/>';
					document.getElementById("fill_company").innerHTML ='<input type="button" class="k-button" style="margin: 2px;" onclick="fill('+store_id+','+company_id+",'"+who+"'"+')" value="填入"/>';
					document.getElementById("back_to_where").innerHTML ='<input type="button" class="k-button" value="返回" onclick="back_to_store()"/>';
					status=0;
				}
				document.getElementById("contract_who").innerHTML =obj.contract;
				document.getElementById("store_id").value = store_id;
				document.getElementById("company_id").value = company_id;
				contract_content_function();
				contract_date_fill()
				if(obj.who=='store')
					$('#into_company_contract').fadeIn(500);
				if(obj.who=='company')
					$('#into_store_contract').fadeIn(500);
			});
			
		}
	};
	xhttp.open("GET", "contract/contract.html", true);
	xhttp.send();
}
function contract_manage(contract_id,who){
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			show_box_close();
			document.getElementById("my_member").innerHTML = xhttp.responseText;
			$.post("contract/contract.php",
			{
				contract_id:contract_id,
				who:who,
			    datatype:'json'
			},
			function(data){
				var obj=JSON.parse(data);
				alert(obj.content.remark);
				document.getElementById("date_sta").value =obj.date_sta;
				document.getElementById("date_end").value =obj.date_end;
				document.getElementById("now_date").innerHTML=obj.date_sign;
				document.getElementById("store_name1").innerHTML =obj.store_name;
				document.getElementById("store_name2").innerHTML =obj.store_name;
				document.getElementById("company_name1").innerHTML =obj.company_name;
				document.getElementById("company_name2").innerHTML =obj.company_name;
				if(obj.status==0 && who=='company'){
					document.getElementById("c_owner").innerHTML ='<input type="text" class="k-textbox" id="company_owner" value="'+obj.company_owner+'"/>';
					document.getElementById("c_address").innerHTML ='<input type="text"class="k-textbox" id="company_address" value="'+obj.company_address+'"/>';
					document.getElementById("c_phone").innerHTML ='<input type="text" class="k-textbox" id="company_phone" value="'+obj.company_phone+'"/>';
					document.getElementById("fill_company").innerHTML ='<input type="button" class="k-button" style="margin: 2px;" onclick="fill('+store_id+','+company_id+",'"+who+"'"+')" value="填入"/>';
					document.getElementById("back_to_where").innerHTML ='<input type="button" class="k-button" value="返回" onclick="my_store_company_list()"/>';
					document.getElementById("contract_who").innerHTML =obj.contract;
					document.getElementById("contract_remark").value =obj.content.remark;
					status=0;
				}
				if(obj.status==0 && who=='store'){
					//store see company expect and fill discount 
					status=1;
				}
				if(obj.status==1 && who=='store'){
					//edit discount
					status=1;
				}
				if(obj.status==1 && who=='company'){
					//sign contract yes=2 no=0
					status=2;
				}
				if(obj.status==2 && who=='company'){
					//already lock wait store
					status=2;
				}
				if(obj.status==2 && who=='store'){
					//check locked contract agree=3 sign success
					status=3;
				}
				contract_content_function();
				
				
			});
			
		}
	};
	xhttp.open("GET", "contract/contract.html", true);
	xhttp.send();
}

function contract_content_function(){
	var static_num;
	var big=0,small=0,people=0,time='';
	var method='';
	var manual=new Array();
	contract_date_function();
	//tabstrip
	$(".tabstrip").kendoTabStrip({
		animation:  {
			open: {
				effects: "fadeIn"
			}
		}
	});
	//click on text then choose radio
	$('.tabstrip input[type=text]').on('click',function(){
		$(this).siblings('input[type=radio]').prop('checked', false);
		$(this).parent().prev().prop('checked', true);
	});
	//calculate number
	$('.static_discount input[type=radio]').on('change',function(){
			get_stnum();
			caculate_stcontract();
	});
	$('.dynamic_discount input[type=radio]').on('change',function(){
			get_dynum();
			caculate_dycontract();
	});
	//numeric test
	$('.static_discount input[type=text]').on('focusout',function(){
		if(!Number.isInteger(parseFloat($(this).val())) && $(this).val()!=''){
			$(this).next().html('請輸入整數');
			$(this).val('');
		}
		else
			$(this).next().html('');
		get_stnum();
		caculate_stcontract();
	});
	$('.dynamic_discount input[type=text]').on('focusout',function(){
		if(!Number.isInteger(parseFloat($(this).val())) && $(this).val()!=''){
			$(this).next().html('請輸入整數');
			$(this).val('');
		}
		else
			$(this).next().html('');
		get_dynum();
		caculate_dycontract();
	});
	//block big<small
	$('.dynamic_discount input[name=dyn_big]').on('change',function(){
		disable_small();
	});
	function disable_small(){
		$('.dynamic_discount input[name=dyn_small][type=radio]').each(function(){
			if($(this).val()>=big){
				$(this).prop('checked', false);	
				$(this).prop('disabled', true);	
			}
			else
				$(this).prop('disabled', false);
			$('#big_4').prop('disabled', false);
			$('#small_4').prop('disabled', false);
		});
	}
	//tab change clear radio
	$('.static_discount input[type=radio]').on('change',function(){
		$('.dynamic_discount').find('input[type=radio]').prop('checked', false);
		
	});	
	$('.dynamic_discount input[type=radio]').on('change',function(){
		$('.static_discount').find('input[type=radio]').prop('checked', false);
	});
	function get_stnum(){
		var stma=document.getElementById("dis_5_num").value;
		static_num =$('input[id=dis_1]').is(':checked')?$('input[id=dis_1]').val():
					$('input[id=dis_2]').is(':checked')?$('input[id=dis_2]').val():
					$('input[id=dis_3]').is(':checked')?$('input[id=dis_3]').val():
					$('input[id=dis_4]').is(':checked')?$('input[id=dis_4]').val():
					stma<10?stma*10:stma;
	}
	function get_dynum(){
		manual[0]=document.getElementById("big_4_num").value;
		manual[1]=document.getElementById("people_5_num").value;
		manual[2]=document.getElementById("small_4_num").value;
		big   = $('input[id=big_1]').is(':checked')?$('input[id=big_1]').val():
				$('input[id=big_2]').is(':checked')?$('input[id=big_2]').val():
				$('input[id=big_3]').is(':checked')?$('input[id=big_3]').val():
				manual[0]<10?manual[0]*10:manual[0];
		small = $('input[id=small_1]').is(':checked')?$('input[id=small_1]').val():
				$('input[id=small_2]').is(':checked')?$('input[id=small_2]').val():
				$('input[id=small_3]').is(':checked')?$('input[id=small_3]').val():
				manual[2]<10?manual[2]*10:manual[2];
		people=$('input[id=people_1]').is(':checked')?$('input[id=people_1]').val():
				$('input[id=people_2]').is(':checked')?$('input[id=people_2]').val():
				$('input[id=people_3]').is(':checked')?$('input[id=people_3]').val():
				$('input[id=people_4]').is(':checked')?$('input[id=people_4]').val():manual[1];
		time  =$('input[id=time_1]').is(':checked')?'直到合約結束':
			   $('input[id=time_2]').is(':checked')?'每年重新計算':
			   $('input[id=time_3]').is(':checked')?'半年重新計算':
			   $('input[id=time_4]').is(':checked')?'每月重新計算':'';
	}
	
	function caculate_stcontract(){
		var content = '';
		content=content+'基本折扣: ';
		if($('input[name=sta_dis]').is(':checked')){
			var num=(static_num%10==0)?static_num/10:static_num;
			if(num)
				content=content+num+'折';
		}
		document.getElementById("show_discount").innerHTML = '';
		document.getElementById("contract_content").innerHTML = content;
		$('.auto_calculate').fadeIn(500);
		method='static';
	}
	function caculate_dycontract(){
		var result = '';
		if(big&&people&&small){
			if(big-1<small)
				result=result+'請輸入基本折扣>最低折扣';
			else{
				var ff=0,dis=Math.floor((big-small)/4);
				for(var i=big;i>small;i-=dis){
					var num=(i%10==0)?i/10:i;
					result=result+'相當於達'+people*ff+'人享'+num+'折<br>';
					ff+=dis;
				}
				var x=(small%10==0)?small/10:small;
				result=result+'相當於達'+people*(big-small)+'人享'+x+'折<br>';
			}
		}
		var content = '';	
		content=content+'基本折扣: ';
		if($('input[name=dyn_big]').is(':checked')){
			var num=(big%10==0)?big/10:big;
			if(num)
				content=content+num+'折';
		}
		content=content+'<br>人數累積: ';
		if($('input[name=dyn_people]').is(':checked')){
			if(people)
				content=content+'每 '+people+' 人消費，可再享折扣 1%';
		}
		content=content+'<br>最低折扣: ';
		if($('input[name=dyn_small]').is(':checked')){
			var num=(small%10==0)?small/10:small;
			if(num)
				content=content+num+'折';
		}
		content=content+'<br>統計時間: ';
		if($('input[name=dyn_time]').is(':checked')){
			content=content+time;
		}
		document.getElementById("show_discount").innerHTML = result;
		document.getElementById("contract_content").innerHTML = content;
		$('.auto_calculate').fadeIn(500);
		method='dynamic';
	}
	$('#send_contract').on('click',function(){
		var content = 
			(method=='static')?
			{
				method:method,
				discount:static_num,
				remark:document.getElementById("contract_remark").value
			}:
			(method=='dynamic')?
			{
				method:method,
				big:big,
				people:people,
				small:small,
				time:time,
				remark:document.getElementById("contract_remark").value
			}:
			{
				remark:document.getElementById("contract_remark").value
			};
			//alert(JSON.stringify(content));
		var store_owner=document.getElementById("store_owner")!=null?document.getElementById("store_owner").value:'';
		var store_address=document.getElementById("store_address")!=null?document.getElementById("store_address").value:'';
		var store_phone=document.getElementById("store_phone")!=null?document.getElementById("store_phone").value:'';
		var company_owner=document.getElementById("company_owner")!=null?document.getElementById("company_owner").value:'';
		var company_address=document.getElementById("company_address")!=null?document.getElementById("company_address").value:'';
		var company_phone=document.getElementById("company_phone")!=null?document.getElementById("company_phone").value:'';
		
		$.post("contract/contract_create.php",
			{
				status:status,
				date_sta:document.getElementById("date_sta").value,
				date_end:document.getElementById("date_end").value,
				date_sign:document.getElementById("now_date").innerHTML,
				content:JSON.stringify(content),
				store_id:document.getElementById("store_id").value,
				store_owner:store_owner,
				store_address:store_address,
				store_phone:store_phone,
				company_id:document.getElementById("company_id").value,
				company_owner:company_owner,
				company_address:company_address,
				company_phone:company_phone,
				datatype:'json'
			},function(data){
				alert(data);
			}
		);
	});
}
function contract_date_function(){
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
function contract_date_fill(){
	var d = new Date();
	document.getElementById("date_sta").value=d.toLocaleDateString();
	document.getElementById("now_date").innerHTML=d.getFullYear()-1911+'  年  '+(d.getMonth()+1)+'  月  '+d.getDate()+'  日';
	
	d.setFullYear(d.getFullYear()+1);
	d.setDate(d.getDate()-1);
	document.getElementById("date_end").value=d.toLocaleDateString();
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
//quick contract
function quick_contract_submit(){
	var stma=document.getElementById("dis_5_num").value;
	static_num =$('input[id=dis_1]').is(':checked')?$('input[id=dis_1]').val():
				$('input[id=dis_2]').is(':checked')?$('input[id=dis_2]').val():
				$('input[id=dis_3]').is(':checked')?$('input[id=dis_3]').val():
				$('input[id=dis_4]').is(':checked')?$('input[id=dis_4]').val():
				stma<10?stma*10:stma;
	var content = 
		{
			method:'static',
			discount:static_num,
			remark:''
		};
	$.post("contract/contract_create.php",
		{
			status:3,
			content:JSON.stringify(content),
			store_id:document.getElementById("quick_store").store_id,
			company_id:document.getElementById("quick_company").company_id,
			datatype:'json'
		},function(data){
			alert(data);
		}
	);
}
function quick_contract_ready(){
	//click on text then choose radio
	$('.quick_discount input[type=text]').on('click',function(){
		$(this).siblings('input[type=radio]').prop('checked', false);
		$(this).parent().prev().prop('checked', true);
	});
	//numeric test
	$('.quick_discount input[type=text]').on('focusout',function(){
		if(!Number.isInteger(parseFloat($(this).val())) && $(this).val()!=''){
			$(this).next().html('請輸入整數');
			$(this).val('');
		}
		else
			$(this).next().html('');
	});
	$.post("function/search_bar.php",
	{
	  datatype:'json'
	},
	function(data){
		
		var temp='{"list":'+data+'}';
		var obj=JSON.parse(temp);
		var availableTags=[];
		var store = new Array();
		var company = new Array();
		for(var i=0;i<obj.list.length;i++){
			
			var obj_tmp = new Object;
			obj_tmp.name = obj.list[i].name;
			obj_tmp.address = obj.list[i].address;
			obj_tmp.id = obj.list[i].id
			obj_tmp.label = obj.list[i].name;
			obj_tmp.img_url = obj.list[i].image_url;
			if(obj.list[i].type==0)//store
				store = store.concat(obj_tmp);
			else//company
				company = company.concat(obj_tmp);
		}
		
			
			var auto_store = $("#quick_store").kendoAutoComplete({
				minLength: 1,
				dataTextField: "name",
				template: '<span class="k-state-default" style="background-image: url(\'#:data.img_url#\')"></span>' +
						  '<span class="k-state-default"><h3>#: data.name #</h3><p>#: data.address #</p></span>',
				virtual: {
					itemHeight: 110
				},
				dataSource: store,
				height: 440,
				select:function(e){
					var dataItem = this.dataItem(e.item.index());
					var obj=JSON.parse(kendo.stringify(dataItem));
					document.getElementById("quick_store").store_id=obj.id;
					document.getElementById("quick_select_store").innerHTML = 
						'<span class="k-state-default" style="background-image: url(\''+obj.img_url+'\')"></span>' +
						'<span class="k-state-default"><h3>'+obj.name+'</h3><p>'+obj.address+'</p></span>';
					
				}
			}).data("kendoAutoComplete");
			$("#quick_store").on('focus',function(){
				auto_store.search($("#quick_store").val());
				
			});
			var auto_company = $("#quick_company").kendoAutoComplete({
				minLength: 1,
				dataTextField: "name",
				dataTextValue: "id",
				template: '<span class="k-state-default" style="background-image: url(\'#:data.img_url#\')"></span>' +
						  '<span class="k-state-default"><h3>#: data.name #</h3><p>#: data.address #</p></span>',
				virtual: {
					itemHeight: 110
				},
				dataSource: company,
				height: 440,
				select:function(e){
					var dataItem = this.dataItem(e.item.index());
					var obj=JSON.parse(kendo.stringify(dataItem));
					document.getElementById("quick_company").company_id=obj.id;
					document.getElementById("quick_select_company").innerHTML = 
						'<span class="k-state-default" style="background-image: url(\''+obj.img_url+'\')"></span>' +
						'<span class="k-state-default"><h3>'+obj.name+'</h3><p>'+obj.address+'</p></span>';
				}
			}).data("kendoAutoComplete");
			$("#quick_company").on('focus',function(){
				auto_company.search($("#quick_company").val());
				
			});
			
	  });
}