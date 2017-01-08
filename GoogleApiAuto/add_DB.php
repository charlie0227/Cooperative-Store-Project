<?php
$db_host = "localhost";
$db_name = "jangsc27_cs_project";
$db_user = "charlie27";
$db_password = "12345678";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db = new PDO($dsn, $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$way=isset($_POST['way'])?$_POST['way']:"";
$place_id=isset($_POST['place_id'])?$_POST['place_id']:"";
$name=isset($_POST['name'])?$_POST['name']:"";
$phone=isset($_POST['phone'])?$_POST['phone']:"";
$address=isset($_POST['address'])?$_POST['address']:"";
$url=isset($_POST['url'])?$_POST['url']:"";
$image=isset($_POST['image'])?$_POST['image']:"";
$location=isset($_POST['location'])?$_POST['location']:"";
$data = new stdClass();
$data->a = $way.$place_id;
if($way=='place_id_check'){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `place_id`= ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($place_id));
	if($sth->fetch())
		$data->message='repeat';
	else
		$data->message='new';
}
function find_store_id($db,$name,$phone,$address,$url){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `name`=? and `phone`=? and `address`=? and `url`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$url));
	if($result=$sth->fetchObject())
	return $result->id;
	else return 0;
}
$data->store_id = find_store_id($db,$name,$phone,$address,$url);
if($way=="add_new_store"&&!$data->store_id){
	//create new store
	$sql = "INSERT INTO `jangsc27_cs_project`.`store` (name,phone,address,url,location,place_id) VALUES(?,?,?,?,?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$url,$location,$place_id));
	$data->message='Add';
	if($image!=''){
		$sql = "SELECT * FROM `jangsc27_cs_project`.`store` WHERE `place_id` = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($place_id));
		$result=$sth->fetchObject();

		$sql_img = "INSERT INTO `jangsc27_cs_project`.`store_image` (store_id,image_url) VALUES(?,?)";
		$sth_img = $db->prepare($sql_img);
		$sth_img->execute(array($result->id,$image));
	}

	$data->store_id = find_store_id($db,$name,$phone,$address,$url);
}

echo json_encode($data);

?>
