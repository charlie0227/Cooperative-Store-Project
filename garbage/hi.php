<<<<<<< HEAD
<!DOCTYPE html>
<html>
<body>

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>
<script src="../js/jquery-3.1.0.min.js"></script>
<script>

var x = document.getElementById("demo");

function getLocation() {
	
    if (navigator.geolocation) {
		
			
        navigator.geolocation.getCurrentPosition(showPosition,error);
    } else {

        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function error(){
	alert('87');
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
}
</script>

</body>
</html>

=======
<!DOCTYPE html>
<html>
<body>

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>
<script src="../js/jquery-3.1.0.min.js"></script>
<script>

var x = document.getElementById("demo");

function getLocation() {
	
    if (navigator.geolocation) {
		
			
        navigator.geolocation.getCurrentPosition(showPosition,error);
    } else {

        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function error(){
	alert('87');
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
}
</script>

</body>
</html>

>>>>>>> 66a3ddb79f85f58a773cb1462c49c2750f939b6a
