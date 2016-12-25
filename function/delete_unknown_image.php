<?
require_once '../sysconfig.php';
#delete company images
$sql = "SELECT `image_name` FROM `jangsc27_cs_project`.`company_image` ";
$sth = $db->prepare($sql);
$sth->execute();
$files = glob('/net/cs/102/0216207/public_html/uploads/company/*.*'); // get all file names
$exc = array();
while($result = $sth->fetchObject()){
	array_push($exc,$result->image_name);
}
foreach($files as $file){ // iterate files
	if(is_file($file) && !in_array(end(explode("/", $file)), $exc)){
		write_log('Delete Image' ,'company : '.$file.' has been deleted!');
		unlink($file); // delete file
	}
}
#delete store images
$sql = "SELECT `image_name` FROM `jangsc27_cs_project`.`store_image` ";
$sth = $db->prepare($sql);
$sth->execute();
$files = glob('/net/cs/102/0216207/public_html/uploads/store/*.*'); // get all file names
$exc = array();
while($result = $sth->fetchObject()){
	array_push($exc,$result->image_name);
}
foreach($files as $file){ // iterate files
	if(is_file($file) && !in_array(end(explode("/", $file)), $exc)){
		write_log('Delete Image' ,'store : '.$file.' has been deleted!');
		unlink($file); // delete file
	}
}
?>