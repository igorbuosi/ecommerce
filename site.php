<?php
use \Hcode\Page;
use Hcode\Model\Product;

$app->get('/', function() { //definindo a rota padrao / -> sem chamar nada  

	$products = Product :: listAll();

	$page = new Page(); // instanciou o construct
	$page->setTpl("index",[
		'products'=>Product::checkList($products)
	]);
	//destrutor é automatico
});

?>