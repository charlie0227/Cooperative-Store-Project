var req = require("request");
req('https://maps.googleapis.com/maps/api/place/radarsearch/json',{
	method:"GET",
	form:{
		location:'25.047908,121.517315',
		radius:20,
		types:'food',
		key:'AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI'
	}
	}, function (error, response, body) {
	if(error) {
		console.log(error);
	} else {
		console.log(body);
	}
});