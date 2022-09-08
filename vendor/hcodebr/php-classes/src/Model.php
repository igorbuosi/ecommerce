<?php
namespace Hcode;

    class Model{
        private $values = [];

        public function __call($name,$args)
        {
            $method = substr($name,0,3);//pega os tres primeiros digitos
            $fieldName = substr($name,3,strlen($name)); //pega a partir da terceira opcao ate o final
            
            switch($method)
            {
                case "get":
                    return $this->values[$fieldName];
                break;

                case "set":
                    $this->values[$fieldName] = $args[0];
                break;
            }

        }

        //responsavel por criar os atributos e metodos getters e setters dinamicamente
        public function setData($data = array())
        {
            foreach ($data as $key => $value){
                //criar dinamico tem que colocar entre chaves 
                $this->{"set".$key}($value);

            }

        }

        public function getValues(){
            return $this->values;
        }

    }

?>