<?php

/**/
require_once 'class.body.php';

$PAGE = new Body('GerOs Gerenciador'); 

$PAGE->addCss('assets/plugins/morris/morris.css');
$PAGE->addCss('assets/css/bootstrap.min.css');
$PAGE->addCss('assets/plugins/bootstrap-sweetalert/sweet-alert.css');
$PAGE->addCss('assets/css/icons.css');
$PAGE->addCss('assets/css/style.css');
$PAGE->addCss('assets/css/custom.css');

$PAGE->addjs('assets/js/jquery.min.js');
$PAGE->addjs('assets/js/bootstrap.min.js');
$PAGE->addjs('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
$PAGE->addjs('assets/js/detect.js');
$PAGE->addjs('assets/js/fastclick.js');
$PAGE->addjs('assets/js/jquery.slimscroll.js');
$PAGE->addjs('assets/js/jquery.blockUI.js');
$PAGE->addjs('assets/js/waves.js');
$PAGE->addjs('assets/js/wow.min.js');
$PAGE->addjs('assets/js/jquery.nicescroll.js');
$PAGE->addjs('assets/js/jquery.scrollTo.min.js');
$PAGE->addjs('assets/plugins/parsleyjs/parsley.min.js');
$PAGE->addjs('assets/plugins/morris/morris.min.js');
$PAGE->addjs('assets/plugins/raphael/raphael-min.js');

$PAGE->addjs('assets/js/style.js');

$PAGE->addjs('assets/js/config.js');

$PAGE->addjs('assets/plugins/angular/angular.min.js');
$PAGE->addjs('assets/plugins/angular-router/angular-route.js');
$PAGE->addjs('assets/plugins/angular-locale/angular-locale_pt-BR.js');

$PAGE->addjs('assets/js/app.js');
$PAGE->addjs('assets/js/services.js');

$PAGE->addjs('assets/js/services.js');

$PAGE->addContr('inde.js');
$PAGE->addContr('resp.js');

echo $PAGE->head();

?>
<div class="topbar">
	<div class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="">
				<ul class="nav navbar-nav navbar-right pull-right">
					<li class="">
						<a href="login/" class="profile waves-effect waves-light" aria-expanded="true">
							<small>Administração</small>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<br>
<br>
<br>
<div class="col-md-3 col-sx-1"></div>

<div class="col-md-6 col-sx-10 ng-view"></div>

<div class="col-md-3 col-sx-1"></div>
<?php 
echo $PAGE->footer();
?>
