<p>選取店家</p>
<input id="quick_store" name="quick_store" style="width:600px">
<div class="quick_block" id="quick_select_store"></div>
<p>選取企業</p>
<input id="quick_company" name="quick_company" style="width:600px" >
<div class="quick_block" id="quick_select_company"></div>
<div class="quick_discount">
	<input type="radio" name="sta_dis" id="dis_1" class="k-radio" value="95"/>
	<label class="k-radio-label" for="dis_1">95折</label>
	<input type="radio" name="sta_dis" id="dis_2" class="k-radio" value="90"/>
	<label class="k-radio-label" for="dis_2">9折</label>
	<input type="radio" name="sta_dis" id="dis_3" class="k-radio" value="85"/>
	<label class="k-radio-label" for="dis_3">85折</label>
	<input type="radio" name="sta_dis" id="dis_4" class="k-radio" value="80"/>	
	<label class="k-radio-label" for="dis_4">8折</label>
	<input type="radio" name="sta_dis" id="dis_5" class="k-radio"/>		
	<label class="k-radio-label" for="dis_5">
	<input type="text" id="dis_5_num" style="width:20px">折<span></span></label>
</div>
<input type="button" onclick="quick_contract_submit()" value="送出">
</html>