
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
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<breadcrumbs_to_insert/>', "Gestisci Prodotti - Amministrazione", $web_page);


$web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="GET">
    <input  id="logout" type="submit" name ="logout" value="Logout" > 
     </form> ', $web_page); 

    

  
  
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
      $produttore = $_POST['produttoreAmmModA'];
      $tipo = $_POST['tipologiaAmmModA'];
      }else{
          $produttore = $_POST['produttoreAmmModC'];
          $tipo = $_POST['tipologiaAmmModC'];
          $legno_manico = $_POST['legnoManicoMod'];
          $legno_corpo = $_POST['legnoCorpoMod'];
      }
      $modello = $_POST['modelloMod'];
      $descrizione = $_POST['descrizioneMod'];
      #inserire immagine
          $short_desc = $_POST['short_descMod'];
          $prezzo_vendita = $_POST['prezzoMod'];
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
      $modificaI->modifica_prodI("Images/".$file_name, $short_desc, $id_prodotto);
      }
      header('Location: Visualizza_prodotto.php?prodotto='.$id_prodotto.'&tipo='.$categoria.'&operazione=1');
       }
      } 
$data=file_get_contents('Html/gestisciProdotto.html');
  




    if($categoria == "accessori"){

      $produttori_manage_accessori = new ManageProdotti();
      $p = $produttori_manage_accessori->get_produttori_accessori();
      $produttori_accessori="";
      foreach($p as $produttori_da_visualizzare){
        $produttori_accessori.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
   }
    $data = str_replace('<modAcc/>',' <input type="hidden" name="codiceProdottoMod"" value=""/>
    <label for="produttoreAmmModA">Produttore</label><span class="errore"> <erroreProdMod/></span>
    <input list="produttoreAmmModA" name="produttoreAmmModA" value="'.$prodotto_selezionato['produttore'].'">
    <datalist id="produttoreAmmModA">
    '.
    $produttori_accessori
    .'
    </datalist>
<label for="tipologiaAmmModA">Tipologia</label><span class="errore"> <erroreTipMod/></span>
<input list="tipologiaAmmModA" name="tipologiaAmmModA" value="'.$prodotto_selezionato['categoria'].'">
<datalist id="tipologiaAmmModA">
  <option value="Corde">
  <option value="Amplificatori">
  <option value="Effetti">
  <option value="Gadget">
</datalist>',$data);
  }else{ $produttori_manage = new ManageProdotti();
    $p = $produttori_manage->get_produttori_chitarre();
    $produttori_chitarre="";
    foreach($p as $produttori_da_visualizzare){
      $produttori_chitarre.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
    }  
    $data = str_replace('<modChit/>','   <label for="produttoreAmmModC">Produttore</label><span class="errore"> <erroreProdMod/></span>
    <input list="produttoreAmmModC" name="produttoreAmmModC" value="'.$prodotto_selezionato['produttore'].'">
    <datalist id="produttoreAmmModC" >
    '.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmModC">Tipologia</label><span class="errore"> <erroreTipMod/></span>
    <input list="tipologiaAmmModC" name="tipologiaAmmModC" value="'.$prodotto_selezionato['tipo_chitarra'].'">
    <datalist id="tipologiaAmmModC">
      <option value="Elettrica">
      <option value="Semiacustica">
      <option value="Acustica">
      <option value="Classica">
    </datalist>
    <label for="legnoManicoMod">Legno del manico</label><span class="errore"> <erroreLMMod/></span>
    <input type="text" name="legnoManicoMod" class="legnoManico" value="'.$prodotto_selezionato['legno_manico'].'">
    <label for="legnoCorpoMod">Legno del corpo</label><span class="errore"> <erroreLCMod/></span>
    <input type="text" name="legnoCorpoMod" class="legnoCorpo" value="'.$prodotto_selezionato['legno_corpo'].'">
    ', $data);
  }


  if(isset($_REQUEST['SalvaMod'])){
    if(strlen($legno_manico)<1){
      $data = str_replace('<erroreLMMod/>','Devi assegnare un valore', $data);
       }
       else{
        $data = str_replace('valueLMMod','value="'.$legno_manico.'"', $data);
       }
       if(strlen($legno_corpo)<1){
        $data= str_replace('<erroreLCMod/>','Devi assegnare un valore', $data);
         }
         else{
          $data = str_replace('valueLCMod','value="'.$legno_corpo.'"', $data);
         }
         if(strlen($tipo)<1){
          $data = str_replace('<erroreTipMod/>','Assegna un valore', $data);
           }
           else{
            $data = str_replace('valueTipMod','value="'.$tipo.'"', $data);
           }
           if(strlen($modello)<1){
            $data = str_replace('<erroreModMod/>','Devi assegnare un valore', $data);
          }
          else{
            $data = str_replace('modelloV','value="'.$modello.'"', $data);
          }
          
             
             if((strlen($descrizione)) <25){
              $data = str_replace('<erroreDescrMod/>','Deve contenere più di 25 caratteri', $data);
               }
               else{
                $data = str_replace('Descrivi il prodotto',$descrizione, $data);
              }
               
                 if(!is_numeric($prezzo_vendita)){
                  $data = str_replace('<errorePrezzoMod/>','Devi assegnare un valore numerico', $data);
                   }
                   else{
                    $data = str_replace('prezzoV','value="'.$prezzo_vendita.'"', $data);
                  }
                   if(strlen($short_desc) <5){
                    $data = str_replace('<erroreDIMod/>','Deve contenere più di 5 caratteri', $data);
                   }
                   else{
                    $data = str_replace('descrCV','value="'.$short_desc.'"', $data);
                  }
                  if(strlen($produttore)<1){
                    $data =str_replace('<erroreProdMod/>','Assegna un valore', $data);
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
