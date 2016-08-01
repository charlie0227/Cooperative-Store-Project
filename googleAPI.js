var map = null;
var geocoder = null;
var marker;

function initialize() 
{
	if (GBrowserIsCompatible()) 
	{
		map = new GMap2(document.getElementById("map"));
		map.addControl(new GLargeMapControl());	                //�[�J�a���Y��u��
		map.addControl(new GMapTypeControl());	                //�[�J�a�Ϥ������u��
		map.addMapType(G_PHYSICAL_MAP);                         //�[�J�a�ι�
		map.setCenter(new GLatLng(25.001689, 121.460809), 8);   //�]�w�x�W�������I
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
					if(marker)  //�����W�@���I
					{
						map.removeOverlay(marker);
					}
					
					map.setCenter(point, 17);
					
					var title = "�a�}";
					
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