var app = angular.module('app', ['ngRoute']);
// configuração das rotas
app.config(function($routeProvider) {
	$routeProvider
		// route for the home page
		.when('/', {
			templateUrl: 'view/home.html',
			controller: 'home'
		})

		.when('/home', {
			templateUrl: 'view/home.html',
			controller: 'home'
		})

		.when('/quiz', {
			templateUrl: 'view/quiz.html',
			controller: 'quizContr'
		})

		.otherwise({
			redirectTo: '/'
		});

});

initMenu();