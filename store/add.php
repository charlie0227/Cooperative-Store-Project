<?php
require_once "../sysconfig.php";
$s_name=$_POST['name'];
$s_phone=$_POST['phone'];
$s_address=$_POST['address'];
$s_content=$_POST['content'];
$data = new stdClass();

function find_store_id($db,$name,$phone,$address,$content){
	$sql = "SELECT * FROM `jangsc27_cs_project`.`store` where `name`=? and `phone`=? and `address`=? and `content`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($name,$phone,$address,$content));
	return $sth->fetchObject()->id;
}
if($s_name){
	//create new store
	$sql = "INSERT INTO `jangsc27_cs_project`.`store` (name,phone,address,content) VALUES(?,?,?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($s_name,$s_phone,$s_address,$s_content));
}
$store_id=find_store_id($db,$s_name,$s_phone,$s_address,$s_content);
if($_FILES["files"]["name"]!=NULL){
	//add image 
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["files"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["files"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$data->error="File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		date_default_timezone_set("Asia/Taipei");
		$target_file=str_replace(".".$imageFileType,"-".date(ymdhis)."-".rand(0,9).".".$imageFileType,$target_file);
		$uploadOk = 1;
	}
	// Check file size
	if ($_FILES["files"]["size"] > 5000000) {
		$data->error=$data->error."Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$data->error=$data->error."Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	//content to DB
	if($uploadOk==1){
		$size = getimagesize($_FILES['files']['tmp_name']);
		$type = $size['mime'];
		$size = $size[3];
		$name = $_FILES['files']['name'];
		$imgfp = $target_file;
		
		
		$sql = "INSERT INTO `jangsc27_cs_project`.`image` (image_type,image,image_size,image_name,store_id) VALUES(?,?,?,?,?)";
		$sth = $db->prepare($sql);
		
		$sth->bindParam(1, $type);
		$sth->bindParam(2, $imgfp);
		$sth->bindParam(3, $size);
		$sth->bindParam(4, $name);
		$sth->bindParam(5, $store_id);
		
		$sth->execute(array($type,$imgfp,$size,$name,$store_id));

	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$data->error=$data->error."Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
			chmod($target_file, 0644); 
			$data->message="The file ". basename( $_FILES["files"]["name"]). " has been uploaded.";
		} else {
			$data->error=$data->error."Sorry, there was an error uploading your file.";
		}
	}
}
$data->p=$store_id;

echo json_encode($data);
//header('Location:index.php');

?>