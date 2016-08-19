$(document).ready(function() {
	var d = new Date();
	document.getElementById("start").value=d.toLocaleDateString();
	document.getElementById("now_date").value=d.getFullYear()-1911+'¦~'+d.getMonth()+'¤ë'+getDate()+'¤é';
	
	d.setFullYear(d.getFullYear()+1);
	d.setDate(d.getDate()-1);
	document.getElementById("end").value=d.toLocaleDateString();
	
	function startChange() {
		var startDate = start.value(),
		endDate = end.value();

		if (startDate) {
			startDate = new Date(startDate);
			startDate.setDate(startDate.getDate());
			end.min(startDate);
		} else if (endDate) {
			start.max(new Date(endDate));
		} else {
			endDate = new Date();
			start.max(endDate);
			end.min(endDate);
		}
	}

	function endChange() {
		var endDate = end.value(),
		startDate = start.value();

		if (endDate) {
			endDate = new Date(endDate);
			endDate.setDate(endDate.getDate());
			start.max(endDate);
		} else if (startDate) {
			end.min(new Date(startDate));
		} else {
			endDate = new Date();
			start.max(endDate);
			end.min(endDate);
		}
	}

	var start = $("#start").kendoDatePicker({
		change: startChange
	}).data("kendoDatePicker");

	var end = $("#end").kendoDatePicker({
		change: endChange
	}).data("kendoDatePicker");

	start.max(end.value());
	end.min(start.value());
});