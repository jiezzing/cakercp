function currencyToWords(s) {
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];
    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
      var x = s.indexOf('.');
      var fulllength=s.length;

        if (x == -1) x = s.length;
        if (x > 15) return 'too big';
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

	return result;
}

function allowNumbers(selector){
	$(selector).on("keypress keyup blur",function (event) {
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
}

function allowNumbersWithDecimal(selector){
	$(selector).on("keypress keyup blur",function (event) {
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
