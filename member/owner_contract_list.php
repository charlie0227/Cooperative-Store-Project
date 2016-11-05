<?php
require_once "../sysconfig.php";
$member_id=$_SESSION['id'];
$sql = "SELECT  d.id as company_id , d.name as company_name , e.id as store_id , e.name as store_name , a.status as status
	FROM `jangsc27_cs_project`.`contract` a
	JOIN `jangsc27_cs_project`.`member_company` b
	JOIN `jangsc27_cs_project`.`member_store` c
	JOIN `jangsc27_cs_project`.`company` d
	JOIN `jangsc27_cs_project`.`store` e
	ON  a.company_id=b.company_id
	AND a.store_id=c.store_id 
	AND b.company_id=d.id 
	AND c.store_id=e.id 
	AND (b.member_id = ? OR c.member_id = ?)";
$sth = $db->prepare($sql);
$sth->execute(array($member_id,$member_id));
while($result=$sth->fetchObject()){
	?>
	<p>
		<span onclick="store_list();view_store(<?echo $result->store_id?>,'store_map')"><?echo $result->store_name?></span> <--> <span onclick="company_list();view_company(<?echo $result->company_id?>)"><?echo $result->company_name?>
		</span>
		<span>
		<?if($result->status==0){?>
		<input type="button" onclick="view_contract()" value="等待企業簽署">
	   <?}if($result->status==1){?>
	   <input type="button" onclick="view_contract()" value="等待商家確認">
	   <?}if($result->status==2){?>
	   <input type="button" onclick="view_contract()" value="查看合約">
	   <?}?>
		</span>
	</p>
	
	<?
}
echo '<input type="button" value="返回" onclick="my_store_company_list()">';
?>