/**
 * Funcion service
 * contem todas as funÃ§Ãµes que podem ser compartilhadas entre controlers
 */
app.service('Fs', function($http, $timeout) {

	var $scope = {};

	this.setScope = function(scope) {
		$scope = scope;
	};

	this.preecheCelular = function(o) {

		var fone = angular.copy(o);

		fone = fone.split('(').join('');
		fone = fone.split(')').join('');
		fone = fone.split(' ').join('');
		fone = fone.split('-').join('');

		if (!(parseInt(fone) == fone)) {
			fone = parseInt(fone);
		}

		nf = '(';

		for (var i = 0; i < fone.length; i++) {

			if (i == 2) {
				nf += ') ';
			} else if (i == 6) {
				nf += '-';
			}

			nf += fone[i];
		}

		o = nf;

		return o;
	}

	this.preecheCnpf = function() {

		if ($scope.forn.func_cnpf != $scope.cnpf) {
			delete $scope.forn.cnpf;
		}

		var cnpf = angular.copy($scope.forn.func_cnpf);

		cnpf = cnpf.split('.').join('');
		cnpf = cnpf.split('/').join('');
		cnpf = cnpf.split('-').join('');

		var cpf = '';

		if (!(parseInt(cnpf) == cnpf)) {
			cnpf = parseInt(cnpf);
		}

		if (cnpf.length <= 11) {

			for (var i = 0; i < cnpf.length; i++) {

				if (i == 3) {
					cpf += '.';
				}
				if (i == 6) {
					cpf += '.';
				}
				if (i == 9) {
					cpf += '/';
				}

				cpf += cnpf[i];
			}

		} else {

			for (var i = 0; i < cnpf.length; i++) {

				if (i == 2) {
					cpf += '.';
				}
				if (i == 5) {
					cpf += '.';
				}
				if (i == 7) {
					cpf += '/';
				}

				if (i == 11) {
					cpf += '-';
				}

				if (i < 13) {
					cpf += cnpf[i];
				}
			}
		}

		$scope.forn.func_cnpf = cpf;
		$scope.cnpf = $scope.forn.func_cnpf;
	}

	this.post = function(acao, scopeIndex, params, callback, func) {

		param = (params ? params : {
			'acao': acao
		});

		param.acao = (acao ? acao : param.acao);

		var call = function(data) {

			data = data.data;

			if (scopeIndex) {
				$scope[scopeIndex] = data;
			}

			if (func) {
				$scope[func](data);
			}

			try {
				if (param.modal) {
					$(params.modal).modal('toggle');
				}
			} catch (e) {}

			try {
				if (param.eval) {
					$timeout(function() {
						eval(params.eval);
					}, 150);
				}
			} catch (e) {}

			try {
				if (param.setlocal) {
					setLocal(scopeIndex, data)
				}
			} catch (e) {}

			console.log(data);

			return data;
		}

		callback = (callback ? callback : call);

		$http.post(URREQ, param).then(callback, function errorCallback(response) {
			sweetAlert("Oops...", 'Erro de conexão com o servidor! função: ' + param.acao, "error");
			console.log(response);
		});
	}

});

/**
 * paga service
 * contem todas as funcões que podem ser compartilhadas entre controlers
 */