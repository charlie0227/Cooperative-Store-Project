<?
require_once "../sysconfig.php";
$data = new stdClass();
function distance($lng1,$lat1,$lng2,$lat2){
	//将角度转为狐度
	$radLat1=deg2rad(floatval($lat1));//deg2rad()函数将角度转换为弧度
	$radLat2=deg2rad(floatval($lat2));
	$radLng1=deg2rad(floatval($lng1));
	$radLng2=deg2rad(floatval($lng2));
	$a=$radLat1-$radLat2;
	$b=$radLng1-$radLng2;
	$s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137*1000;
	return round($s,0);
}

$sql = "SELECT * FROM `jangsc27_cs_project`.`store` ";
if($_GET['word']){
	$sql=$sql."WHERE ";
	if($_GET['q']=="name")
		$sql=$sql."`name` LIKE '%".$_GET['word']."%'";
	if($_GET['q']=="phone")
		$sql=$sql."`phone` LIKE '%".$_GET['word']."%'";
	if($_GET['q']=="address")
		$sql=$sql."`address` LIKE '%".$_GET['word']."%'";
}
$sth = $db->prepare($sql);
$sth->execute();
$u_lat = isset($_GET['lat'])?$_GET['lat']:'';
$u_lng = isset($_GET['lng'])?$_GET['lng']:'';
$result=$sth->fetchAll();
for($i=0;$i<count($result);$i++){
	if($result[$i]['location']!=''){
		$r_lat = json_decode($result[$i]['location'])->lat;
		$r_lng = json_decode($result[$i]['location'])->lng;
		$result[$i]['distance']=distance($u_lng,$u_lat,$r_lng,$r_lat);
	}
	else
		$result[$i]['distance']='';
}
usort($result,function($x,$y){
	//descending
	if($x['distance']=='')
		return 1;
	else if($y['distance']=='')
		return -1;
	else
		return $x['distance'] <=> $y['distance'];
});
$data->result = $result;
echo json_encode($data);