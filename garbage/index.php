<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Search API Sample</title>
    <script src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
if (window.navigator.geolocation==undefined) {
    alert("此瀏覽器不支援地理定位功能!");
    }
else {
    var geolocation=window.navigator.geolocation; //取得 Geolocation 物件
    //地理定位程式碼
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
      alert(position.coords.latitude+"~~~~"+position.coords.longitude);
      }
	  
	  function errorCallback(error) {
      var errorTypes={
            0:"不明原因錯誤",
            1:"使用者拒絕提供位置資訊",
            2:"無法取得位置資訊",
            3:"位置查詢逾時"
            };
      alert(errorTypes[error.code]);
      //alert(error.message);  //測試時用
      }
     </script>

  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="branding"  style="float: left;"></div><br />
    <div id="content">Loading...</div>
  </body>
</html>