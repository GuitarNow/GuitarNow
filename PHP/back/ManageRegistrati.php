<?php

require_once('DatabaseConnection.php');

class ManageRegistrati
{

    private $prodotto='';
    /* Il costruttore crea una connessione con il database */
    public function __construct()
    {
        $this->prodotto = new DatabaseConnection();
    }
    public function registrati($email, $username, $password){
        $query = "INSERT INTO user (username,email,password) VALUES ('".$username."','".$email."','".$password."')";
        return $this->prodotto->insert_query($query);
    }
      
}


?>