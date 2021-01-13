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
    //------------- CHITARRE --------------------
    public function get_commenti($id)
    {
        $query="select * FROM getCommenti WHERE codice_prodotto=".$id;
        return mysqli_fetch_all($this->prodotto->get_result_query($query), MYSQLI_ASSOC);
    }

    public function delete_commenti($id)
    {
        $query="DELETE FROM commenti where id_commento=".$id;
        return $this->prodotto->delete_query($query)
    }


}


?>