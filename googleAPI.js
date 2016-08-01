var map = null;
var geocoder = null;
var marker;

function initialize() 
{
	if (GBrowserIsCompatible()) 
	{
		map = new GMap2(document.getElementById("map"));
		map.addControl(new GLargeMapControl());	                //加入地圖縮放工具
		map.addControl(new GMapTypeControl());	                //加入地圖切換的工具
		map.addMapType(G_PHYSICAL_MAP);                         //加入地形圖
		map.setCenter(new GLatLng(25.001689, 121.460809), 8);   //設定台灣為中心點
		geocoder = new GClientGeocoder();
	}
}

function createMarker(point,title,html) 
{
	var marker = new GMarker(point);

	GEvent.addListener(marker, "click", function() 
	{
		marker.openInfoWindowHtml(
			html,
			{
				maxContent: html,
				maxTitle: title}
			);
	});
	return marker;
}

function showAddress(address){
	if (geocoder){
		geocoder.getLatLng(
			address,
			function(point){
				if (!point) 
				{
					;//alert(address + " not found");
				} 
				else 
				{
					if(marker)  //移除上一個點
					{
						map.removeOverlay(marker);
					}
					
					map.setCenter(point, 17);
					
					var title = "地址";
					
					marker = createMarker(point,title,address);

					map.addOverlay(marker);

					marker.openInfoWindowHtml(
						address,
						{
							maxContent: address,
							maxTitle: title}
						);
				}
			}
		);
	}
}