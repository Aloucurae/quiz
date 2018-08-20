<?php

/**/
require_once '../class.body.php';

$PAGE = new Body('Quiz','app','../'); 

$PAGE->addCss('../assets/plugins/morris/morris.css');
$PAGE->addCss('../assets/css/bootstrap.min.css');
$PAGE->addCss('../assets/plugins/bootstrap-sweetalert/sweet-alert.css');
$PAGE->addCss('../assets/css/icons.css');
$PAGE->addCss('../assets/css/style.css');
$PAGE->addCss('../assets/css/custom.css');
$PAGE->addjs('../assets/js/jquery.min.js');
$PAGE->addjs('../assets/js/bootstrap.min.js');
$PAGE->addjs('../assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
$PAGE->addjs('../assets/js/detect.js');
$PAGE->addjs('../assets/js/fastclick.js');
$PAGE->addjs('../assets/js/jquery.slimscroll.js');
$PAGE->addjs('../assets/js/jquery.blockUI.js');
$PAGE->addjs('../assets/js/waves.js');
$PAGE->addjs('../assets/js/wow.min.js');
$PAGE->addjs('../assets/js/jquery.nicescroll.js');
$PAGE->addjs('../assets/js/jquery.scrollTo.min.js');
$PAGE->addjs('../assets/plugins/parsleyjs/parsley.min.js');
$PAGE->addjs('../assets/plugins/morris/morris.min.js');
$PAGE->addjs('../assets/plugins/raphael/raphael-min.js');
$PAGE->addjs('../assets/js/style.js');
$PAGE->addjs('../assets/js/config.js');
$PAGE->addjs('../assets/plugins/angular/angular.min.js');
$PAGE->addjs('../assets/plugins/angular-router/angular-route.js');
$PAGE->addjs('../assets/plugins/angular-locale/angular-locale_pt-BR.js');

$PAGE->addjs('../assets/js/adm.js');
$PAGE->addjs('../assets/js/services.js');

$PAGE->addContr('usua.js');

echo $PAGE->head();

?>

<br>
<br>
<br>
<div class="col-md-4 col-sx-3"></div>

<div class="col-md-4 col-sx-6" ng-controller="usuario">
	<div class="panel ">
		<div class="panel-heading text-center">
			<h4 class="panel-title text-muted font-light">Login</h4>
		</div>
		<div class="panel-body p-t-10">

			<div ng-show="erro" class="alert alert-danger">{{erro}}</div>

			<div class="form-group">
				<label>Login</label>
				<input type="text" ng-model="logi.usua_logi" class="form-control" placeholder="Alex jonas">
			</div>
			<div class="form-group">
				<label>Senha</label>
				<input type="password" ng-model="logi.usua_senh" class="form-control" placeholder="**********">
			</div>
			<div class="row">
				<div class="col-xs-6">
					<a href="../" class="btn btn-danger col-xs-12">
						Voltar
					</a>
				</div>
				
				<div class="col-xs-6">
					<button ng-click="login()" class="btn btn-success col-xs-12">
						Entrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-4 col-sx-3"></div>
<?php 
echo $PAGE->footer();
?>
