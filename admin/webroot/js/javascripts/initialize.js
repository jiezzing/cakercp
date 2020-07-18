function chosenSelect(selector) {
	$(selector).chosen({
		width: "100%",
		theme: "bootstrap4",
		placeholder: "Select a state",
		allowClear: true
	});
}

function jsSwitch(selector, hexColor) {
	var elem_2 = document.querySelector(selector);
	new Switchery(elem_2, {
		color: hexColor
	});
}

function dataTable(selector, buttons) {
	$(selector).DataTable({
		pageLength: 25,
		bPaginate: false,
		info: false,
		ordering: false,
		responsive: true,
		searching: false,
		dom: 'Bfrtip',
        buttons: [buttons]
    });
}

function datePicker(selector) {
	var mem = $(selector).datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true
	});
}
