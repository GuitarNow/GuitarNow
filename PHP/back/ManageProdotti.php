<?php


require_once('DatabaseConnection.php');

class ManageProdotti
{
    private $prodotto='';
    /* Il costruttore crea una connessione con il database */
    public function __construct()
    {
        $this->prodotto = new DatabaseConnection();
    }

    // la funzione ritorna il contenuto della vista getChitarre che riporta la lista di tutte le chitarre contenenti nel database
    public function get_chitarra()
    {
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getChitarre"), MYSQLI_ASSOC);
    }

    // la funzione ritorna il contenuto della vista getChitarre che riporta la lista di tutti gli accessori contenenti nel database
    public function get_accessori()
    {
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori"), MYSQLI_ASSOC);
    }

    public function get_produttori_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select produttore FROM getChitarre"), MYSQLI_ASSOC);
    }

    public function get_produttori_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select produttore FROM getAccessori"), MYSQLI_ASSOC);
    }

    public function get_chitarre_produttore($produttore){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getChitarre"), MYSQLI_ASSOC);
    }

    
}

  /*  $prod = new ManageProdotti();
    $p = $prod->get_chitarra();
    foreach($p as $pp)
    {
        echo $pp['modello']."<br/>";
    }
   */ 
?>