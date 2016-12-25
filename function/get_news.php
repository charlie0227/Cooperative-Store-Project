<?
require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`news` ORDER BY `id` DESC LIMIT ?,?";
$sth = $db->prepare($sql);
$sth->bindValue(1, (int) $_POST['first'],PDO::PARAM_INT); 
$sth->bindValue(2, (int) $_POST['num'],PDO::PARAM_INT); 
$sth->execute();
$result = $sth->fetchAll();
if($result){
	if(isset($_SESSION['id']) && ($_SESSION['id']==22||$_SESSION['id']==23||$_SESSION['id']==24)){
		array_push($result, array('admin' => true));
	}
	else{
		array_push($result, array('admin' => false));
	}
	echo json_encode($result);
}


?>
