<?php
namespace Hcode;

class PageAdmin extends Page{

    public function __construct($opts = array(), $tpl_dir = "/views/admin/")
    {
        parent::__construct($opts, $tpl_dir); //parent busca o metodo da classe pai (Page) pois essa extend os metodos de lá - Heranca
    }


}

?>