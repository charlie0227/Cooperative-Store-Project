<html>
<body>
<input type="text" id="imagename" value="" />
<input type="button" id="btn" value="GO" />

</body>
<script>
 document.getElementById('btn').onclick = function() {
	var val = document.getElementById('imagename').value,
		src = val,
		img = document.createElement('img');

	img.src = src;
	document.body.appendChild(img);
}
</script>
</html>