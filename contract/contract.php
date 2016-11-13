<?php
require_once "../sysconfig.php";
$data=new stdClass();
$flag='';
$who		 =	isset($_POST['who'])		?$_POST['who']:"";
$store_id    =	isset($_POST['store_id'])	?$_POST['store_id']:"";
$company_id  =	isset($_POST['company_id']) ?$_POST['company_id']:"";
$contract_id =	isset($_POST['contract_id'])?$_POST['contract_id']:"";
if(isset($_POST['contract_id'])){
	$sql = "SELECT *,b.name as store_name,c.name as company_name 
	FROM `jangsc27_cs_project`.`contract` a 
	JOIN  `jangsc27_cs_project`.`store` b 
	JOIN  `jangsc27_cs_project`.`company` c 
	ON a.`store_id` = b.`id`
	AND a.`company_id` = c.`id`
	AND a.`id` = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($contract_id));
	$result_contract = $sth->fetchObject();
	
	$data->status = $result_contract->status;
	$data->date_sta = $result_contract->date_sta;
	$data->date_end = $result_contract->date_end;
	$data->date_sign= $result_contract->date_sign;
	$content=json_decode($result_contract->content);
	$data->content = $content;
	
	$data->company_id	 = $result_contract->company_id;
	$data->company_name  = $result_contract->company_name;
	$data->company_owner = $result_contract->company_owner;
	$data->company_name  = $result_contract->company_name;
	$data->company_phone = $result_contract->company_phone;
	$data->company_address=$result_contract->company_address;
	
	$data->store_id	 	 = $result_contract->store_id;
	$data->store_name    = $result_contract->store_name;
	$data->store_owner   = $result_contract->store_owner;
	$data->store_name    = $result_contract->store_name;
	$data->store_phone   = $result_contract->store_phone;
	$data->store_address = $result_contract->store_address;
	if($who=='company' && $data->status==0 || $who=='store' && $data->status==1)
		$flag='view';
}
if(isset($_POST['company_id'])){
	$sql = "SELECT b.name as company_owner, c.name as company_name, c.phone as company_phone, c.address as company_address
	FROM `jangsc27_cs_project`.`member_company` a 
	JOIN  `jangsc27_cs_project`.`member` b 
	JOIN  `jangsc27_cs_project`.`company` c 
	ON a.`member_id`=b.`id` 
	AND a.`company_id`=c.`id`
	AND a.`company_id`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($company_id));
	$result_company = $sth->fetchObject();
	$data->company_owner=$_SESSION['name'];
	$data->company_name=$result_company->company_name;
	$data->company_phone=$result_company->company_phone;
	$data->company_address=$result_company->company_address;
	$flag='';

}
if(isset($_POST['store_id'])){
	$sql = "SELECT b.name as store_owner, c.name as store_name, c.phone as store_phone, c.address as store_address
	FROM `jangsc27_cs_project`.`member_store` a 
	JOIN  `jangsc27_cs_project`.`member` b 
	JOIN  `jangsc27_cs_project`.`store` c 
	ON a.`member_id`=b.`id` 
	AND a.`store_id`=c.`id`
	AND a.`store_id`=?";
	$sth = $db->prepare($sql);
	$sth->execute(array($store_id));
	$result_store = $sth->fetchObject();
	$data->store_owner=$_SESSION['name'];
	$data->store_name=$result_store->store_name;
	$data->store_phone=$result_store->store_phone;
	$data->store_address=$result_store->store_address;
	$flag='';
}
$data->who=$who;


if($who=='store'){
	$data->contract='<div style="height:200px;">
						<div class="tabstrip">
							<ul>
								<li class="k-state-active">
									固定折扣
								</li>
								<li>				
									變動折扣
								</li>
							</ul>
							<div>
								<div class="static_discount">
									<input type="radio" name="sta_dis" id="dis_1" class="k-radio" value="95"/>
									<label class="k-radio-label" for="dis_1">95折</label></br>
									<input type="radio" name="sta_dis" id="dis_2" class="k-radio" value="90"/>
									<label class="k-radio-label" for="dis_2">9折</label></br>
									<input type="radio" name="sta_dis" id="dis_3" class="k-radio" value="85"/>
									<label class="k-radio-label" for="dis_3">85折</label></br>
									<input type="radio" name="sta_dis" id="dis_4" class="k-radio" value="80"/>	
									<label class="k-radio-label" for="dis_4">8折</label></br>
									<input type="radio" name="sta_dis" id="dis_5" class="k-radio"/>		
									<label class="k-radio-label" for="dis_5">
									<input type="text" id="dis_5_num" style="width:20px">折<span></span></label>
								</div>
							</div>
							<div>
								<div class="dynamic_discount" style="line-height:1px;display:-webkit-inline-box;">
									<div style="width:180px">
										<p>基本折扣</p>
										<input type="radio" name="dyn_big" id="big_1" class="k-radio" value="95"/>
										<label class="k-radio-label" for="big_1">95折</label></br>
										<input type="radio" name="dyn_big" id="big_2" class="k-radio" value="90"/>
										<label class="k-radio-label" for="big_2"> 9折</label></br>
										<input type="radio" name="dyn_big" id="big_3" class="k-radio" value="85"/>
										<label class="k-radio-label" for="big_3">85折</label></br>
										<input type="radio" name="dyn_big" id="big_4" class="k-radio"/>
										<label class="k-radio-label" for="big_4">
										<input type="text" id="big_4_num" style="width:20px">折<span></span></label>
									</div>
									<div style="width:280px">
										<input type="radio" name="dyn_people" id="people_1" class="k-radio" value="10"/>
										<label class="k-radio-label" for="people_1">每10人再折扣1%</label></br>
										<input type="radio" name="dyn_people" id="people_2" class="k-radio" value="20"/>
										<label class="k-radio-label" for="people_2">每20人再折扣1%</label></br>
										<input type="radio" name="dyn_people" id="people_3" class="k-radio" value="50"/>
										<label class="k-radio-label" for="people_3">每50人再折扣1%</label></br>
										<input type="radio" name="dyn_people" id="people_4" class="k-radio" value="100"/>	
										<label class="k-radio-label" for="people_4">每100人再折扣1%</label></br>
										<input type="radio" name="dyn_people" id="people_5" class="k-radio"/>		
										<label class="k-radio-label" for="people_5">每<input type="text" id="people_5_num" style="width:30px">人再折扣1%<span></span></label>
									</div>
									<div style="width:150px">
										<p>最低折扣</p>
										<input type="radio" name="dyn_small" id="small_1" class="k-radio" value="90"/>
										<label class="k-radio-label" for="small_1">9折</label></br>
										<input type="radio" name="dyn_small" id="small_2" class="k-radio" value="85"/>
										<label class="k-radio-label" for="small_2">85折</label></br>
										<input type="radio" name="dyn_small" id="small_3" class="k-radio" value="80"/>
										<label class="k-radio-label" for="small_3">8折</label></br>
										<input type="radio" name="dyn_small" id="small_4" class="k-radio"/>		
										<label class="k-radio-label" for="small_4"><input type="text" id="small_4_num" style="width:20px">折<span></span></label>
									</div>
									<div style="width:150px">
										<p>計算時間</p>
										<input type="radio" name="dyn_time" id="time_1" class="k-radio" selected="selected"/>
										<label class="k-radio-label" for="time_1">直到合約結束</label></br>
										<input type="radio" name="dyn_time" id="time_2" class="k-radio"/>
										<label class="k-radio-label" for="time_2">每年重新計算</label></br>
										<input type="radio" name="dyn_time" id="time_3" class="k-radio"/>
										<label class="k-radio-label" for="time_3">半年重新計算</label></br>
										<input type="radio" name="dyn_time" id="time_4" class="k-radio"/>
										<label class="k-radio-label" for="time_4">每月重新計算</label></br>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="auto_calculate" style="height:180px;width=:100%;display:-webkit-box;"> 
						<div style="width:50%;line-height:40px;" id="contract_content"></div>
						<div style="width:50%" id="show_discount"></div>
					</div>
					<p>備註</p>
					<textarea id="contract_remark" class="k-textbox" style="width: 600px;height:120px;"></textarea>
					';
}
if($who=='company'){
	$data->contract='<p>優惠方式由店家決定</p>
					 <p>可填入預期的優惠或想對店家說的話</p>
					 <textarea id="contract_remark" class="k-textbox" style="width: 600px;height:120px;"></textarea>
	';
	
}
if($who=='view' || $flag=='view'){
	$data->contract='<div class="auto_calculate" style="height:180px;width=:100%;display:-webkit-box;color:blue;border-style:dashed;"> 
						<div style="width:50%;line-height:40px;" id="contract_content"></div>
						<div style="width:50%" id="show_discount"></div>
					</div>
					<p>備註</p>
					<p id="contract_remark" style="width: 100%;height:100%;color:blue;display:inline-block;"></p>';
}
	
echo json_encode($data);
?>
