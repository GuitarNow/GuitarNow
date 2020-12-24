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
    public function get_specifiche_chitarre($id){
        return mysqli_fetch_assoc($this->prodotto->get_result_query("select * from getChitarre WHERE codice_prodotto =".$id));
    }

    public function get_produttori_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select produttore FROM getChitarre"), MYSQLI_ASSOC);
    }

    public function get_tipo_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select tipo_chitarra as tipo FROM getChitarre"), MYSQLI_ASSOC);
    }


    

    //------------- ACCESSORI --------------------

       // la funzione ritorna il contenuto della vista getChitarre che riporta la lista di tutti gli accessori contenenti nel database
    public function get_accessori()
    {
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori"), MYSQLI_ASSOC);
    }

    public function get_specifiche_accessori($id){
        return mysqli_fetch_assoc($this->prodotto->get_result_query("select * from getAccessori WHERE codice_prodotto =".$id));
    }

    public function get_produttori_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select produttore FROM getAccessori"), MYSQLI_ASSOC);
    }
    public function get_tipo_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select categoria as tipo FROM getAccessori"), MYSQLI_ASSOC);
    }

    //------------- FILTRI ACCESSORI --------------------
    

    public function filtri_accessori($categoria=NULL, $produttore=NULL, $prezzo=NULL){
        $query = "SELECT * FROM getAccessori";
        $primo = true;

        if($categoria != NULL)
        {
            if ($primo){
                $query.= "WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "categoria =".$categoria;
            
        }elseif($produttore != NULL)
        {
            if ($primo){
                $query.= "WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "produttore =".$produttore;
        }elseif ($prezzo != NULL) {
            if ($primo){
                $query.= "WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "prezzo <=".$prezzo;
        }
        
        return mysqli_fetch_all($this->prodotto->get_result_query($query), MYSQLI_ASSOC);
        
    }

    
    //------------- FILTRI CHITARRE --------------------

    public function filtri_chitarre($categoria=NULL, $produttore=NULL, $prezzo=NULL){
        $query = "SELECT * FROM getChitarre";
        $primo = true;

        if($categoria != NULL)
        {
            if ($primo){
                $query.= "WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "categoria =".$categoria;
            
        }elseif($produttore != NULL)
        {
            if ($primo){
                $query.= "WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "produttore =".$produttore;
        }elseif ($prezzo != NULL) {
            if ($primo){
                $query.= "WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "prezzo <=".$prezzo;
        }
        
        return mysqli_fetch_all($this->prodotto->get_result_query($query), MYSQLI_ASSOC);
        
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