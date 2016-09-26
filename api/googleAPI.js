var map;
var geocoder;

function initMap(map_id) {
  map = new google.maps.Map(document.getElementById(map_id), {
    center: {lat: 23.397, lng: 120.644},
    zoom: 17
  });
  geocoder = new google.maps.Geocoder();
  
  
  //var address = '台北市內湖區民權東路6段180巷14號';
 //geocodeAddress(address);
}
function getPositionSuccess(position){   //尚不支援
    initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);   
    //定位到目前位置   
    map.setCenter(initialLocation);   
	alert('okk');
}   

function geocodeAddress(address) {
  //var address = document.getElementById('address').value; //填入address
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      });
	  //marker.setMap(map_id);
  }
  });
}

function show_store_near(){
	alert('here');
	//initMap('news_map');
	var address=document.getElementById("search_place").value;
	geocodeAddress(address);
	var type="food";
	var radius=5000;
	geocoder.geocode({'address': address}, function(results, status) {
		var latlng=results[0].geometry.location.toString();
			latlng=(latlng.substring(1,latlng.length-1));
		alert(type);
		alert(radius);
		alert(latlng);
		var asd="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location="+latlng+"&radius="+radius+"&types="+type+"&key=AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI";
		console.log(asd);
		
		$.post("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location="+latlng+"&radius="+radius+"&types="+type+"&key=AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI",
		{
		  datatype:'json'
		},
		function(data){
			alert(data);
		});
		
	});
}

function show_store_near_in_database(){
	initMap('news_map');
	var addr=document.getElementById("search_place").value;
	geocodeAddress(addr);
	$.post("function/search_bar.php",
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
			obj_tmp.name = obj.list[i].name;
			obj_tmp.address = obj.list[i].address;
			obj_tmp.id = obj.list[i].id
			obj_tmp.label = obj.list[i].name;
			obj_tmp.type = obj.list[i].type;
			obj_tmp.img_url = obj.list[i].image_url;
			arr = arr.concat(obj_tmp);
		}
		/*
		for(var i=0;i<arr.length;i++){
			if(arr[i].type==0){//store
			if(arr[i].address.length>1){
				var name = arr[i].name;
				var img_url=arr[i].img_url;
				var address=arr[i].address;
				var marker;
				var temp=0;
                var html = "<h3>" + name + "</h3><p>"; // 設定點選地圖標記後的對話氣泡框的內容 (可以使用 HTML tag)
                // 把地標加到地圖上
				geocoder.geocode({'address': address}, function(results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
						
					  //alert(arr[i].address);
					  //<img id="store_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
					  var infowindow = new google.maps.InfoWindow({
						content: '<img style="height:50px;width:50px;"src="'+img_url+'"<br>name'+ name + '<br>address'+ address + '<br>',
						maxWidth: 200
					  });
					  marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
						//icon : arr[i].img_url
					  });
					  alert(results[0].geometry.location);
					  marker.addListener('click', function() {
						infowindow.open(map, marker);
					  });
					  alert(name);
					  //marker.setMap(map_id);
				  }
				  });
				  alert(name);
			}
				
			}
		}
		*/
		$(arr).each(function(i){

			setTimeout(function(){

			if(arr[i].type==0){//store
			if(arr[i].address.length>1){
				var id = arr[i].id;
				var name = arr[i].name;
				var img_url=arr[i].img_url;
				var address=arr[i].address;
				var marker;
				var p="'store_map'";
                // 把地標加到地圖上
				geocoder.geocode({'address': address}, function(results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
						
					  //alert(arr[i].address);
					  //<img id="store_img" onclick=" var newwin = window.open();newwin.location='http://people.cs.nctu.edu.tw/~cwchen05030530/<?echo $result_img->image_url?>';" src="<?echo $result_img->image_url?>"/>
					  var infowindow = new google.maps.InfoWindow({
						content: '<div onclick="view_store('+id+','+p+'); show_box_close()"><div style="width:31px"><img style="height:31px;width:31px;"src="'+img_url+'"</div><div style="80px">'+ name + '<br>'+ address + '</div></div>',
						maxWidth: 200
					  });
					  marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
						//icon : arr[i].img_url
					  });
					  marker.addListener('click', function() {
						infowindow.open(map, marker);
					  });
					  //marker.setMap(map_id);
				  }
				  });
			}
				
			}

			}, 200);

		});
	});
}



 

