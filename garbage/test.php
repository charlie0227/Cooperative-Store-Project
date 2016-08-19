<?
require_once "../sysconfig.php";
$sql = "SELECT 0 as type,id ,name , address 
FROM `jangsc27_cs_project`.`store`  
UNION 
SELECT 1 as type,id ,name , address 
FROM `jangsc27_cs_project`.`company`";
$sth = $db->prepare($sql);
$sth->execute();

$arr=&$sth->fetchAll();
foreach($arr as $word)
    {
       
         $results[] = $word;
        
    }
	 
echo json_encode($results);
?>