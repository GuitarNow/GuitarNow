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
        return mysqli_fetch_assoc($this->prodotto->get_result_query("select * from getspecificheChitarre WHERE codice_prodotto =".$id));
    }

    public function get_produttori_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select distinct produttore FROM getChitarre"), MYSQLI_ASSOC);
    }

    public function get_tipo_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select distinct tipologia as tipo FROM getChitarre"), MYSQLI_ASSOC);
    }

    public function get_ultimi_arrivi_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getChitarre ORDER BY codice_prodotto DESC LIMIT 4"), MYSQLI_ASSOC);
    }

    public function get_numero_chitarre(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select count(*) as Num from getChitarre "), MYSQLI_ASSOC);
    }
    

    //------------- ACCESSORI --------------------

       // la funzione ritorna il contenuto della vista getChitarre che riporta la lista di tutti gli accessori contenenti nel database
    public function get_accessori()
    {
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori"), MYSQLI_ASSOC);
    }

    public function get_specifiche_accessori($id){
        return mysqli_fetch_assoc($this->prodotto->get_result_query("select * from getspecificheaccesssorii WHERE codice_prodotto =".$id));
    }

    public function get_produttori_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select distinct produttore FROM getAccessori"), MYSQLI_ASSOC);
    }
    public function get_tipo_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select distinct categoria as tipo FROM getAccessori"), MYSQLI_ASSOC);
    }

    public function get_ultimi_arrivi_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select * from getAccessori ORDER BY codice_prodotto DESC LIMIT 4"), MYSQLI_ASSOC);
    }

    public function get_numero_accessori(){
        return mysqli_fetch_all($this->prodotto->get_result_query("select count(*) as Num from getAccessori "), MYSQLI_ASSOC);
    }



    //------------- FILTRI ACCESSORI --------------------
    

    public function filtri_accessori($categoria=NULL, $produttore=NULL, $prezzo=NULL,$inizio=0,$fine=1000000){
        $query = "SELECT * FROM getAccessori";
        $primo = true;

        if($categoria != NULL)
        {
            if ($primo){
                $query.= " WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "categoria ='".$categoria."'";
            
        }
        if($produttore != NULL)
        {
            if ($primo){
                $query.= " WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= " produttore ='".$produttore."'";
        }
        
        if ($prezzo != NULL) {
            if ($primo){
                $query.= " WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }

            if($prezzo == "principiante"){
        
                $query .= "prezzo <= 150";
            }else if ($prezzo == "intermedia"){
                $query .= "prezzo >= 150 AND prezzo <=600";
            }else if ($prezzo == "professionale"){
                $query .= "prezzo >= 150 AND prezzo >=600";
            }
            
        }
        $query .=" LIMIT ".$inizio.",".$fine;
        return mysqli_fetch_all($this->prodotto->get_result_query($query), MYSQLI_ASSOC);
        
    }

   
    
    //------------- FILTRI CHITARRE --------------------

    public function filtri_chitarre($categoria=NULL, $produttore=NULL, $prezzo=NULL,$inizio=0,$fine=1000000){

       
        $query = "SELECT * FROM getChitarre";
        $primo = true;

        if($categoria != NULL)
        {
            if ($primo){
                $query.= " WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= "tipologia ='".$categoria."'";
            
        }
        if($produttore != NULL)
        {
            if ($primo){
                $query.= " WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }
            $query .= " produttore ='".$produttore."'";
        }
        
        if ($prezzo != NULL) {
            if ($primo){
                $query.= " WHERE ";
                $primo = false;
            }else{
                $query .="AND "; 
            }

            if($prezzo == "principiante"){
            
                $query .= "prezzo <= 150";
            }else if ($prezzo == "intermedia"){
                $query .= "prezzo >= 150 AND prezzo <=600";
            }else if ($prezzo == "professionale"){
                $query .= "prezzo >=600";
            }
            
        }
        $query .=" LIMIT ".$inizio.",".$fine;
        return mysqli_fetch_all($this->prodotto->get_result_query($query), MYSQLI_ASSOC);
        
    }

    //Delete
    public function delete_prodotti($id)
    {
        $query="DELETE FROM prodotto where codice_prodotto=".$id;
        return $this->prodotto->delete_query($query);
        
    }

  //-------------------CREAZIONE PRODOTTI------------------------
    public function crea_chitP($modello, $produttore, $descrizione, $prezzo_vendita){
    $query="INSERT INTO prodotto (modello, produttore, descrizione, prezzo_vendita) VALUES ('".$modello."', '".$produttore."', '".$descrizione."', '". $prezzo_vendita."')";
   return $this->prodotto->insert_query($query);

}

public function crea_chitC($tipo, $legno_manico, $legno_corpo){
    $query="INSERT INTO chitarra (legno_manico, legno_corpo, tipo_chitarra) VALUES ('".$legno_manico."', '".$legno_corpo."', '".$tipo."')"; 
    return $this->prodotto->insert_query($query);
}

public function crea_chitI($immagine, $short_desc, $long_desc){
    $query="INSERT INTO immagine ( long_desc, short_desc) VALUES ('".$immagine."', '".$long_desc."', '".$short_desc."')"; 
    return $this->prodotto->insert_query($query);
}

//-----------------------------MODIFICA PRODOTTI-------------------------------------

//public function modifica_prodP($modello, $produttore, $descrizione, $prezzo_vendita){
 //   $query="INSERT INTO prodotto (modello, produttore, descrizione, prezzo_vendita) VALUES ('".$modello."', '".$produttore."', '".$descrizione."', '". $prezzo_vendita."')";
 //  return $this->prodotto->insert_query($query);
//}

//public function modifica_prodC($tipo, $legno_manico, $legno_corpo){
 //  $query="INSERT INTO chitarra (legno_manico, legno_corpo, tipo_chitarra) VALUES ('".$legno_manico."', '".$legno_corpo."', '".$tipo."')"; 
 //   return $this->prodotto->insert_query($query);
//}

//public function modifica_prodI($immagine, $short_desc, $long_desc){
  //  $query="INSERT INTO immagine ( long_desc, short_desc) VALUES ('".$immagine."', '".$long_desc."', '".$short_desc."')"; 
  //  return $this->prodotto->insert_query($query);
//}

}
?>