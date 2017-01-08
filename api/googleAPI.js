var map;
var geocoder;
var infowindow;
var center_marker;
var last_pos;
var EARTH_RADIUS = 6378137.0;    //?��M
var PI = Math.PI;

//https://www.google.com.tw/search?tbm=isch&q=%E5%BC%B5%E9%A0%86%E7%A8%8B
function initMap(map_id) {

  map = new google.maps.Map(document.getElementById(map_id), {
    center: {lat: 23.397, lng: 120.644},
    zoom: 17
  });
  geocoder = new google.maps.Geocoder();


  //var address = '�x�_�������ϥ��v�F��6�q180��14��';
 //geocodeAddress(address);
}
function getPositionSuccess(position){   //�|���䴩
    initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
    //�w�����ثe���m
    map.setCenter(initialLocation);
	alert('okk');
}

function geocodeAddress(address) {
  //var address = document.getElementById('address').value; //���Jaddress
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
function show_store(map_id){
	var pyrmont = new google.maps.LatLng(23.9756500,120.97388194);

	map = new google.maps.Map(document.getElementById(map_id), {
	  center: pyrmont,
	  zoom: 10
	});
	var address=document.getElementById("search_word").value;
	var request = {
	location: pyrmont,
	radius: '2000000',
	query: address
	};
	var service = new google.maps.places.PlacesService(map);
	service.textSearch(request, callback);
	//23.9756500
	//120.97388194
	function callback(results, status) {
	  if (status == google.maps.places.PlacesServiceStatus.OK) {
		for (var i = 0; i < results.length; i++) {
		  var place = results[i];
		  if(results.length==1){
			  createMarker(results[i],true);
		  }
		  else{
			createMarker(results[i],false);
		  }
		}
	  }
	}
	function createMarker(place,type) {
		if(type){
			center_marker = new google.maps.Marker({
					map: map,
					draggable: true,
					position: place.geometry.location

				  });
			show_store_near('show_search_store',true);
		}
		else{
			  var marker = new google.maps.Marker({
				map: map,
				//icon: place.icon,
				id: place.place_id,
				position: place.geometry.location
			  });
			  google.maps.event.addListener(marker, 'click', function() {
				  map = new google.maps.Map(document.getElementById(map_id), {
					center: marker.getPosition(),
					zoom: 17
				  });
				 center_marker = new google.maps.Marker({
					map: map,
					draggable: true,
					position: marker.getPosition()

				  });

				 show_store_near('show_search_store',true);
			  });
		}
	}
}

function show_store_near(map_id,type){//not in database
	//alert(type);
	if(type){
		initMap(map_id);
	}

		if(!type){
			var latlng=results[0].geometry.location;
		}
		else{
			latlng=center_marker.getPosition();
			map = new google.maps.Map(document.getElementById(map_id), {
					center: latlng,
					zoom: 17
				  });
				 center_marker = new google.maps.Marker({
					map: map,
					draggable: true,
					position: latlng

				  });
				  center_marker.setIcon('https://maps.google.com/mapfiles/ms/icons/green-dot.png');
				google.maps.event.addListener(center_marker, 'dragend', function()
					{
						show_store_near('show_search_store',true);

					});
			//alert(latlng);
		}



		var infowindow = new google.maps.InfoWindow();
		var service = new google.maps.places.PlacesService(map);
		var rad = 1000;
		function todo(){
			service.radarSearch({
			location: latlng,
			radius: rad,
			types: ['food']
		  }, callback);
		}
		todo();
		  var ttt=0;
		function callback(results, status) {
		  if (status === google.maps.places.PlacesServiceStatus.OK) {
			if(results.length>=199){
				if(rad>500){
					rad = rad - 500;
				}
				else if(rad>250){
					rad = rad - 250;
				}
				else if(rad>250){
					rad = rad - 100;
				}
				else{
					rad = rad - 50;
				}
				todo();
			}
			else{
				for (var i = 0; i < results.length; i++) {
					createMarker(results[i]);
				  //service.getDetails(results[i],createMarker);
				}
				//alert(results.length+"!!!"+rad);
			}
		  }
		}

		function createMarker(place) {

			  ttt=ttt+1;
				var photos = place.photos;

					var marker = new google.maps.Marker({
					map: map,
					//icon: place.icon,
					id: place.place_id,
					position: place.geometry.location

				  });
				  marker.setIcon('https://maps.google.com/mapfiles/ms/icons/red-dot.png');
				  google.maps.event.addListener(marker, 'click', function() {
					//infowindow.setContent(place.name+'<br>'+place.formatted_address+'<br>'+place.formatted_phone_number);
					service.getDetails(place,setinfo);
					//setTimeout(function(){infowindow.open(map, this);},500);
          infowindow.open(map, this);
				  });


		}

		function setinfo(place,status){
			var photos = place.photos;
			var img_url='';
		  if (!photos) {
		    infowindow.setContent(place.name+'<br>'+place.formatted_address+'<br>'+place.formatted_phone_number+'<br>');
		  }
			else{
				img_url=photos[0].getUrl({'maxWidth': 600, 'maxHeight': 600});
				infowindow.setContent('<img src='+photos[0].getUrl({'maxWidth': 150, 'maxHeight': 150})+'><br>'+place.name+'<br>'+place.formatted_address+'<br>'+place.formatted_phone_number+'<br>');
			}
      console.log(infowindow.content);
//"https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference="+place.photos[0].photo_reference+"&key=AIzaSyDDhjNzjNq5S_wfT6FkGqhfqyThsXCrGKA"
			//alert(infowindow.getPosition());
			var jsonlocation={
				lat:infowindow.getPosition().lat(),
				lng:infowindow.getPosition().lng()
			};
			$.post("GoogleApiAuto/add_DB.php",
			{
				datatype:'json',
				way:'add_new_store',
				place_id:place.id,
				name:place.name,
				phone:place.formatted_phone_number,
				address:place.formatted_address,
				url:place.website,
				image:img_url,
				location:JSON.stringify(jsonlocation),
			},
			function(data){
        var obj = JSON.parse(data);
        infowindow.close();
        var s = "'store_map'";
        infowindow.setContent(infowindow.content+'<br><a href="#" onclick="view_store('+obj.store_id+','+s+')">前往了解更多...</a>');
        console.log(infowindow.content);
        infowindow.open(map);
			}
			);
		}
}

function grab_first_image(){
	window.open()
	//https://www.google.com.tw/search?tbm=isch&q=�i���{

}

function get_location_and_distance(){
	if (window.navigator.geolocation==undefined) {
		alert("do not support loaction");
	}
	else {
		var geolocation=window.navigator.geolocation; //���o Geolocation ����
		//�a�z�w���{���X
		var option={
		  enableAcuracy:false,
		  maximumAge:0,
		  timeout:600000
		  };
		geolocation.getCurrentPosition(successCallback,
								   errorCallback,
								   option
								   );
		}
		function successCallback(position) {
			initMap('show_search_store');
			map = new google.maps.Map(document.getElementById('show_search_store'), {
					center: {lat: position.coords.latitude, lng: position.coords.longitude},
					zoom: 17
				  });
			center_marker = new google.maps.Marker({
				map: map,
				draggable: true,
				position: {lat: position.coords.latitude, lng: position.coords.longitude}

			  });
			  center_marker.setIcon('https://maps.google.com/mapfiles/ms/icons/green-dot.png');
			google.maps.event.addListener(center_marker, 'dragend', function()
				{
					show_store_near('show_search_store',true);

				});
			show_store_near('show_search_store',true)
			/*
			alert(position.coords.latitude+","+position.coords.longitude);
			var lat1=position.coords.latitude;
			var lng1=position.coords.longitude;
			var lat2,lng2;
			var dis = new Array();
			if(document.getElementsByTagName("td").length>=6){
				geocoder = new google.maps.Geocoder();

				//my_recusive(8,document.getElementsByTagName("td").length,lat1,lng1);
			}

			*/
		}
		/*
		function my_recusive(temp,end,lat1,lng1){
			if(end>=temp){
				if(temp/5>11)
				geocoder.geocode({'address': document.getElementsByTagName("td")[temp].innerHTML}, function(results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
						var lat2=results[0].geometry.location.lat();
						var lng2=results[0].geometry.location.lng();
						var radLat1 = getRad(lat1);
						var radLat2 = getRad(lat2);

						var a = radLat1 - radLat2;
						var b = getRad(lng1) - getRad(lng2);

						var s = 2*Math.asin(Math.sqrt(Math.pow(Math.sin(a/2),2) + Math.cos(radLat1)*Math.cos(radLat2)*Math.pow(Math.sin(b/2),2)));
						s = s*EARTH_RADIUS;
						s = Math.round(s*10000)/10000.0;
						//dis.push(s);
						document.getElementsByTagName("td")[temp+1].innerHTML = s;
					}
					my_recusive(temp+5,end,lat1,lng1);
				});
			}
			else{
				//alert(dis);
				//alert(dis.length);
				;
			}
		}
		*/
		function getRad(d){
			return d*PI/180.0;
		}

		function errorCallback(error) {
			var errorTypes={
				0:"�������]���~",
				1:"�ϥΪ̩ڵ����Ѧ��m���T",
				2:"�L�k���o���m���T",
				3:"���m�d�߹O��"
				};
			alert(errorTypes[error.code]);
			//alert(error.message);  //���ծɥ�
		}
}
