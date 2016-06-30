<!DOCTYPE HTML>

<html>
<meta charset="utf-8" />
	欄位	:<input type="number" id = "test" class="form-control" step="1" value="4" name="age" min="1" max="15">
	
	<textarea name="TextBox1" id="TextBox1" style="width:1500px;height:600px;">
	
	</textarea>
	<input type="button" value="Read" onClick="testGG()">

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.scrollzer.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->	
	<script src="assets/js/main.js"></script>
	

	<table border="1" width="100%" height="100" id="table1"> 
	</table> 
	
	
	<script> 

	
	
$(document).ready(function(){
    
	$("#TextBox1").change(function(){
		var str=$(this).val();
		if(str){
			$("#table1").html("");
			var test = document.getElementById("test");
			var xxx = document.getElementById("TextBox1");
			var yyy = xxx.value.split(/\s+/); 
			
			var check = 0;
			var t = document.getElementById("table1");
			document.getElementById("TextBox1").value = "";
			for(var i = 0;i < yyy.length; i++){ 
				
				if(i%test.value==0)
				{
					t.insertRow();
					if(check)
						document.getElementById("TextBox1").value += "\n";
				}	
				t.rows[Math.floor(i/test.value)].insertCell(i%test.value);
				t.rows[Math.floor(i/test.value)].cells[i%test.value].innerText = yyy[i];   
				document.getElementById("TextBox1").value += yyy[i];
				document.getElementById("TextBox1").value += "  ";
				check = 1;
			}
			
			
		}
		
	});
	
});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</script> 
	
</html>
