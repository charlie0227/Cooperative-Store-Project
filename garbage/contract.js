//contract_list
function contract_list(){
	var str = "5";
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				$("#my_member").show();
				$("#show_one_store_for_my_member").hide();
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				contract_function();
			}
		};
		xmlhttp.open("GET","contract_list.php",true);
		xmlhttp.send();
	}
}
//get into contract 
function get_contract(member1,member2,store){
		$.post("contract_confirm.php",
		{
		  datatype:'json',
		  status:'check',
		  store_id:store,
		  member1_id:member1,
		  member2_id:member2
		},
		function(data){
			var obj=JSON.parse(data);
			$("#membership").show();
			$("#new").hide();
			$("#stores").hide();
			document.getElementById("my_member").innerHTML="";
			document.getElementById("div_show_all_store").innerHTML = "";
			func_contract(data);
		}
		
		);
}
function func_contract(data){
	var str = "5";
	var obj=JSON.parse(data);	
	if (str == "") {
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("my_member").innerHTML = xmlhttp.responseText;
				document.getElementById("con_content").innerHTML=obj.message;
				document.getElementById("con_after").innerHTML=obj.message;
				document.getElementById("con_me").innerHTML=obj.myname+obj.check1;
				document.getElementById("con_you").innerHTML=obj.youname+obj.check2;						
				if(obj.check1==" checked"){
					$("#con_unchecked").hide();
					$("#con_checked").show();
				}
				else{
					$("#con_unchecked").show();
					$("#con_checked").hide();
				}
			}
		};
		str="contract.php?store_id="+obj.store_id+"&member2="+obj.member2_id;
		xmlhttp.open("GET",str,true);
		xmlhttp.send();
	}
	
}
function edit_contract(member1,member2,store,status,myname,youname){
		
		var content="";
		if(status=='edit')
			content=document.getElementById("con_after").value;
		else
			content=document.getElementById("con_content").value;
		$.post("contract_confirm.php",
		{
		  datatype:'json',
		  status:status,
		  store_id:store,
		  member1_id:member1,
		  member2_id:member2,
		  myname:myname,
		  youname:youname,
		  content:content
		},
		function(data){
			var obj=JSON.parse(data);
			document.getElementById("con_after").innerHTML=obj.message;
			document.getElementById("con_me").innerHTML=obj.myname+obj.check1;
			document.getElementById("con_you").innerHTML=obj.youname+obj.check2;
			
			if(obj.check1==" checked"){
				$("#con_unchecked").hide();
				$("#con_checked").show();
			}
			else{
				$("#con_unchecked").show();
				$("#con_checked").hide();
			}
			
	

		});
}
