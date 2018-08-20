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

$PAGE->addContr('home.js');
$PAGE->addContr('quiz.js');
$PAGE->addContr('usua.js');

echo $PAGE->body();

/**/

// die();

?>
