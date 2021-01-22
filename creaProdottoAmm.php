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
    
        $short_desc = $_POST['short_descCrea'];
        $prezzo_vendita = $_POST['prezzoCrea'];

        if (($modello) !=0 && ($produttore) != 0 && ($descrizione)> 5 && is_numeric($prezzo_vendita)) {
    $creazioneP = new ManageProdotti();
   $creazioneP->crea_chitP($modello, $produttore, $descrizione, $prezzo_vendita);
       }
        else{
         $data = str_replace('<errore/>','Devi assegnare un valore', $data);
        }
   $creazioneC = new ManageProdotti();
   $creazioneC->crea_chitC($tipo, $legno_manico, $legno_corpo);


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
    
    }
    

    
  if($categoria == "accessori"){

    $produttori_manage_accessori = new ManageProdotti();
    $p = $produttori_manage_accessori->get_produttori_accessori();
    $produttori_accessori="";
    foreach($p as $produttori_da_visualizzare){
      $produttori_accessori.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
 }

    $data = str_replace('<creaAcc/>','
    <input type="hidden" name="codiceProdottoCrea"" value=""/>
    <label for="produttoreAmmCreaA">Produttore</label><span class="errore"> *<erroreProdCrea/></span>
    <input list="produttoreAmmCreaA" name="produttoreAmmCreaA">
    <datalist id="produttoreAmmCreaA">'.
    $produttori_accessori
    .'
   
    </datalist>
<label for="tipologiaAmmCreaA">Tipologia</label> <span class="errore"> *<erroreTipCrea/></span>
<input list="tipologiaAmmCreaA" name="tipologiaAmmCreaA">
<datalist id="tipologiaAmmCreaA">
  <option value="Corde">
  <option value="Amplificatori">
  <option value="Effetti">
  <option value="Gadget">
</datalist>', $data);
  }else{
    $produttori_manage = new ManageProdotti();
    $p = $produttori_manage->get_produttori_chitarre();
    $produttori_chitarre="";
    foreach($p as $produttori_da_visualizzare){
      $produttori_chitarre.= '<option value="'.$produttori_da_visualizzare['produttore'].'">';
 }

    $data = str_replace('<creaChit/>','

    <label for="produttoreAmmCreaC">Produttore</label><span class="errore"> *<erroreModCrea/></span>
    <input list="produttoreAmmCreaC" name="produttoreAmmCreaC_name">
    <datalist id="produttoreAmmCreaC">'.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmCreaC">Tipologia</label><span class="errore"> *<erroreTipCrea/></span>
    <input list="tipologiaAmmCreaC" name="tipologiaAmmCreaC">
    <datalist id="tipologiaAmmCreaC">
      <option value="Elettrica">
      <option value="Semiacustica">
      <option value="Acustica">
      <option value="Classica">
    </datalist>
    <label for="legnoManicoCrea">Legno del manico</label><span class="errore"> *<erroreLMCrea/></span>
    <input type="text" name="legnoManicoCrea" class="legnoManico">
    <label for="legnoCorpoCrea">Legno del corpo</label><span class="errore"> *<erroreLCCrea/></span>
    <input type="text" name="legnoCorpoCrea" class="legnoCorpo">', $data);
   
  }
$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);
   

echo $web_page;
}


?>
