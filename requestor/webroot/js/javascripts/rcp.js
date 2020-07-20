function getRcpNo(id, url) {
	var rcpNo = null;
	$.ajax({
		type: 'POST',
		url: url,
		async: false,
		cache: false,
		data: {
			id: id
		},
		dataType: 'json',
		success: function(response) {
			rcpNo = response.rcp_no;
		},
		error: function (response, desc, exception) {
			alert(exception);
		}
	})

	return rcpNo;
}
