app.controller('usuario', function($scope, Fs, $timeout) {

	Fs.setScope($scope);

	$scope.user = JSON.parse(getLocal('user'));

	if ($scope.user == null && window.location.pathname.search('admin') != -1) {
		window.location.href = '../login';
	}

	$scope.login = function() {

		delete $scope.erro;
		$('.alert').fadeOut('slow');

		if (($scope.logi.usua_logi && $scope.logi.usua_logi != '') && ($scope.logi.usua_senh && $scope.logi.usua_senh != '')) {

			Fs.post('login', 'l', {
				logi: $scope.logi,
			}, function(data) {
				data = data.data;

				if (data.erro) {
					$scope.erro = data.menssage;
					$('.alert').fadeIn('slow');
				} else {
					setLocal('user', data);
					window.location.href = '../admin';
				}
			});

		} else {
			swal('Opss', 'Todos os campos devem estar preenchidos', 'error');
		}
	}


	$scope.logout = function() {

		Fs.post('logout', 0, 0, function(data) {
			data = data.data;
			delLocal('user');
			window.location.href = '../';
		});

	}


});