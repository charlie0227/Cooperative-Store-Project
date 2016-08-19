<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script src="api/fbapi.js"></script>
  <script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];

	var source = [ { value: "www.foo.com", //©ñ¦W¦r
				 url:"ttt",
				 test:"123",
                 label: "Spencer Kline"
               },
               { value: "www.example.com",
			   url:"ttt",
			    test:"123",
                 label: "James Bond"
               }
             ];

    $( "#ttt" ).autocomplete({
      source: source,
	  select: function( event, ui ) { 
			alert(ui.item.test);
            //window.location.href = ui.item.value;
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
         return $("<li></li>")
             .data("item.autocomplete", item)
             .append("<a href=#>" + item.label + "</a></br>" + item.value)
             .appendTo(ul);
     };
  


$(document).ready(function(){
	$.post("../search_bar.php",
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
			arr = arr.concat(obj_tmp);
		}
		alert(obj.list[0].type);
		$( "#tags" ).autocomplete({
		  source: arr,
		  select: function( event, ui ) {
				alert(ui.item.id);
			}
		}).data("ui-autocomplete")._renderItem = function (ul, item) {
         return $("<li></li>")
             .data("item.autocomplete", item)
             .append("<a href=#>" + item.label + "</a></br>" + item.address)
             .appendTo(ul);
     };
	  });
});
  });
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div>

<div class="ui-widget">
  <label for="ttt">Tags: </label>
  <input id="ttt">
</div>
 
 <fb:login-button style="z-index: 2" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
				
 
</body>
</html>