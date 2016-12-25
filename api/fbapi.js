// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      FB_login();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
	  alert('2');
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      alert('3');
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

window.fbAsyncInit = function(){
	FB.init({
      appId      : '1135310903195562',
      xfbml      : true,
	  status     : true, 
	  channelUrl : 'index.php',
      cookie     : true,
	  oauth      : true,
      version    : 'v2.7'
    });
	
	(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
}

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  //check account is registered
  function FB_login() {
    FB.api('/me', { locale: 'en_US', fields: 'name, email' },function(response) {
	  $.post("function/check_login.php",
		{
		  datatype:'json',
		  username:response.id, //account
		  password:'facebook'
		},
		function(data){
		var obj=JSON.parse(data);
			if(obj.message==='Wrong Account or password !!'){//this mean fb isn't register
				FB_register();
			}
			else{
				window.location.reload();
			}
		}
		);
     });
  }
  
  //register
  function FB_register() {
    FB.api('/me', { locale: 'en_US', fields: 'name, email , age_range,gender' },function(response) {
	  var a = 2016-parseInt(response.age_range.min);
	  var b = 'male' == response.gender ? 1 : 0 ;
	  $.post("function/register_account.php",
		{
		  datatype:'json',
		  account:response.id,
		  password:'facebook',
		  name:response.name,
		  phone:response.id,
		  gender:b,
		  year:a,
		  month:'01',
		  date:'01',
		  email:response.email
		},
		function(){
			window.location.reload();
		}
		);
      });
  }
  

function fblogout() {
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
		  FB.logout(function (response) {
            //Do what ever you want here when logged out like reloading the page
            window.location.reload();
        });
		}
    });
	
	
        
}

function fblogin(){
	FB.login(function(response) {
		if (response.authResponse) {
			FB_login();
		} else {
		 console.log('User cancelled login or did not fully authorize.');
		}
	});
}


