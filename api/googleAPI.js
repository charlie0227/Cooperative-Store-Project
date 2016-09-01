var map;
var geocoder;

function initMap(map_id) {
  map = new google.maps.Map(document.getElementById(map_id), {
    center: {lat: 23.397, lng: 120.644},
    zoom: 17
  });
  geocoder = new google.maps.Geocoder();
  
  
  //var address = '�x�_������ϥ��v�F��6�q180��14��';
 //geocodeAddress(address);
}
function getPositionSuccess(position){   //�|���䴩
    initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);   
    //�w���ثe��m   
    map.setCenter(initialLocation);   
	alert('okk');
}   

function geocodeAddress(address) {
  //var address = document.getElementById('address').value; //��Jaddress
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
	initMap('news_map');
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
                var html = "<h3>" + name + "</h3><p>"; // �]�w�I��a�ϼаO�᪺��ܮ�w�ت����e (�i�H�ϥ� HTML tag)
                // ��a�Х[��a�ϤW
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
				var name = arr[i].name;
				var img_url=arr[i].img_url;
				var address=arr[i].address;
				var marker;
                // ��a�Х[��a�ϤW
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



 

