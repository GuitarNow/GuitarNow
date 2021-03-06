<?php

require_once('DatabaseConnection.php');

class ManageCommenti
{
    private $prodotto='';
    /* Il costruttore crea una connessione con il database */
    public function __construct()
    {
        $this->prodotto = new DatabaseConnection();
    }
    
    public function get_commenti($id)
    {
        $query="SELECT id_commento, descrizione, voto, DATE_FORMAT(getcommenti.data, '%d-%m-%Y') as data ,codice_prodotto, username from getcommenti WHERE codice_prodotto=".$id;
        return mysqli_fetch_all($this->prodotto->get_result_query($query), MYSQLI_ASSOC);
    }

    public function delete_commenti($id)
    {
        $query="DELETE FROM commento where id_commento =".$id;
        return $this->prodotto->delete_query($query);
    }

    public function inserisci_commento($commento,$voto,$codice_prodotto,$user){
        $query = "INSERT INTO commento (descrizione,voto,data,codice_prodotto,user) VALUES ('".$commento."','".$voto."', CURDATE(),'".$codice_prodotto."','".$user."')";
       
        return $this->prodotto->insert_query($query);
    }

  
}


?>