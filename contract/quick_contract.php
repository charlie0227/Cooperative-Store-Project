<?

require_once "../sysconfig.php";
$sql = "SELECT * FROM `jangsc27_cs_project`.`store` ";
$sth = $db->prepare($sql);
$sth->execute();
$storelist=json_encode($sth->fetchall());
echo $storelist;
?>
<input id="quick_store" >
<input id="quick_company" >
<input id="quick_discount" >
<input type="button" onclick="quick_contract_submit()">
static_num
store_id
company_id
</html>