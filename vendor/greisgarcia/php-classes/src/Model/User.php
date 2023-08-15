<?php

namespace Grg\Model;

use \Grg\DB\Sql;
use \Grg\Model;

class User extends Model {

    const SESSION = "User";

    protected $fields = [
		"iduser", "idperson", "deslogin", "despassword", "inadmin", "dtergister"
	];

    public static function login($deslogin,$despassword)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN"=>$deslogin
        ));

        if (count($results) === 0){
            throw new \Exception("Error Processing Request");
        }
        
        $data = $results[0];

        if (password_verify($despassword,$data["despassword"]) === true){
            
            $user = new User;
            $user->setData($data);
            $_SESSION[User::SESSION] = $user->getValues();
            return $user;

        } else {
            throw new \Exception("Error Processing Request");
        }
    }

    public static function verifyLogin($inadmin = true){

        if (!isset($_SESSION[User::SESSION]) || !$_SESSION[User::SESSION] || !(int)$_SESSION[User::SESSION]["iduser"]>0 || (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin){
            header("Location: /admin/login");
        }

    }
    
    public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

}


?>