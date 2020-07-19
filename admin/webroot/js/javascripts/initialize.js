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

function organizationTable(selector, text) {
	$(selector).DataTable({
		pageLength: 25,
		bPaginate: true,
		info: true,
		ordering: false,
		responsive: true,
		searching: true,
		dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
			text: text,
			action: function (e, dt, node, config) {
				alert( 'Button activated' );
			}
		}]
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
