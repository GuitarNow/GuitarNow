
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

$web_page = str_replace('<title_page/>', "Gestisci Prodotti Amministrazione", $web_page);
$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteP', 'id="linkCorrente"', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteC', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<breadcrumbs_to_insert/>', "Gestisci Prodotti - Amministrazione", $web_page);


$web_page = str_replace('<gestioneAccesso/>', '<a href="Logout.php" id="logout">Logout</a>', $web_page);  

    

  
  
     if (!isset($_REQUEST['categoria'])) {
      $_REQUEST['categoria']="chitarre";
  }
  
  $categoria = $_REQUEST['categoria'];


/*------------------QUERY------------------------------*/

$id_prodotto = $_GET['prodotto'];

$manage_prodotto=new ManageProdotti();


$prodotto_selezionato='';
if($categoria=='chitarre')
{
	$prodotto_selezionato= $manage_prodotto->get_specifiche_chitarre($id_prodotto);	
	
}
else
{
	$prodotto_selezionato= $manage_prodotto->get_specifiche_accessori($id_prodotto);	
}


if(isset($_REQUEST['SalvaMod'])){

  if($categoria == "accessori"){
      $produttore = $_POST['produttoreAmmModA1'];
      $tipo = $_POST['tipologiaAmmModA1'];
      }else{
          $produttore = $_POST['produttoreAmmModC1'];
          $tipo = $_POST['tipologiaAmmModC1'];
          $legno_manico = $_POST['legnoManicoMod'];
          $legno_corpo = $_POST['legnoCorpoMod'];
      }
      $modello = $_POST['modelloMod'];
      $descrizione = $_POST['descrizioneMod'];
      #inserire immagine
          $short_desc = $_POST['short_descMod'];
          $prezzo_vendita = $_POST['prezzoMod'];
          if($categoria == "accessori"){
            if(strlen($modello) !=0 && strlen($produttore) != 0 && strlen($descrizione)> 25 && is_numeric($prezzo_vendita) && strlen($tipo)!=0 && strlen($short_desc)>5) {      
              $modificaP = new ManageProdotti();
              $modificaP->modifica_prodP($modello, $produttore, $descrizione, $prezzo_vendita, $id_prodotto);
              if($categoria == "chitarre"){
              $modificaC = new ManageProdotti();
              $modificaC->modifica_prodC($tipo, $legno_manico, $legno_corpo, $id_prodotto);
              }
              if($categoria == "accessori"){
              $modificaA = new ManageProdotti();
              $modificaA->modifica_prodA($tipo, $id_prodotto);
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
                   echo "Success";
                }else{
                   print_r($errors);
                }
        
                $modificaI = new ManageProdotti();
                if($file_size == 0) {
                  $modificaI->modifica_prodI($prodotto_selezionato['path'], $prodotto_selezionato['short_desc'], $id_prodotto);
                }else{
                  $modificaI->modifica_prodI("Images/".$file_name, $short_desc, $id_prodotto);
                }
              }
              header('Location: Visualizza_prodotto.php?prodotto='.$id_prodotto.'&tipo='.$categoria.'&operazione=1');
               }

          }
          else{

          if (strlen($modello) !=0 && strlen($produttore) != 0 && strlen($descrizione)> 25 && is_numeric($prezzo_vendita) && strlen($tipo)!=0 && strlen($short_desc)>5 && strlen($legno_manico)!=0 && strlen($legno_corpo)!=0) {      
      $modificaP = new ManageProdotti();
      $modificaP->modifica_prodP($modello, $produttore, $descrizione, $prezzo_vendita, $id_prodotto);
      if($categoria == "chitarre"){
      $modificaC = new ManageProdotti();
      $modificaC->modifica_prodC($tipo, $legno_manico, $legno_corpo, $id_prodotto);
      }
      if($categoria == "accessori"){
      $modificaA = new ManageProdotti();
      $modificaA->modifica_prodA($tipo, $id_prodotto);
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
           echo "Success";
        }else{
           print_r($errors);
        }

        $modificaI = new ManageProdotti();
        if($file_size == 0) {
          $modificaI->modifica_prodI($prodotto_selezionato['path'], $prodotto_selezionato['short_desc'], $id_prodotto);
        }else{
          $modificaI->modifica_prodI("Images/".$file_name, $short_desc, $id_prodotto);
        }
      }
      header('Location: Visualizza_prodotto.php?prodotto='.$id_prodotto.'&tipo='.$categoria.'&operazione=1');
       }
      }
      } 
$data=file_get_contents('Html/gestisciProdotto.html');
  




    if($categoria == "accessori"){

      $produttori_manage_accessori = new ManageProdotti();
      $tipi_accessori = new ManageProdotti();
      $t = $tipi_accessori->get_tipo_accessori();
      $p = $produttori_manage_accessori->get_produttori_accessori();
      $produttori_accessori="";
      $tipi_accessori="";
      foreach($p as $produttori_da_visualizzare){
        $produttori_accessori.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
   }
   foreach($t as $tipi_da_visualizzare){
    $tipi_accessori.= '<option value="'.$tipi_da_visualizzare['tipo'].'">';
  }
    $data = str_replace('<span class="ModAcc"></span>',' <input type="hidden" name="codiceProdottoMod"" value=""/>
    <label for="produttoreAmmModA1">Produttore</label><span class="erroreProdMod"></span>
    <input list="produttoreAmmModA" id="produttoreAmmModA1" name="produttoreAmmModA1" value="'.$prodotto_selezionato['produttore'].'"/>
    <datalist id="produttoreAmmModA">
    '.
    $produttori_accessori
    .'
    </datalist>
<label for="tipologiaAmmModA1">Tipologia</label><span class="erroreTipMod"></span>
<input list="tipologiaAmmModA" name="tipologiaAmmModA1" id="tipologiaAmmModA1" value="'.$prodotto_selezionato['categoria'].'"/>
<datalist id="tipologiaAmmModA">'.
$tipi_accessori
.' 
</datalist>',$data);
  }else{ 
    $tipi_chitarre = new ManageProdotti();
    $t = $tipi_chitarre->get_tipo_chitarre();
    $produttori_manage = new ManageProdotti();
    $p = $produttori_manage->get_produttori_chitarre();
    $produttori_chitarre="";
    $tipi_chitarra="";
    foreach($p as $produttori_da_visualizzare){
      $produttori_chitarre.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
    }  
    foreach($t as $tipi_da_visualizzare){
      $tipi_chitarra.= '<option value="'.$tipi_da_visualizzare['tipo'].'">';
    }

    $data = str_replace('<span class="ModChit"></span>','   <label for="produttoreAmmModC1">Produttore</label><span class="erroreProdMod"></span>
    <input list="produttoreAmmModC" id="produttoreAmmModC1" name="produttoreAmmModC1" value="'.$prodotto_selezionato['produttore'].'"/>
    <datalist id="produttoreAmmModC" >
    '.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmModC1">Tipologia</label><span class="erroreTipMod"></span>
    <input list="tipologiaAmmModC" id="tipologiaAmmModC1" name="tipologiaAmmModC1" value="'.$prodotto_selezionato['tipo_chitarra'].'"/>
    <datalist id="tipologiaAmmModC">'.
    $tipi_chitarra
    .'
    </datalist>
    <label for="legnoManicoMod">Legno del manico</label><span class="erroreLMMod"></span>
    <input type="text" id="legnoManicoMod" name="legnoManicoMod" class="legnoManico" value="'.$prodotto_selezionato['legno_manico'].'"/>
    <label for="legnoCorpoMod">Legno del corpo</label><span class="erroreLCMod"></span>
    <input type="text" name="legnoCorpoMod" id="legnoCorpoMod" class="legnoCorpo" value="'.$prodotto_selezionato['legno_corpo'].'"/>
    ', $data);
  }


  if(isset($_REQUEST['SalvaMod'])){
    if($categoria != "accessori"){
    if(strlen($legno_manico)<1){
      $data = str_replace('<span class="erroreLMMod"></span>','<p class="errore">Devi assegnare un valore</p>', $data);
       }
       else{
        $data = str_replace('valueLMMod','value="'.$legno_manico.'"', $data);
       }
       if(strlen($legno_corpo)<1){
        $data= str_replace('<erroreLCMod/>','<p class="errore">Devi assegnare un valore</p>', $data);
         }
         else{
          $data = str_replace('valueLCMod','value="'.$legno_corpo.'"', $data);
         }
        }
         if(strlen($tipo)<1){
          $data = str_replace('<span class="erroreTipMod"></span>','<p class="errore">Assegna un valore</p>', $data);
           }
           else{
            $data = str_replace('valueTipMod','value="'.$tipo.'"', $data);
           }
           if(strlen($modello)<1){
            $data = str_replace('<span class="erroreMod"></span>','<p class="errore">Devi assegnare un valore</p>', $data);
          }
          else{
            $data = str_replace('modelloV','value="'.$modello.'"', $data);
          }
          
             
             if((strlen($descrizione)) <25){
              $data = str_replace('<span class="erroreDescrMod"></span>','<p class="errore">Deve contenere più di 25 caratteri</p>', $data);
               }
               else{
                $data = str_replace('Descrivi il prodotto',$descrizione, $data);
              }
               
                 if(!is_numeric($prezzo_vendita)){
                  $data = str_replace('<span class="errorePrezzoMod"></span>','<p class="errore">Devi assegnare un valore numerico</p>', $data);
                   }
                   else{
                    $data = str_replace('prezzoV','value="'.$prezzo_vendita.'"', $data);
                  }
                   if(strlen($short_desc) <5){
                    $data = str_replace('<span class="erroreDIMod"></span>','<p class="errore">Deve contenere più di 5 caratteri</p>', $data);
                   }
                   else{
                    $data = str_replace('descrCV','value="'.$short_desc.'"', $data);
                  }
                  if(strlen($produttore)<1){
                    $data =str_replace('<span class="erroreProdMod"></span>','<p class="errore">Assegna un valore</p>', $data);
                  }
                  else{
                    $data = str_replace('valueProdMod','value="'.$produttore.'"', $data);
                   }
  }



$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);

$web_page = str_replace('prezzoV','value="'.$prodotto_selezionato['prezzo'].'"', $web_page);
$web_page = str_replace('descrCV','value="'.$prodotto_selezionato['short_desc'].'"', $web_page);
$web_page = str_replace('Descrivi il prodotto',$prodotto_selezionato['descrizione'], $web_page);
$web_page = str_replace('modelloV','value="'.$prodotto_selezionato['modello'].'"', $web_page);
$web_page = str_replace('catModF',$categoria, $web_page);
$web_page = str_replace('proModF',$id_prodotto, $web_page);

echo $web_page;

}

?>
