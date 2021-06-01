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
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<breadcrumbs_to_insert/>', "Crea Prodotto - Amministrazione", $web_page);

$web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="POST">
    <input  id="logout" type="submit" name ="logout" value="Logout" > 
     </form> ', $web_page); 

if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$categoria = $_REQUEST['categoria'];
error_reporting(0);

$data=file_get_contents('Html/creaProdotto.html');
$data = str_replace('<tip/>',$categoria, $data);
if(isset($_REQUEST['SalvaCrea'])){

if($categoria == "accessori"){
    $produttore = $_POST['produttoreAmmCreaA'];
    $tipo = $_POST['tipologiaAmmCreaA'];
    }else{
        $produttore = $_POST['produttoreAmmCreaC_name'];
        $tipo = $_POST['tipologiaAmmCreaC'];
        $legno_manico = $_POST['legnoManicoCrea'];
        $legno_corpo = $_POST['legnoCorpoCrea'];
    }
    $modello = $_POST['modelloCrea'];
    $descrizione = $_POST['descrizioneCrea'];
    
    $descrizione=str_replace('/en','<span lang="eng">',$descrizione);
    $descrizione=str_replace('en/','</span>',$descrizione);
    
        $short_desc = $_POST['short_descCrea'];
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
    $creazioneI->crea_chitI("Images/".$file_name, $short_desc);
 }

  if(isset($_REQUEST['SalvaCrea']))
  {
    $data = str_replace('<inserimento_eseguito/>','<p class="operazione_confermata">Prodotto inserito correttamente</p>', $data);
  }
  else{
    $data = str_replace('<inserimento_eseguito/>','', $data);

  }
  
}
else{
if(strlen($modello)<1){
  $data = str_replace('<erroreModCrea/>','Devi assegnare un valore', $data);
}
else{
  $data = str_replace('valueModCrea','value="'.$modello.'"', $data);
}

   
     
       if(!is_numeric($prezzo_vendita)){
        $data = str_replace('<errorePrezzoCrea/>','Devi assegnare un valore numerico', $data);
         }
         else{
          $data = str_replace('valuePrezzoCrea','value="'.$prezzo_vendita.'"', $data);
        }
         if(strlen($short_desc) <5){
          $data = str_replace('<erroreSICrea/>','Deve contenere più di 5 caratteri', $data);
         }
         else{
          $data = str_replace('valueImmCCrea','value="'.$short_desc.'"', $data);
        }
 
      }   
}
    
    
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

    $data = str_replace('<creaAcc/>','
    <input type="hidden" name="codiceProdottoCrea"" value=""/>
    <label for="produttoreAmmCreaA">Produttore</label><span class="errore"> <erroreProdCrea/></span>
    <input list="produttoreAmmCreaA" name="produttoreAmmCreaA" valueProdCrea> 
    <datalist id="produttoreAmmCreaA">'.
    $produttori_accessori
    .'
    
    </datalist>
<label for="tipologiaAmmCreaA">Tipologia</label> <span class="errore"> <erroreTipCrea/></span>
<input list="tipologiaAmmCreaA" name="tipologiaAmmCreaA" valueTipCrea>
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

    $data = str_replace('<creaChit/>','

    <label for="produttoreAmmCreaC">Produttore</label><span class="errore"> <erroreProdCrea/></span>
    <input list="produttoreAmmCreaC" name="produttoreAmmCreaC_name" valueProdCrea>
    <datalist id="produttoreAmmCreaC">'.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmCreaC">Tipologia</label><span class="errore"> <erroreTipCrea/></span>
    <input list="tipologiaAmmCreaC" name="tipologiaAmmCreaC" valueTipCrea>
    <datalist id="tipologiaAmmCreaC">'.
    $tipi_chitarra 
    .'
    </datalist>
    <label for="legnoManicoCrea">Legno del manico</label><span class="errore"> <erroreLMCrea/></span>
    <input type="text" name="legnoManicoCrea" class="legnoManico" valueLMCrea>
    <label for="legnoCorpoCrea">Legno del corpo</label><span class="errore"> <erroreLCCrea/></span>
    <input type="text" name="legnoCorpoCrea" class="legnoCorpo" valueLCCrea>', $data);
   
  }
  if(isset($_REQUEST['SalvaCrea'])){
 
             if(strlen($legno_manico)<1){
              $data = str_replace('<erroreLMCrea/>','Devi assegnare un valore', $data);
               }
               else{
                $data = str_replace('valueLMCrea','value="'.$legno_manico.'"', $data);
               }
               if(strlen($legno_corpo)<1){
                $data= str_replace('<erroreLCCrea/>','Devi assegnare un valore', $data);
                 }
                 else{
                  $data = str_replace('valueLCCrea','value="'.$legno_corpo.'"', $data);
                 }
                 if(strlen($tipo)<1){
                  $data = str_replace('<erroreTipCrea/>','Assegna un valore', $data);
                   }
                   else{
                    $data = str_replace('valueTipCrea','value="'.$tipo.'"', $data);
                   }
                   if(strlen($modello)<1){
                    $data = str_replace('<erroreModCrea/>','Devi assegnare un valore', $data);
                  }
                  else{
                    $data = str_replace('valueModCrea','value="'.$modello.'"', $data);
                  }
                  
                     
                     if((strlen($descrizione)) <25){
                      $data = str_replace('<erroreDescrCrea/>','Deve contenere più di 25 caratteri', $data);
                       }
                       else{
                        $data = str_replace('Descrivi il prodotto',$descrizione, $data);
                      }
                       
                         if(!is_numeric($prezzo_vendita)){
                          $data = str_replace('<errorePrezzoCrea/>','Devi assegnare un valore numerico', $data);
                           }
                           else{
                            $data = str_replace('valuePrezzoCrea','value="'.$prezzo_vendita.'"', $data);
                          }
                           if(strlen($short_desc) <5){
                            $data = str_replace('<erroreSICrea/>','Deve contenere più di 5 caratteri', $data);
                           }
                           else{
                            $data = str_replace('valueImmCCrea','value="'.$short_desc.'"', $data);
                          }
                          if(strlen($produttore)<1){
                            $data =str_replace('<erroreProdCrea/>','Assegna un valore', $data);
                          }
                          else{
                            $data = str_replace('valueProdCrea','value="'.$produttore.'"', $data);
                           }
                   
                        }   
                  
$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);
   
                
              


echo $web_page;
}


?>
