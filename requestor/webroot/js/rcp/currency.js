function currencyToWords(s) {
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];
    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
	var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
	var peso = null;
	if (s > 1) {
		peso = "pesos";
	}
	else {
		peso = "peso only";
	}

    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
      var x = s.indexOf('.');
      var fulllength=s.length;

        if (x == -1) x = s.length;
        if (x > 15) return 'Amount too large';
        var startpos=fulllength-(fulllength-x-1);
        var n = s.split('');
        var str = '';
        var str1 = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk) str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            str += 'and ';
            str1 += 'centavos ';

        var j=startpos;
        for (var i = j; i < fulllength; i++) {
            if ((fulllength - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((fulllength - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((fulllength - i) % 3 == 1) {
                if (sk) str += th[(fulllength - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
      }
    var result = str.replace(/\s+/g, ' ') + str1;

	return result + "" + peso;
}

function allowNumbers(selector){
	$(selector).on("keypress keyup",function (event) {
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
}

function currencyWithCommas(total) {
	var parts = total.toFixed(2).split(".");
	var currencyWithCommas = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") +
	(parts[1] ? "." + parts[1] : "");

  	return currencyWithCommas;
}

function allowNumbersWithDecimal(selector){
	$(selector).on("keypress keyup",function (event) {
		var patt = new RegExp(/[0-9]*[.]{1}[0-9]{2}/i);
		var matchedString = $(this).text().match(patt);

		if (matchedString) {
			event.preventDefault();
		}

		if ((event.which != 46 || $(this).text().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
}

function calculateTotalAmount(selector, isChecked) {
	var totalAmount = 0;

	$(selector).each(function() {
		var qty = $(this).find("td").eq(0).html();
		var unit = $(this).find("td").eq(1).html();
		var particulars = $(this).find("td").eq(2).html();
		var refCode = $(this).find("td").eq(3).html();
		var code = $(this).find("td").eq(4).html();
		var amount = parseFloat($(this).find("td").eq(5).html());

		if (qty && unit && particulars && refCode && !code && amount && isChecked == true) {
			totalAmount = parseFloat(totalAmount + amount);
		}
		else {
			if (qty && unit && particulars && refCode && code && amount && isChecked == false) {
				totalAmount = parseFloat(totalAmount + amount);
			}
		}
	});

	return totalAmount;
}

function keypressToCalculate(selector, isChecked = false){
	$(selector).on("keypress keyup copy paste",function (event) {
		var totalAmount = calculateTotalAmount('#rcp_table > tbody > tr', isChecked);
		var amountInwords = currencyToWords(totalAmount).substr(0, 1).toUpperCase() + "" + currencyToWords(totalAmount).substr(1).toLowerCase();

		if (totalAmount > 0) {
			if (totalAmount > 999999999999999) {
				return toastr.error("Amount due is too large.", "Currency")
			}
			totalAmount = currencyWithCommas(totalAmount);
			return $('#amount').text(totalAmount) && $('#amount_in_words').val(amountInwords);
		}
		else {
			return $('#amount').text("0.00") && $('#amount_in_words').val("");
		}
	});
}

function removeCommas(amount) {
	var currencyNoCommas = amount.replace(/\,/g,'');
	return currencyNoCommas = Number(currencyNoCommas);
}

function calculateVat(subtotal, type, professionalFee) {
	var netVat = subtotal / 1.12;
	var discount = 0.00;

	$('#professional-div').attr('hidden', true);
	if (type == 1) {
		discount = netVat * 0.01;
	}
	else if (type == 2) {
		discount = netVat * 0.02;
	}
	else if (type == 3) {
		discount = netVat * 0.05;
	}
	else {
		$('#professional-div').attr('hidden', false);
		discount = netVat * (professionalFee / 100);
	}

	var vatAmount = subtotal - discount;
	var lessVat = subtotal - netVat;

	return {
		'lessVat': currencyWithCommas(lessVat),
		'netVat': currencyWithCommas(netVat),
		'discount': currencyWithCommas(discount),
		'vatAmount': currencyWithCommas(vatAmount)
	};
}
