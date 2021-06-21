<?php

include('PHP/back/Session.php');
require_once("PHP/back/ManageProdotti.php");
if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
}
else{
	$permessi=-1;
}

if($permessi==1){
$web_page = file_get_contents('Html/template.html');

$web_page = str_replace('<title_page/>', "Crea Prodotti Amministrazione", $web_page);
$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteP', 'id="linkCorrente"', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteC', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<breadcrumbs_to_insert/>', "Crea Prodotto - Amministrazione", $web_page);

$web_page = str_replace('<gestioneAccesso/>', '<a href="Logout.php" id="logout">Logout</a>', $web_page);
$web_page = str_replace('<gestioneAccessoMobile/>', '<a href="Logout.php" id="logout_menu">Logout</a>', $web_page);

if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$categoria = $_REQUEST['categoria'];
error_reporting(0);

$data=file_get_contents('Html/creaProdotto.html');
$data = str_replace('<tip/>',$categoria, $data);

/*

if(isset($_REQUEST['SalvaCrea'])){

if($categoria == "accessori"){
    $produttore = $_POST['produttoreAmmCreaA1'];
    $tipo = $_POST['tipologiaAmmCreaA1'];
    }else{
        $produttore = $_POST['produttoreAmmCreaC1'];
        $tipo = $_POST['tipologiaAmmCreaC1'];
        $legno_manico = $_POST['legnoManicoCrea'];
        $legno_corpo = $_POST['legnoCorpoCrea'];
    }
    $modello = $_POST['modelloCrea'];
    $descrizione = $_POST['descrizioneCrea'];
    
    $descrizione=str_replace('{en}','<span lang="en" >',$descrizione);
    $descrizione=str_replace('{/en}',' </span>',$descrizione);
    
        $short_desc = $_POST['short_descCrea'];
        $long_desc = $_POST['long_descCrea'];
        $prezzo_vendita = $_POST['prezzoCrea'];

        if (strlen($modello) !=0 && strlen($produttore) != 0 && strlen($descrizione)> 25 && is_numeric($prezzo_vendita) && strlen($tipo)!=0 && strlen($short_desc)>5 && ($categoria == "chitarre" && strlen($legno_manico)!=0 && strlen($legno_corpo)!=0 || $categoria == "accessori")){
    $creazioneP = new ManageProdotti();
   $creazioneP->crea_chitP($modello, $produttore, $descrizione, $prezzo_vendita);
    
   if($categoria == "chitarre"){
   $creazioneC = new ManageProdotti();
   $creazioneC->crea_chitC($tipo, $legno_manico, $legno_corpo);
   }
   if($categoria == "accessori"){
   $creazioneA = new ManageProdotti();
   $creazioneA->crea_chitA($tipo);
   }

   if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"Images/".$file_name);
     //  echo "Success";
    }else{
       print_r($errors);
    }
    $creazioneI = new ManageProdotti();
    $creazioneI->crea_chitI("Images/".$file_name, $short_desc,$long_desc);
 }

  if(isset($_REQUEST['SalvaCrea']))
  {
    $data = str_replace('<span class="inserimento_eseguito"></span>
    ','<p class="operazione_confermata">Prodotto inserito correttamente</p>', $data);
  }
  else{
    $data = str_replace('<span class="inserimento_eseguito"></span>
    ','', $data);

  }
  
}
else{
if(strlen($modello)<1){
  $data = str_replace('<span class="erroreModCrea"></span>','<p class="errore">Devi assegnare un valore</p>', $data);
}
else{
  $data = str_replace('<input type="text" id="modelloCrea" name="modelloCrea" class="modello" valueModCrea/>','<input type="text" id="modelloCrea" name="modelloCrea" class="modello" value="'.$modello.'"/>', $data);
}

   
     
       if(!is_numeric($prezzo_vendita)){
        $data = str_replace('<span class="erroreProdCrea"></span>','<p class="errore">Devi assegnare un valore numerico</p>', $data);
         }
         else{
          $data = str_replace('<input type="text" name="prezzoCrea" id="prezzoCrea" class="prezzo" placeholder="€"/>','<input type="text" name="prezzoCrea" id="prezzoCrea" class="prezzo" placeholder="€" value="'.$prezzo_vendita.'"/>', $data);
        }
         if(strlen($short_desc) <5){
          $data = str_replace('<span class="erroreSICrea"></span>','<p class="errore">Deve contenere più di 5 caratteri</p>', $data);
         }
        
 
      }   
}
*/




if(isset($_REQUEST['SalvaCrea'])){

  $produttore = $_POST['produttoreAmmCrea'];
  $tipo = $_POST['tipologiaAmmCrea'];
  $modello = $_POST['modelloCrea'];
  $descrizione = $_POST['descrizioneCrea'];
  
  $descrizione=str_replace('{en}','<span lang="en" >',$descrizione);
  $descrizione=str_replace('{/en}',' </span>',$descrizione);
  
  $short_desc = $_POST['short_descCrea'];
  $long_desc = $_POST['long_descCrea'];
  $prezzo_vendita = $_POST['prezzoCrea'];


  $creazioneP = new ManageProdotti();
  $creazioneP->crea_chitP($modello, $produttore, $descrizione, $prezzo_vendita);

  if($categoria == "accessori"){
    $creazioneA = new ManageProdotti();
    $creazioneA->crea_chitA($tipo);
  }

  if($categoria == "chitarre"){
        $legno_manico = $_POST['legnoManicoCrea'];
        $legno_corpo = $_POST['legnoCorpoCrea'];
        $creazioneC = new ManageProdotti();
        $creazioneC->crea_chitC($tipo, $legno_manico, $legno_corpo);
  }


  if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    /*
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"Images/".$file_name);
     //  echo "Success";
    }else{
       print_r($errors);
    }*/

    $creazioneI = new ManageProdotti();
    $creazioneI->crea_chitI("Images/".$file_name, $short_desc,$long_desc);


    $data = str_replace('<inserimento_eseguito/>','<p class="operazione_confermata">Prodotto inserito correttamente</p>', $data);
 }


}


$data = str_replace('<inserimento_eseguito/>','', $data);















    
    
  if($categoria == "accessori"){

    $produttori_manage_accessori = new ManageProdotti();
    $p = $produttori_manage_accessori->get_produttori_accessori();
    $tipi_accessori = new ManageProdotti();
    $t = $tipi_accessori->get_tipo_accessori();
    $produttori_accessori="";
    $tipi_accessori="";
    foreach($p as $produttori_da_visualizzare){
      $produttori_accessori.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
 }
 foreach($t as $tipi_da_visualizzare){
  $tipi_accessori.= '<option value="'.$tipi_da_visualizzare['tipo'].'">';
}

    $data = str_replace('<datiCreazione/>','
    <input type="hidden" name="codiceProdottoCrea" value=""/>
    <label for="produttoreAmmCrea">Produttore</label><span class="erroreProdCrea"></span>
    <input list="produttoreAmmCreaA" name="produttoreAmmCrea" id="produttoreAmmCrea"/> 
    <datalist id="produttoreAmmCreaA">'.
    $produttori_accessori
    .'
    
    </datalist>
<label for="tipologiaAmmCrea">Tipologia</label> <span class="erroreTipCrea"></span>
<input list="tipologiaAmmCreaA" name="tipologiaAmmCrea" id="tipologiaAmmCrea"/>
<datalist id="tipologiaAmmCreaA">'.
$tipi_accessori.'
</datalist>', $data);
  }else{
    $produttori_manage = new ManageProdotti();
    $p = $produttori_manage->get_produttori_chitarre();
    $tipi_accessori = new ManageProdotti();
    $t = $tipi_accessori->get_tipo_chitarre();
    $produttori_chitarre="";
    $tipi_chitarra="";
    foreach($p as $produttori_da_visualizzare){
      $produttori_chitarre.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
 }
 foreach($t as $tipi_da_visualizzare){
  $tipi_chitarra.= '<option value="'.$tipi_da_visualizzare['tipo'].'">';
}

    $data = str_replace('<datiCreazione/>','

    <label for="produttoreAmmCrea">Produttore</label><span class="erroreProdCrea"></span>
    <input list="produttoreAmmCreaC" name="produttoreAmmCrea" id="produttoreAmmCrea"/>
    <datalist id="produttoreAmmCreaC">'.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmCrea">Tipologia</label><span class="erroreTipCrea"></span>
    <input list="tipologiaAmmCreaC" name="tipologiaAmmCrea" id="tipologiaAmmCrea"/>
    <datalist id="tipologiaAmmCreaC">'.
    $tipi_chitarra 
    .'
    </datalist>
    <label for="legnoManicoCrea">Legno del manico</label>
    <input type="text" name="legnoManicoCrea" id="legnoManicoCrea" class="legnoManico"/>
    <label for="legnoCorpoCrea">Legno del corpo</label>
    <input type="text" name="legnoCorpoCrea" id="legnoCorpoCrea" class="legnoCorpo"/>', $data);
   
  }
 /*
  if(isset($_REQUEST['SalvaCrea'])){
 
             if(strlen($legno_manico)<1){
              $data = str_replace('<span class="erroreLMCrea"></span>','<p class="errore">Devi assegnare un valore</p>', $data);
               }
               else{
                $data = str_replace('<input type="text" name="legnoManicoCrea" id="legnoManicoCrea" class="legnoManico"/>','<input type="text" name="legnoManicoCrea" id="legnoManicoCrea" class="legnoManico" value="'.$legno_manico.'"/>', $data);
               }
               
               if(strlen($legno_corpo)<1){
                $data= str_replace('<span class="erroreLCCrea"></span>','<p class="errore">Devi assegnare un valore</p>', $data);
                 }
                 else{
                  $data = str_replace('<input type="text" name="legnoCorpoCrea" id="legnoCorpoCrea" class="legnoCorpo"/>','<input type="text" name="legnoCorpoCrea" id="legnoCorpoCrea" class="legnoCorpo" value="'.$legno_corpo.'"/>', $data);
                 }
                 
                 if(strlen($tipo)<1){
                  $data = str_replace('<span class="erroreTipCrea"></span>','<p class="errore">Assegna un valore</p>', $data);
                   } elseif($categoria == "accessori"){
                    $data = str_replace('<input list="tipologiaAmmCreaA" name="tipologiaAmmCreaA1" id="tipologiaAmmCreaA1"/>','<input list="tipologiaAmmCreaA" name="tipologiaAmmCreaA1" id="tipologiaAmmCreaA1" value="'.$tipo.'"/>', $data);
                  }
                  else{
                    $data = str_replace('<input list="tipologiaAmmCreaC" name="tipologiaAmmCreaC1" id="tipologiaAmmCreaC1"/>','<input list="tipologiaAmmCreaC" name="tipologiaAmmCreaC1" id="tipologiaAmmCreaC1" value="'.$tipo.'"/>', $data);
                  }
                   
                   if(strlen($modello)<1){
                    $data = str_replace('<span class="erroreModCrea"></span>','<p class="errore">Devi assegnare un valore</p>', $data);
                  }else{
                    $data = str_replace('<input type="text" id="modelloCrea" name="modelloCrea" class="modello"/>',' <input type="text" id="modelloCrea" name="modelloCrea" class="modello" value="'.$modello.'"/>', $data);
                  }
                  
                  
                     
                     if((strlen($descrizione)) <25){
                      $data = str_replace('<span class="erroreDescrCrea"></span>','<p class="errore">Deve contenere più di 25 caratteri</p>', $data);
                       }else{
                        $data = str_replace('Descrivi il prodotto',$descrizione, $data);
                      }
                      
                       
                         if(!is_numeric($prezzo_vendita)){
                          $data = str_replace('<span class="errorePrezzoCrea"></span>','<p class="errore">Devi assegnare un valore numerico</p>', $data);
                           }
                           else{
                            $data = str_replace('<input type="text" name="prezzoCrea" id="prezzoCrea" class="prezzo" placeholder="€"/>','<input type="text" name="prezzoCrea" id="prezzoCrea" class="prezzo" placeholder="€" value="'.$prezzo_vendita.'"/>', $data);
                          }
                          
                           if(strlen($short_desc) <5){
                            $data = str_replace('<span class="erroreSICrea"></span>','<p class="errore">Deve contenere più di 5 caratteri</p>', $data);
                           }
                           else{
                            $data = str_replace('<input type="text" name="short_descCrea" id="DescrizioneImmagineCCrea" class="immagineC" placeholder="Descrivi brevemente l\'immagine"/>','<input type="text" name="short_descCrea" id="DescrizioneImmagineCCrea" class="immagineC" placeholder="Descrivi brevemente l\'immagine" value="'.$short_desc.'"/>', $data);
                          }

                          if(strlen($long_desc) <5){
                            $data = str_replace('<span class="erroreSICrea"></span>','<p class="errore">Deve contenere più di 5 caratteri</p>', $data);
                           }
                           else{
                            $data = str_replace('<input type="text" name="long_descCrea" id="DescrizioneImmagineCCreaLong" class="immagineC" placeholder="Descrivi in modo completo l\'immagine"/>','<input type="text" name="long_descCrea" id="DescrizioneImmagineCCreaLong" class="immagineC" placeholder="Descrivi in modo completo l\'immagine" value="'.$long_desc.'"/>', $data);
                          }
                           
                          if(strlen($produttore)<1){
                            $data =str_replace('<span class="erroreProdCrea"></span>','<p class="errore">Assegna un valore</p>', $data);
                          }
                          elseif($categoria == "accessori"){
                            $data = str_replace('<input list="produttoreAmmCreaA" name="produttoreAmmCreaA1" id="produttoreAmmCreaA1"/>','<input list="produttoreAmmCreaA" name="produttoreAmmCreaA1" id="produttoreAmmCreaA1" value="'.$produttore.'"/>', $data);
                          }
                          else{
                            $data = str_replace('<input list="produttoreAmmCreaC" name="produttoreAmmCreaC1" id="produttoreAmmCreaC1"/>','<input list="produttoreAmmCreaC" name="produttoreAmmCreaC1" id="produttoreAmmCreaC1" value="'.$produttore.'"/>', $data);
                          }
                          
                   
                        }   
                  */
$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);
   
                
              


echo $web_page;
}


?>
