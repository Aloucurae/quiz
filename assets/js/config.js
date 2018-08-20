/**
 * Controle de sessão e configuraçãoes globais do js
 */
var urlSearch = {};

var skUrl = 'http://' + window.location.host + window.location.pathname;

skUrl = skUrl.split('login/').join('');
skUrl = skUrl.split('admin/').join('');

var URREQ = skUrl + 'api/';


function getDomain() {
	return window.location.hostname.split('.')[1];
}

function getLocal(cname) {
	return window.localStorage.getItem(cname);
}

function setLocal(cname, data) {
	window.localStorage.setItem(cname, JSON.stringify(data));
}

function delLocal(cname) {
	window.localStorage.removeItem(cname);
}

function getUrlSearch() {
	var s = getLocal('urlSearch');
	var str = '?';
	if (s) {
		s = JSON.parse(s);
		for (var i in s) {
			str += i + '=' + s[i] + '&';
		}
		return str;
	}
	return '';
}

function setSearch() {
	var s = window.location.search;
	if (s) {
		s = s.replace('?', '');
		r = s.split('&');
		for (var i in r) {
			var k = r[i].split('=');
			urlSearch[k[0]] = k[1];
		}
	}
	setLocal('urlSearch', urlSearch);

	return urlSearch;
}

function redirect(local, url) {
	window.location[local] = url + getUrlSearch();
}

function findWithAttr(array, attr, value) {
	for (var i = 0; i < array.length; i += 1) {
		if (array[i][attr] === value) {
			return i;
		}
	}
	return -1;
}

function formataValor(id, t) {

	var res = '';

	if (t) {
		id = id;
	} else {
		id = $('#' + id).val();
	}

	try {
		res = id.split(' ').join('');
		res = res.split('R$').join('');
		res = res.split('.').join('');
		res = res.split(',').join('.');
		res = res.split('_').join('');
	} catch (e) {
		res = id;
	}

	if (!res) {
		return parseFloat(0.00).toFixed(2);
	}

	var rest = '';

	if (res == 0) {
		rest = res;
	} else if (res.toString().split('.').length < 2) {

		for (var i = 0; i < res.length; i++) {
			if (i == (res.length - 2)) {
				rest += '.';
			}
			rest += res[i];
		}
	}

	if (res.length == 2) {
		res += '.00';
	}

	if (rest) {
		res = rest;
	}

	return parseFloat(res).toFixed(2);
}

function in_array(str, arr) {
	var s = false
	$(arr).each(function(i, a) {
		if (str == a) {
			s = true;
		}
	});
	return s;
}

function get_time_diff(datetime) {

	var data = Date.diff(new Date(), new Date(datetime));

	var td = {
		d: data.days, //dias
		h: data.hours, //horas
		m: data.minutes, //minutos
		s: data.seconds
	};

	var result = '';

	td.h = td.h;

	td.d > 0 ? result += td.d + ' dias ' : result += '';
	td.h > 0 ? result += checkTime(td.h) + ':' : '';
	td.m > 0 ? result += checkTime(td.m) + ':' : result += '00:';
	td.s > 0 ? result += checkTime(td.s) : result += '00';
	return result;
}

function setLoading(l) {

	if (l) {
		$('#loading').html(loader);
		$('#loading').show();
	} else {
		$('#loading').html('');
		$('#loading').hide();
	}
}

$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
});

// setSearch();

// if (!getLocal('user') && window.location.pathname != '/login.html') {
// 	setLocal('url_redirect', window.location.href);
// 	redirect('href', 'login.html');
// }