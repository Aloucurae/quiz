app.controller('inde', function($scope, Fs) {

	Fs.setScope($scope);

	Fs.post('listaQuizzes','qz');

});