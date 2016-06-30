<?php
require_once "sysconfig.php";
$s_name=$_POST['name'];
$s_phone=$_POST['phone'];
$s_address=$_POST['address'];
$s_content=$_POST['content'];
//$data = new stdClass();
function find_store_id($db,$name,$phone,$address,$content){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `name`=? and `phone`=? and `address`=? and `content`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$content));
	return $sth->fetchObject()->id;
}
/*if ($_FILES["files"]["error"] > 0)
  {
  echo "Error: " . $_FILES["files"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["files"]["name"] . "<br />";
  echo "Type: " . $_FILES["files"]["type"] . "<br />";
  echo "Size: " . ($_FILES["files"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["files"]["tmp_name"];
  }*/

if($s_name){
	//create new store
	$sql = "INSERT INTO `jangsc27_cs_project`.`store` (name,phone,address,content) VALUES(?,?,?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($s_name,$s_phone,$s_address,$s_content));
}
//add image 
if($_FILES['files']['name']!=NULL){
	$size = getimagesize($_FILES['files']['tmp_name']);
    $type = $size['mime'];
    $size = $size[3];
    $name = $_FILES['files']['name'];
	$imgfp = base64_encode(file_get_contents($_FILES['files']['tmp_name']));
	$store_id=find_store_id($db,$s_name,$s_phone,$s_address,$s_content/**/);
	
    $sql = "INSERT INTO `jangsc27_cs_project`.`image` (image_type,image,image_size,image_name,store_id) VALUES(?,?,?,?,?)";
	$sth = $db->prepare($sql);
	
    $sth->bindParam(1, $type);
	$sth->bindParam(2, $imgfp, PDO::PARAM_LOB);
	$sth->bindParam(3, $size);
	$sth->bindParam(4, $name);
	$sth->bindParam(5, $store_id);
	
	$sth->execute(array($type,$imgfp,$size,$name,$store_id));
	}
else{
	$size = 'width="241" height="209"';
    $type = 'image/jpeg';
    $name = 'images.jpg';
	$imgfp = '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';
	$store_id=find_store_id($db,$s_name,$s_phone,$s_address,$s_content/**/);
	
	$sql = "INSERT INTO `jangsc27_cs_project`.`image` (image_type,image,image_size,image_name,store_id) VALUES(?,?,?,?,?)";
	$sth = $db->prepare($sql);
	
	$sth->bindParam(1, $type);
	$sth->bindParam(2, $imgfp, PDO::PARAM_LOB);
	$sth->bindParam(3, $size);
	$sth->bindParam(4, $name);
	$sth->bindParam(5, $store_id);
	
	$sth->execute(array($type,$imgfp,$size,$name,$store_id));
}
//$data->store_id=$store_id;
//echo json_encode($data);
echo $store_id;
//header('Location:store.php?store_id='.$store_id);

?>