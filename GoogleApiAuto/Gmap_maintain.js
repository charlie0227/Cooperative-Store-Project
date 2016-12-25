var req = require("request");
const readline = require('readline');
var GoogleLocations = require('google-locations');
var Storage = require('node-storage');
var store = new Storage('storage');
var util = require('util');
var x = 2000;
var key = ['AIzaSyCiauOm3OUKekSdpdCA9fRhZQUKArBSBoI',
		   'AIzaSyDDhjNzjNq5S_wfT6FkGqhfqyThsXCrGKA'];
//minemy//
var config = {
	location:{
		lat:21.97690,
		lng:120.3964
	},
	radius:x,
	types:'food',
	key:key[1]
};
var locations = new GoogleLocations(config.key);
var total_result;
var finished_result=0;
var repeated_result=0;
var failed_result=0;
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});
//write log
console.log = function () {
    process.stdout.write(util.format.apply(null, arguments) + '\n');
	var d = new Date();
	var log_name = d.getFullYear()+'-'+('0'+(d.getMonth()+1)).slice(-2)+'-'+('0'+d.getDate()).slice(-2);
	req('https://www.charlie27.me/~xu3u4tp6/GoogleApiAuto/log_write.php',{
		method:"POST",
		form:{
			name:log_name,
			log:util.format.apply(null, arguments)
		}
	});
};
//get date
function date(){
	var d = new Date();
	var date = '['+d.getFullYear()+'-'
	+('0'+(d.getMonth()+1)).slice(-2)+'-'
	+('0'+d.getDate()).slice(-2)+' '
	+('0'+d.getHours()).slice(-2)+':'
	+('0'+d.getMinutes()).slice(-2)+':'
	+('0'+d.getSeconds()).slice(-2)+']';
	return date;
}
///////////////////////////////////////////////////////////
start();
function start(){
	config.location.lat = store.get('lat');
	config.location.lng = store.get('lng');
	config.radius = store.get('rad');
	config.key = store.get('key');
	console.log('---------------------------------------------------------------------------------------------------');
	console.log('Config:','location',config.location.lat,config.location.lng,'radius',config.radius,'key',config.key);
	console.log('Type "p" to pause');
	console.log('Type "r" to resume');
	console.log('Type "set lat|lng|rad|key" to set config');
	console.log('Type "set default" to set config to default');
	console.log('Type "y" to start Server');
	console.log('Type "auto" to Auto Run');
	rl.question('=>>', (input) => {
		switch(`${input}`){
			case 'p':
				console.log('Pause');
				rl.pause;
				break
			case 'r':
				console.log('Resume');
				rl.resume;
				break;
			case 'set lat':
				set('lat');
				break;
			case 'set lng':
				set('lng');
				break;
			case 'set rad':
				set('rad');
				break;
			case 'set key':
				set('key');
				break;
			case 'set default':
				store.put('lat',21.97690);
				store.put('lng',120.3964);
				store.put('rad',2000);
				store.put('key','AIzaSyDDhjNzjNq5S_wfT6FkGqhfqyThsXCrGKA');
				start();
				break;
			case 'y':
				console.log('Start server');
				main();
				break;
			case 'auto':
				auto_rand();
				break;
			default:
				start();
				break;
		}
	});
}
function main(){
	console.log(date()+'location: ',config.location.lat,',',config.location.lng)
	finished_result=0;
	repeated_result=0;
	failed_result=0;
	req('https://maps.googleapis.com/maps/api/place/radarsearch/json?\
location='+config.location.lat+','+config.location.lng+'\
&radius='+config.radius+'\
&types='+config.types+'\
&key='+config.key,
		{
			method:"GET",
		}, function (error, response, body) {
			if(error) {
				console.log('error',error);
				start();
			} else {
				var result = JSON.parse(body).results;
				total_result = result.length;
				console.log('Results Find: ',result.length);
				for (var i = 0; i <result.length; i++)
					check_place(result[i].place_id);
				if(total_result==0)
					console.log(body);
				if(detect_finish()) return;
			}
	});
}
function check_place(place_id){
	req('https://www.charlie27.me/~xu3u4tp6/GoogleApiAuto/add_DB.php',{
		method:"POST",
		form:{
			way:'place_id_check',
			place_id:place_id,
		}
	}, function (error, response, body) {
		var o = JSON.parse(body);
		if(o.message=='repeat'){
			console.log(date(),'id: ',place_id,'Repeat')
			repeated_result++;
		}
		else if(o.message=='new'){
			console.log(date(),'id: ',place_id,'Query')
			details(place_id);
		}
		else{
			console.log(date(),'DB connect failed');
			failed_result++;
		}
		if(detect_finish()) return;
	});
}
	function details(place_id){
		locations.details({placeid:place_id}, function(err, response) {
			if(response===undefined){
				console.log(date(),'Detail search id:',place_id,'Failed');
				failed_result++;
				detect_finish();
			}
			else{
				var result = response.result;
				var image='';
				if(result!==undefined){
					if(result.photos!==undefined)
						image = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference="+result.photos[0].photo_reference+"&key="+config.key;
						
					var location = {
						lat:result.geometry.location.lat,
						lng:result.geometry.location.lng,
					}
				
				//console.log(result);

				//console.log(result.website,image,result.geometry.location);
				//POST to DB
					req('https://www.charlie27.me/~xu3u4tp6/GoogleApiAuto/add_DB.php',{
						method:"POST",
						form:{
							way:'add_new_store',
							name:result.name,
							phone:result.formatted_phone_number,
							address:result.formatted_address,
							url:result.website,
							image:image,
							location:JSON.stringify(location),
							place_id:place_id
						}
					}, function (error, response, body) {
						var obj = JSON.parse(body);
						//console.log(body);
						if(obj.message=='Add'){
							console.log(date(),"Result=> id:",place_id,"/ Name:",result.name,"/ location:",result.formatted_address);			
							finished_result++;
						}
						else
							console.log(date(),error,body);
						if(detect_finish()) return;
					});	
				}
				else{
					if(response.error_message!==undefined)
						console.log(date(),response.error_message,'id:',place_id);
					failed_result++;
					detect_finish();
				}
			}
		});
		
	}
function set(target){
	rl.question(target+' = ', (answer) => {
		store.put(target,`${answer}`);
		start();
	});
}
function auto_rand(){
	var x = store.get('lat');
	var y = store.get('lng');
	var xt = Math.random()*1.64755*2;
	var yt = Math.random()*0.97508*2;
	config.location.lat = Number(x)+xt;
	config.location.lng = Number(y)+yt;
	main();
	setTimeout(auto_rand, 3000);
}
function detect_finish(){
	if(finished_result+repeated_result+failed_result==total_result){
		console.log('Successful Update query: ',finished_result,'Reapted query: ',repeated_result,'Failed query: ',failed_result);
		console.log('---------------------------------------------------------------------------------------------------');
		return true;
	}
	return false;
}
