<?php
use \Hcode\Page;

$app->get('/', function() { //definindo a rota padrao / -> sem chamar nada  
	$page = new Page(); // instanciou o construct
	$page->setTpl("index");
	//destrutor é automatico
});

?>