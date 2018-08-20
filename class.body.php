<?php 


/**
 * 
 */
class Body 
{
	public $title; 
	public $app; 
	public $aCss = array(); 
	public $aJs = array(); 
	public $aContr = array(); 
	public $dir = __DIR__; 
	public $path = __DIR__; 

	function __construct($title,$app = 'app', $path = ''){
		$this->title = $title;
		$this->app = $app;
		$this->path = $path;
	}

	function fileVersion($file){
		$file = str_replace('../', '', $file);
		return  md5_file($this->dir.'/'.$file);
	}

	function addJs($js){
		$this->aJs[] = $js.'?v='.$this->fileVersion($js); 
	}

	function addCss($css){
		$this->aCss[] = $css.'?v='.$this->fileVersion($css); 
	}

	function addContr($contr){
		$this->dir = str_replace('admin/', '', $this->dir);
		$this->aContr[] = 'assets/js/controllers/'.$contr.'?v='.$this->fileVersion('assets/js/controllers/'.$contr);
	}

	function loadCss(){
		$html = '';
		foreach ($this->aCss as $key => $css) {
			$html .= '<link rel="stylesheet"  href="'.$css.'" >'."\n";
		}
		return $html;
	}

	function loadJs(){
		$html = '';
		foreach ($this->aJs as $key => $js) {
			$html .= '<script src="'.$js.'"></script>'."\n";

		}
		return $html;
	}

	function loadContr(){
		$html = '';

		foreach ($this->aContr as $key => $js) {
			$html .= '<script src="'.$this->path.$js.'"></script>'."\n";
		}
		return $html;
	}

	function head(){

		$html = '';
		$html .= ' <!DOCTYPE html>'."\n";
		$html .= ' <html ng-app="'.$this->app.'" >'."\n";
		$html .= ' <head>'."\n";
		$html .= ' 	<meta charset="utf-8" >'."\n";
		$html .= ' 	<title>'.$this->title.'</title>'."\n";
		$html .= ' 	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >'."\n";
		$html .= ' 	<meta content="Admin Dashboard" name="description" >'."\n";
		$html .= ' 	<meta content="ThemeDesign" name="author" >'."\n";
		$html .= ' 	<meta http-equiv="X-UA-Compatible" content="IE=edge" >'."\n";
		$html .= ' 	<link rel="shortcut icon" href="assets/images/favicon.ico">'."\n";
		$html .= $this->loadCss();
		$html .= ' </head>'."\n";

		return $html;
	}

	function body(){

		$html = $this->head();

		
		$html .= '<body class="fixed-left">'."\n";
		$html .= '	<div id="wrapper">'."\n";
		$html .= '		<div class="topbar">'."\n";
		$html .= '			<div class="topbar-left">'."\n";
		$html .= '				<div class="text-center">'."\n";
		$html .= '					<a href="index-2.html" class="logo">'."\n";
		$html .= '						<span>Qui</span>z</a>'."\n";
		$html .= '						<a href="index-2.html" class="logo-sm">'."\n";
		$html .= '							<span>G</span>'."\n";
		$html .= '						</a>'."\n";
		$html .= '					</div>'."\n";
		$html .= '				</div>'."\n";
		$html .= '				<div class="navbar navbar-default" role="navigation">'."\n";
		$html .= '					<div class="container">'."\n";
		$html .= '						<div class="">'."\n";
		$html .= '							<ul class="nav navbar-nav navbar-right pull-right" ng-controller="usuario">'."\n";
		$html .= '								<li class="dropdown">'."\n";
		$html .= '									<a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">'."\n";
		$html .= '										<span class="profile-username"> {{user.usua_nome}}</span>'."\n";
		$html .= '									</a>'."\n";
		$html .= '									<ul class="dropdown-menu">'."\n";
		$html .= '											<li>'."\n";
		$html .= '												<a ng-click="logout()"> Sair</a>'."\n";
		$html .= '											</li>'."\n";

		$html .= '										</ul>'."\n";
		$html .= '									</li>'."\n";
		$html .= '							</ul>'."\n";
		$html .= '						</div>'."\n";
		$html .= '					</div>'."\n";
		$html .= '				</div>'."\n";
		$html .= '			</div>'."\n";
		$html .= '				<div class="left side-menu">'."\n";
		$html .= '					<div class="sidebar-inner slimscrollleft">'."\n";

		$html .= '						<div id="sidebar-menu">'."\n";
		$html .= '							<ul>'."\n";
		$html .= '								<li class="active">'."\n";
		$html .= '									<a href="#/home" class="waves-effect active">'."\n";
		$html .= '										<i class="mdi mdi-home"></i>'."\n";
		$html .= '											<span>Principal</span>'."\n";
		$html .= '									</a>'."\n";
		$html .= '								</li>'."\n";
		$html .= '								<li class="has_sub">'."\n";
		$html .= '									<a class="waves-effect">'."\n";
		$html .= '										<i class="mdi mdi-album"></i>'."\n";
		$html .= '										<span> Cadastros </span>'."\n";
		$html .= '										<span class="pull-right">'."\n";
		$html .= '											<i class="mdi mdi-plus"></i>'."\n";
		$html .= '										</span>'."\n";
		$html .= '									</a>'."\n";
		$html .= '									<ul class="list-unstyled">'."\n";
		$html .= '										<li>'."\n";
		$html .= '											<a href="#/quiz">Quiz</a>'."\n";
		$html .= '										</li>'."\n";

		// $html .= '										<li>'."\n";
		// $html .= '											<a href="#/Quizl">Quiz</a>'."\n";
		// $html .= '										</li>'."\n";

		$html .= '									</ul>'."\n";
		$html .= '								</li>'."\n";
		$html .= '							</ul>'."\n";
		$html .= '						</div>'."\n";

		$html .= '						</div>'."\n";
		$html .= '						<div class="clearfix">'."\n";
		$html .= '						</div>'."\n";
		$html .= '					</div>'."\n";
		$html .= '				</div>'."\n";
		$html .= '				<div class="content-page">'."\n";
		$html .= '					<br><br><br>'."\n";
		$html .= '					<ng-view class="content">'."\n";
		$html .= '					</ng-view>'."\n";
		$html .= '				</div>'."\n";
		$html .= '			</div>'."\n";
		$html .= '			<footer class="footer"> © 2018 Alex Jonas - All Rights Reserved. </footer>'."\n";
		$html .= '		</div>'."\n";
		$html .= '	</div>'."\n";

		$html .= $this->footer();

		return $html;
	}

	function footer(){

		$html = $this->loadJs();
		$html .= $this->loadContr();

		$html .= '</body>'."\n";
		$html .= '</html>'."\n";
		return $html;


	}


}




 ?>