var app = angular.module('app', ['ngRoute']);
// configuração das rotas
app.config(function($routeProvider) {
	$routeProvider
		// route for the home page
		.when('/', {
			templateUrl: 'view/home.html',
			controller: 'inde'
		})

		.when('/:quiz', {
			templateUrl: 'view/resp.html',
			controller: 'resp'
		})

		.otherwise({
			redirectTo: '/'
		});

});