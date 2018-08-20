app.controller('quizContr', function($scope, Fs) {

	Fs.setScope($scope);

	$scope.addPergunta = function(perg) {
		$scope.perg = perg ? perg : {};
		$('#Mpergunta').modal('toggle');
	}

	$scope.addRsposta = function(res) {
		res.push({});
	}

	$scope.salvaPerguta = function(perg) {
		perg.resp = [{}];
		$scope.quiz.qupe.push(perg);
		$('#Mpergunta').modal('toggle');
	}

	$scope.cancelquiz = function() {
		delete $scope.perg;
		$scope.perg = {};
		$('#Mpergunta').modal('toggle');
	}

	$scope.salvaQuiz = function() {

		console.log($scope.quiz);

		Fs.post('salvaQuiz', 'qz', {
			quiz: $scope.quiz
		});

		$scope.quiz = {
			qupe: []
		};
	}

	$scope.removePergunta = function(i) {
		$scope.quiz.qupe.splice(i, 1);
	}

	$scope.removeResposta = function(x, y) {
		$scope.quiz.qupe[x].resp.splice(y, 1);
	}

	$scope.mudaStatusQuiz = function(q) {
		q.quiz_ativ = ((q.quiz_ativ == 'A') ? 'I' : 'A');
		Fs.post('mudaStatusQuiz', false, {
			quiz: q
		});
	}

	$scope.carregaQuiz = function(q) {
		Fs.post('carregaQuiz', 'quiz', {
			quiz: q
		});
	}

	$scope.cancelaQuiz = function() {
		$scope.quiz = {
			qupe: []
		};
	}


	$scope.quiz = {
		qupe: []
	};

	Fs.post('listaQuizzes', 'qz');

});