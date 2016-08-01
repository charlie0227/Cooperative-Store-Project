// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      FB_login();
	  alert('1');
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

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1135310903195562',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });
  


  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d){
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        ref.parentNode.insertBefore(js, ref);
        }(document));
  


  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  //check account is registered
  function FB_login() {
    FB.api('/me', { locale: 'en_US', fields: 'name, email' },function(response) {
	  $.post("check_login.php",
		{
		  datatype:'json',
		  username:response.id, //account
		  password:'facebook'
		},
		function(data){
		var obj=JSON.parse(data);
			alert(obj.message);
			if(obj.message==='Wrong Account or password !!'){//this mean fb isn't register
				FB_register();
			}
			else{
				;
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
	  $.post("register_account.php",
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
			;
		}
		);
      });
  }

function fblogout() {
	alert('fuck');
        FB.logout(function (response) {
            //Do what ever you want here when logged out like reloading the page
			alert('logout');
            window.location.reload();
        });
}
