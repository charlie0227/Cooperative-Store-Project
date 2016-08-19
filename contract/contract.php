<?php
require_once "../sysconfig.php";

$who=$_POST['who'];
$store_id=$_POST['store_id'];
$company_id=$_POST['company_id'];

$sql = "SELECT * FROM `jangsc27_cs_project`.`member_company` a JOIN  `jangsc27_cs_project`.`member` b ON a.`member_id`=b.`id` AND a.`company_id`=?";
$sth = $db->prepare($sql);
$sth->execute(array($company_id));
$result_company = $sth->fetchObject();

$sql = "SELECT * FROM `jangsc27_cs_project`.`member_store` a JOIN  `jangsc27_cs_project`.`member` b ON a.`member_id`=b.`id` AND a.`store_id`=?";
$sth = $db->prepare($sql);
$sth->execute(array($store_id));
$result_store = $sth->fetchObject();


?>
<head>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://kendo.cdn.telerik.com/2016.2.714/js/kendo.all.min.js"></script>
<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.common.min.css"/>
<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.rtl.min.css"/>
<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.silver.min.css"/>
<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2016.2.714/styles/kendo.mobile.all.min.css"/>
<script src="contract.js"></script>
</head>
<div style="border-style:outset;">
<p>特約商店合約書</p>
<span id="store_name" style="color:red"><?echo $result_store->name?></span>（以下簡稱甲方），同意成為<span id="company_name" style="color:red"><?echo $result_company->name?></span>（以下簡稱乙方）之特約商店，雙方同意如下：<br>
一、凡乙方員工，憑員工服務證或退休證向甲方消費，均享有以下優惠，優惠內容如下：<br>
二、有效日期：本合約自<input id="start" style="width:200px"/>起至<input id="end" style="width:200px"/>止，如雙方欲中止本合約，應以書面於1個月前通知對方。<br>
三、甲乙雙方本誠信互惠原則，訂定本合約，於合約有效期限內，如欲取消或更改合約辦法，應經雙方協商同意。<br>
四、乙方應於合約生效時，提供乙方所發之員工識別證樣本給甲方，以便甲方識別之。<br>
五、乙方員工消費購物或申請入會時，若未帶員工識別證，不能享有本合約雙方同意之優待辦法。<br>
六、本合約壹式貳份，雙方各執壹份。<br>
立合約書人<br>
甲方：<span id="store_name"><?echo $result_store->name?></span><br>
代表人：<span id="store_owner"></span><br>
地　址：<span id="store_address"></span><br>
電　話：<span id="store_phone"></span><br>
<br>
乙方：<span id="company_name"><?echo $result_company->name?></span><br>
聯絡人：<span id="compnay_owner"></span><br>
地　址：<span id="company_address"></span><br>
電　話：<span id="company_phone"></span><br>
<br>
中華民國　 <span id="now_date"></span><br>
</div>
