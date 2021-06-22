<?php

include('PHP/back/Session.php');
require_once("PHP/back/ManageProdotti.php");
require_once("PHP/back/Function.php");

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




if(isset($_REQUEST['SalvaCrea'])){

  $produttore  =  quota($_POST['produttoreAmmCrea']);
  $tipo =         quota($_POST['tipologiaAmmCrea']);
  $modello =      quota($_POST['modelloCrea']);
  $descrizione =  $_POST['descrizioneCrea'];
  
  $descrizione=str_replace('{en}','<span lang="en" >',$descrizione);
  $descrizione=str_replace('{/en}',' </span>',$descrizione);
  $descrizione =  quota($descrizione);
  $short_desc = quota($_POST['short_descCrea']);
  $long_desc = quota($_POST['long_descCrea']);
  $prezzo_vendita = $_POST['prezzoCrea'];


  $creazioneP = new ManageProdotti();
  $creazioneP->crea_chitP($modello, $produttore, $descrizione, $prezzo_vendita);

  if($categoria == "accessori"){
    $creazioneA = new ManageProdotti();
    $creazioneA->crea_chitA($tipo);
  }

  if($categoria == "chitarre"){
        $legno_manico = quota($_POST['legnoManicoCrea']);
        $legno_corpo =  quota($_POST['legnoCorpoCrea']);
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
 
    move_uploaded_file($file_tmp,"Images/".$file_name);

    $creazioneI = new ManageProdotti();
    $creazioneI->crea_chitI("Images/".quota($file_name), $short_desc,$long_desc);


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
    <span><input list="produttoreAmmCreaA" name="produttoreAmmCrea" id="produttoreAmmCrea"/></span>
    <datalist id="produttoreAmmCreaA">'.
    $produttori_accessori
    .'
    
    </datalist>
<label for="tipologiaAmmCrea">Tipologia</label> <span class="erroreTipCrea"></span>
<span><input list="tipologiaAmmCreaA" name="tipologiaAmmCrea" id="tipologiaAmmCrea"/></span>
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
    <span><input list="produttoreAmmCreaC" name="produttoreAmmCrea" id="produttoreAmmCrea"/></span>
    <datalist id="produttoreAmmCreaC">'.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmCrea">Tipologia</label><span class="erroreTipCrea"></span>
    <span><input list="tipologiaAmmCreaC" name="tipologiaAmmCrea" id="tipologiaAmmCrea"/></span>
    <datalist id="tipologiaAmmCreaC">'.
    $tipi_chitarra 
    .'
    </datalist>
    <label for="legnoManicoCrea">Legno del manico</label>
    <span><input type="text" name="legnoManicoCrea" id="legnoManicoCrea" class="legnoManico"/></span>
    <label for="legnoCorpoCrea">Legno del corpo</label>
    <span><input type="text" name="legnoCorpoCrea" id="legnoCorpoCrea" class="legnoCorpo"/></span>', $data);
   
  }
 
$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);
   
                
              


echo $web_page;
}


?>
