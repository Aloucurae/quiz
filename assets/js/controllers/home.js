app.controller('home', function($scope, Fs) {

	Fs.setScope($scope);

	Fs.post('listaRespondidos', 'qz');

	$scope.carregaQuizRespostas = function(q) {
		Fs.post('carregaQuizRespostas', 'quiz', {
			qucl: q.qucl_codi
		});
	}

});