<?php
require_once "sysconfig.php";
$s_name=$_POST['name'];
$s_phone=$_POST['phone'];
$s_address=$_POST['address'];
$s_content=$_POST['content'];
$data = new stdClass();
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

if(isset($_POST['name'])){
	//check repeat
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `name`=? and `phone`=? and `address`=? and `content`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$content));
	if(!$sth->fetchObject()){
		//edit store
		$sql = "UPDATE `jangsc27_cs_project`.`store` SET `name` = ?,`phone` = ?,`address` = ?, `content` = ? WHERE `store`.`id` =?";
		$sth = $db->prepare($sql);
		$sth->execute(array($s_name,$s_phone,$s_address,$s_content,$_POST['edit_id']));
	}
}
//edit image 
if(isset($_FILES['files'])){
	$size = getimagesize($_FILES['files']['tmp_name']);
    $type = $size['mime'];
    $size = $size[3];
    $name = $_FILES['files']['name'];
	$imgfp = base64_encode(file_get_contents($_FILES['files']['tmp_name']));
	$store_id=find_store_id($db,$s_name,$s_phone,$s_address,$s_content/**/);
	
    $sql = "UPDATE `jangsc27_cs_project`.`image` SET `image_type` = ?,`image` = ?,`image_size` = ?,`image_name` = ? WHERE `store_id` =?";
	$sth = $db->prepare($sql);
	
    $sth->bindParam(1, $type);
	$sth->bindParam(2, $imgfp, PDO::PARAM_LOB);
	$sth->bindParam(3, $size);
	$sth->bindParam(4, $name);
	//$sth->bindParam(5, $store_id);
	
	$sth->execute(array($type,$imgfp,$size,$name,$_POST['edit_id']));
	//echo $type.$imgfp.$size.$name.'111'.$store_id;
	}

//header('Location:index.php');
function find_store_id($db,$name,$phone,$address,$content/**/){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `name`=? and `phone`=? and `address`=? and `content`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$content));
	//echo '***'.$sth->fetchObject()->id;
	return $sth->fetchObject()->id;
}

$data = $_POST['edit_id'];
echo $data;
?>