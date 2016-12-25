<?php
require_once "../sysconfig.php";
$member_id=$_SESSION['id'];
$sql = "SELECT  a.id as contract_id , b.member_id as company_owner_id , c.member_id as store_owner_id , d.id as company_id , d.name as company_name , e.id as store_id , e.name as store_name , a.status as status
	FROM `jangsc27_cs_project`.`contract` a
	JOIN `jangsc27_cs_project`.`member_company` b
	JOIN `jangsc27_cs_project`.`member_store` c
	JOIN `jangsc27_cs_project`.`company` d
	JOIN `jangsc27_cs_project`.`store` e
	ON  a.company_id=d.id
	AND a.store_id=e.id 
	AND b.company_id=d.id 
	AND c.store_id=e.id 
	AND (b.member_id = ? OR c.member_id = ?)";
$sth = $db->prepare($sql);
$sth->execute(array($member_id,$member_id));
echo '<table style="text-align: center;">
		<th>商家名稱</th>
		<th></th>
		<th>企業名稱</th>
		<th>狀態</th>
		<th>功能</th>
';

while($result=$sth->fetchObject()){
	if($member_id==$result->company_owner_id)
		$whoami="company";
	if($member_id==$result->store_owner_id)
		$whoami="store";
	?>
	<tr>
		<td><input style="width: 100%;height: 100%;"type="button" onclick="store_list();view_store(<?echo $result->store_id?>,'store_map')" value="<?echo $result->store_name?>"></td>
		<td><img src="images/icon_046010_256.png" style="width: 50px;height: 50px;    vertical-align: inherit;"></td>
		<td><input  style="width: 100%;height: 100%;"type="button" onclick="company_list();view_company(<?echo $result->company_id?>)" value="<?echo $result->company_name?>"></td>

		<?if($result->status==0 && $whoami=="store"){?>
		<td>等待企業簽署</td>
		<td><input type="button" onclick="view_contract(<?echo $result->contract_id?>)" value="預覽">
		<input type="button" onclick="contract_manage(<?echo $result->contract_id?>,'<?echo $whoami?>')" value="修改"></td>
	   <?}if($result->status==0 && $whoami=="company"){?>
		<td>等待企業簽署</td>
		<td><input type="button" onclick="contract_manage(<?echo $result->contract_id?>,'<?echo $whoami?>')" value="前往簽署"></td>
	   <?}if($result->status==1 && $whoami=="store"){?>
		<td>等待商家確認</td>
		<td><input type="button" onclick="contract_manage(<?echo $result->contract_id?>,'<?echo $whoami?>')" value="前往確認"></td>
		<?}if($result->status==1 && $whoami=="company"){?>
		<td>等待商家確認</td>
		<td><input type="button" onclick="view_contract(<?echo $result->contract_id?>)" value="預覽"></td>
	   <?}if($result->status==2){?>
	   <td><input type="button" onclick="view_contract(<?echo $result->contract_id?>)" value="查看合約"></td><td></td><td></td>
	   <?}?>
	</tr>
	
	<?
}
echo '</table>
<input type="hidden" id="back_history" value="show_contract">
<input type="button" value="返回" onclick="my_store_company_list()">';
?>