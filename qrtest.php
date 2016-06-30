<!DOCTYPE HTML>

<script type="text/javascript">
	function QRCode(content, width, height){
		// 預設寬高為 120x120
		width = !!width ? width : 120 ;
		height = !!height ? height : 120;
		// 編碼
		content = encodeURIComponent(content);
		return 'http://chart.apis.google.com/chart?cht=qr&chl=' + content + '&chs=' + width + 'x' + height;
	}
 
	window.onload = function(){
		document.getElementById('qrcode').onclick = function(){
			var msg = document.getElementById('content');
			var imgSrc = QRCode(msg.innerHTML, 240, 240);
			msg.innerHTML = '<img src="' + imgSrc + '" alt="" />';
		};
	};
</script>
 
<body>
	<input type="button" value="QRCode" id="qrcode" />
	<div id="content">
		https://www.google.com.tw/
	</div>
</body>
