app.controller('resp', function($scope, Fs, $routeParams) {

	Fs.setScope($scope);

	Fs.post('carregaQuiz', 'quiz', {
		quiz: {
			quiz_codi: $routeParams.quiz
		}
	}, function(data) {

		data = data.data;

		$scope.quiz = data;



		console.log($scope.quiz.qupe.length);

	});

	$scope.cadatraCliente = function() {
		Fs.post('cadatraCliente', 'clie', {
			clie: $scope.clie,
			quiz: $scope.quiz
		});
	};

	$scope.salvaRespostaCliente = function() {

		Fs.post('salvaRespostaCliente', 0, {
			clie: $scope.clie,
			quiz: $scope.quiz
		});

		var p = 0;
		var r = 0;

		for (var i in $scope.quiz.qupe) {
			for (var x in $scope.quiz.qupe[i].resp) {
				if ($scope.quiz.qupe[i].resp[x].resp_verd == 1) {
					p++;
					if ($scope.quiz.qupe[i].resp[x].resp_clie) {
						r++;
					}
				}
			}
		}

		$scope.text = 'Voce acertou ' + r + ' de ' + p + ' opções';

	};

	$scope.progress = function(i) {

		var t = $scope.quiz.qupe.length + 1;

		var p = (i * 100) / t;

		$('.progress-bar').css('width', p + '%');
	}

	$scope.proximo = function() {

		delete $scope.erro;

		if ($scope.clie.clie_mail && $scope.clie.clie_mail != '') {

			if ($scope.etapa == 0) {

				$scope.cadatraCliente();
				$scope.etapa = 1;
				$scope.qupe = $scope.quiz.qupe[$scope.resp];

			} else if ($scope.etapa == 1) {

				var p = false;

				for (var i = $scope.qupe.resp.length - 1; i >= 0; i--) {
					if ($scope.qupe.resp[i].resp_clie == 1) {
						p = true;
					}
				}

				if (p) {
					$scope.resp++;
				} else {
					$scope.erro = 'Selecione alguma opção';
				}

				if ($scope.quiz.qupe.length <= $scope.resp) {

					$scope.etapa = 2;
					console.log('etapa' + $scope.etapa);
					$scope.salvaRespostaCliente();

				} else {
					$scope.qupe = $scope.quiz.qupe[$scope.resp];
				}
			} else if ($scope.etapa == 2) {
				window.location.hash = '';
			}

			$scope.progress($scope.etapa + $scope.resp);

		} else {
			$scope.erro = 'Digite seu email para proseguir';
		}

	}

	$scope.clie = {};
	$scope.etapa = 0;
	$scope.resp = 0;

});