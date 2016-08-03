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

function geocodeAddress(address) {
  //var address = document.getElementById('address').value; //��Jaddress
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      });
    } 
  });
}