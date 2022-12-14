<?php
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app->get('/admin', function() { //definindo a rota padrao / -> sem chamar nada
    User::verifyLogin();	
	$page = new PageAdmin(); // instanciou o construct
	$page->setTpl("index");
	//destrutor é automatico
});

$app->get('/admin/login', function() { 
	//pagina de login nao tem o mesmo header e footer das outras paginas do admin, por isso tem que desabilitar a chamad automatica    
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]); 
	$page->setTpl("login");
	//destrutor é automatico
});

$app->post("/admin/login", function(){
	User::login($_POST["login"],$_POST["password"]);
	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function() {	
	User::logout();
	header("Location: /admin/login");
	exit;
});
?>