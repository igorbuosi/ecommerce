<?php
use \Hcode\Page;
use Hcode\Model\Product;
use Hcode\Model\Category;

$app->get('/', function() { //definindo a rota padrao / -> sem chamar nada  

	$products = Product :: listAll();

	$page = new Page(); // instanciou o construct
	$page->setTpl("index",[
		'products'=>Product::checkList($products)
	]);
	//destrutor é automatico
});

$app->get("/categories/:idcategory",function($idcategory){
	$category = new Category();
	$category->get((int)$idcategory);

	$page = new Page();
	$page->setTpl("category",[
		'category'=>$category->getValues(),
		'products'=>Product::checkList($category->getProducts())
	]);

});

?>