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

function organizationTable(selector, buttonAction = {}) {
	$(selector).DataTable({
		pageLength: 25,
		bPaginate: true,
		info: true,
		ordering: true,
		responsive: true,
		searching: true,
		dom: '<"html5buttons"B>lTfgitp',
        buttons: [buttonAction]
    });
}

function dataTable(selector, orderBy = []) {
	$(selector).DataTable({
		pageLength: 25,
		bPaginate: true,
		info: true,
		ordering: true,
		responsive: true,
		order: [orderBy],
		searching: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: []
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

function iChecks(selector) {
	$(selector).iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}
