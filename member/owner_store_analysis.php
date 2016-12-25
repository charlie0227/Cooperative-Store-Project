<html>
	<!--性別 年齡層 
	<input type="button" onclick="" value="成長曲線">
	<input type="button" onclick="" value="使用人數">
	<input type="button" onclick="" value="成長曲線">-->
	
	<div class="ana_radio">
		<input type="radio" name="analysis" id="ana_y" class="k-radio"/>
		<label class="k-radio-label" for="ana_y">年</label>
		<input type="radio" name="analysis" id="ana_m" class="k-radio"/>
		<label class="k-radio-label" for="ana_m">月</label>
		<input type="radio" name="analysis" id="ana_d" class="k-radio"/>
		<label class="k-radio-label" for="ana_d">日</label>
	</div>
	
	<div class="ana_select">
		<input id="ana_l" class="k-button" type="button" value="<">
		<input id="ana_n" class="k-text" type="button">
		<input id="ana_r" class="k-button" type="button" value=">">
	</div>
	<div id="example">
    <div class="demo-section k-content wide">
        <div id="chart"></div>
    </div>
	<input type="button" onclick="show_own_store_content(<?echo $_GET['store_id']?>,'owner_map')" value="返回">
</div>
<html>
