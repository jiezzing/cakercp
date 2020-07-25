<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-send"></i>
        </div>
        <div class="skin-settings">
			<div class="title">Request for Check Payment<br>
				<small style="text-transform: none;font-weight: 400">
					Please check thoroughly the details you've entered.
				</small>
			</div>
			<div class="setings-item default-skin">
				<span class="skin-name ">
					<a href="#" class="s-skin-0" id="send_rcp_btn" rcp_url="<?php echo $this->params->base . "/rcp_no" ?>" url="<?php echo $this->params->base . "/send_rcp" ?>">
						SEND RCP
					</a>
				</span>
			</div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function() {
		$('.spin-icon').click(function (){
			$(".theme-config-box").toggleClass("show");
		});

		$('#send_rcp_btn').on('click', function(event) {
			event.preventDefault();

			var checked = $('#expense_type').prop("checked");
			var qtyArr = [];
			var particularsArr = [];
			var unitArr = [];
			var refCodeArr = [];
			var codeArr = [];
			var amountArr = [];
			var hasEmpty = false;

			var data = new FormData();
			var url = $(this).attr('url');
			var rcpUrl = $(this).attr('rcp_url');
			var department = $('#department').val();
			var approver = $('#approver').val();
			var project = $('#project').val();
			var expenseType = $('#expense_title').text();
			var company = $('#company').val();
			var payee = $('#payee').val().trim();
			var amount = $('#amount').text();
			var amountInWords = $('#amount_in_words').val();
			var dueDate = $('#rush_date').val();
			var justification = $('#justification').val().trim();

			$('#rcp_table > tbody > tr').each(function(index, value) {
				var qty = $(this).find("td").eq(0).html();
				var unit = $(this).find("td").eq(1).html();
				var particulars = $(this).find("td").eq(2).html();
				var refCode = $(this).find("td").eq(3).html();


				if (checked) {
					var amount = $(this).find("td").eq(4).html();

					if (qty && unit && particulars && refCode && amount) {
						qtyArr.push(qty);
						unitArr.push(unit);
						particularsArr.push(particulars);
						refCodeArr.push(refCode);
						amountArr.push(amount);
					}
				}
				else {
					var code = $(this).find("td").eq(4).html();
					var amount = $(this).find("td").eq(5).html();

					if (qty && unit && particulars && refCode && code && amount) {
						qtyArr.push(qty);
						unitArr.push(unit);
						particularsArr.push(particulars);
						refCodeArr.push(refCode);
						codeArr.push(code);
						amountArr.push(amount);
					}
				}
			});

			data.append('department', department);
			data.append('approver', approver);
			data.append('project', project);
			data.append('expenseType', expenseType);
			data.append('company', company);
			data.append('payee', payee);
			data.append('amountInWords', amountInWords);
			data.append('totalAmount', amount);
			data.append('qty', qtyArr);
			data.append('unit', unitArr);
			data.append('particulars', particularsArr);
			data.append('refCode', refCodeArr);
			data.append('code', codeArr);
			data.append('amount', amountArr);
			data.append('dueDate', dueDate);
			data.append('justification', justification);
			data.append('origin', window.location.origin);

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: data,
				dataType: 'json',
				contentType: false,
				processData: false,
				success: function(response) {
					if (response.status) {
						// $('#gender').val(null).trigger("chosen:updated");

						$('#rcp_form')[0].reset();
						// $("#rcp_form input[type=text]").val("");
						$("#rcp_form select").val(0).trigger("chosen:updated");
						// $("#rcp_form input[type=radio]").prop("checked", false);
						$("#rcp_form input[type=checkbox]").prop("checked", false);
						$("#expense_title").text("DEPARTMENT EXPENSE");
						return toastr.success(response.message, response.rcp_no)
					}
					else {
						return toastr.error(response.message, response.type)
					}
				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			})
		})
	})
</script>
