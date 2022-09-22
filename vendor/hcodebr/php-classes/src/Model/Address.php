<?php
namespace Hcode\Model;
use \Hcode\Model;
use Hcode\DB\Sql;



class Address extends Model{
    const SESSION_ERROR = "AddressError";

    public static function getCEP($nrcep){
        $nrcep = str_replace("-","", $nrcep);

        //https://viacep.com.br/ws/15610358/json/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://viacep.com.br/ws/$nrcep/json/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = json_decode(curl_exec($ch), true);

        curl_close($ch);

        return $data;

    }

    public function loadFromCEP($nrcep){
        $data = Address::getCEP($nrcep);

        if (isset($data['logradouro']) && ($data['logradouro']) !== ''){
            $this->setdesaddress($data['logradouro']);
            $this->setdescomplement($data['complemento']);
            $this->setdesdistrict($data['bairro']);
            $this->setdescity($data['localidade']);
            $this->setdesstate($data['uf']);
            $this->setdescountry('Brasil');
            $this->setdeszipcode($nrcep);

        }

    }

    public function save(){
        $sql  = new Sql();

        $results = $sql->select("call sp_addresses_save(:idaddress, :idperson, :desaddress, :descomplement, :descity, :desstate, :descountry, :deszipcode, :desdistrict)",[
            ':idaddress'=>$this->getidaddress(),
            ':idperson'=>$this->getidperson(),
            ':desaddress'=>$this->getdesaddress(),
            ':descomplement'=>$this->getdescomplement(),
            ':descity'=>$this->getdescity(),
            ':desstate'=>$this->getdesstate(),
            ':descountry'=>$this->getdescountry(),
            ':deszipcode'=>$this->getdeszipcode(),            
            ':desdistrict'=>$this->getdesdistrict()
        ]);

        if(count($results)>0){
            $this->setData($results[0]);
        }
    }

    public static function setMsgError($msg){
        $_SESSION[Address::SESSION_ERROR] = $msg;
    }

    public static function getMsgError(){
        $msg =  (isset($_SESSION[Address::SESSION_ERROR])) ? $_SESSION[Address::SESSION_ERROR] : "";

        Address::clearMsgError();

        return $msg;
    }

    public static function clearMsgError(){
        $_SESSION[Address::SESSION_ERROR] = null;
    }
   



}


?>