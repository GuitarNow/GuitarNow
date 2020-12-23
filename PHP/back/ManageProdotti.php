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
    //------------- CHITARRE --------------------

    // la funzione ritorna il contenuto della vista getChitarre che riporta la lista di tutte le chitarre contenenti nel database
    public function get_chitarra()
    {
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getChitarre"), MYSQLI_ASSOC);
    }

    public function get_produttori_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select produttore FROM getChitarre"), MYSQLI_ASSOC);
    }

    //------------- FILTRI CHITARRE --------------------

    public function get_chitarre_produttore($produttore){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getChitarre where produttore =".$produttore), MYSQLI_ASSOC);
    }
   
    public function get_chitarre_produttore_prezzo($produttore, $prezzo){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getChitarre where produttore =".$produttore." AND prezzo <=".$prezzo), MYSQLI_ASSOC);
    }

    //------------- ACCESSORI --------------------

       // la funzione ritorna il contenuto della vista getChitarre che riporta la lista di tutti gli accessori contenenti nel database
    public function get_accessori()
    {
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori"), MYSQLI_ASSOC);
    }

    public function get_produttori_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select produttore FROM getAccessori"), MYSQLI_ASSOC);
    }

    //------------- FILTRI ACCESSORI --------------------
    public function get_accessori_produttore($produttore){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori where produttore =".$produttore), MYSQLI_ASSOC);
    }
   
    public function get_accessori_produttore_prezzo($produttore, $prezzo){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori where produttore =".$produttore." AND prezzo <=".$prezzo), MYSQLI_ASSOC);
    }

    public function get_accessori_categoria($categoria, $produttore=NULL, $prezzo=NULL){
        if($produttore == NULL && $prezzo == NULL)
        {
            return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori where categoria =".$categoria), MYSQLI_ASSOC);
        }elseif($produttore!= NULL && $prezzo ==NULL)
        {
            return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori where categoria =".$categoria."AND produttore =".$produttore), MYSQLI_ASSOC);
        }elseif($produttore == NULL && prezzo != NULL)
        {
            return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori where categoria =".$categoria."AND prezzo <=".$prezzo), MYSQLI_ASSOC);
        }elseif ($produttore!=NULL && prezzo!=NULL) {
            return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori where categoria =".$categoria."AND prezzo <=".$prezzo), MYSQLI_ASSOC);
        }
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