<?php 

require_once("vendor/autoload.php");
use \Slim\Slim;
use \Hcode\Page;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() { //definindo a rota padrao / -> sem chamar nada
    
	$page = new Page(); // instanciou o construct
	$page->setTpl("index");
	//destrutor é automatico

});

$app->run();

 ?>