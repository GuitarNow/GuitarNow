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

$web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="GET">
    <input  id="logout" type="submit" name ="logout" value="Logout" > 
     </form> ', $web_page); 

if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$tipologia_ricevuta = null;
$produttore = null;
$prezzo = null;
$cercato= false;

$categoria = $_REQUEST['categoria'];



if(isset($_REQUEST['SalvaCrea'])){

if($categoria == "accessori"){
    $produttore = $_POST['produttoreAmmCreaA'];
    $tipo = $_POST['tipologiaAmmCreaA'];
    }else{
        $produttore = $_POST['produttoreAmmCreaC'];
        $tipo = $_POST['tipologiaAmmCreaC'];
        $legno_manico = $_POST['legnoManicoCrea'];
        $legno_corpo = $_POST['legnoCorpoCrea'];
    }
    $modello = $_POST['modelloCrea'];
    $descrizione = $_POST['descrizioneCrea'];
    $immagine = $_POST['fileCrea']; #inserire immagine
        $long_desc = $_POST['long_descCrea'];
        $short_desc = $_POST['short_descCrea'];
        $prezzo_vendita = $_POST['prezzoCrea'];

    $creazione = new ManageProdotti();
   $creazione->crea_chitP($modello, $produttore, $descrizione, $prezzo_vendita);
   $creazione->crea_chitC($tipo, $legno_manico, $legno_corpo);
   $creazione->crea_chitI($immagine, $short_desc, $long_desc);
    
    }
    

    $data=file_get_contents('Html/creaProdotto.html');
  if($categoria == "accessori"){
    $data = str_replace('<creaAcc/>','
    <input type="hidden" name="codiceProdottoCrea"" value=""/>
    <label for="produttoreAmmCreaA">Produttore</label>
    <input list="produttoreAmmCreaA" name="produttoreAmmCreaA">
    <datalist id="produttoreAmmCreaA">
      <option value="Daddario">
      <option value="BOSS">
      <option value="Fender">
      <option value="ErnieBall">
    </datalist>
<label for="tipologiaAmmCreaA">Tipologia</label>
<input list="tipologiaAmmCreaA" name="tipologiaAmmCreaA">
<datalist id="tipologiaAmmCreaA">
  <option value="Corde">
  <option value="Amplificatori">
  <option value="Effetti">
  <option value="Gadget">
</datalist>', $data);
  }else{
      
    $data = str_replace('<creaChit/>','

    <label for="produttoreAmmCreaC">Produttore</label>
    <input list="produttoreAmmCreaC" name="produttoreAmmCreaC">
    <datalist id="produttoreAmmCreaC">
      <option value="Epiphone">
      <option value="Gibson">
      <option value="Fender">
      <option value="Ibanez">
      <option value="Eko">
      <option value="Yamaha">
      <option value="Cort">
    </datalist>
    <label for="tipologiaAmmCreaC">Tipologia</label>
    <input list="tipologiaAmmCreaC" name="tipologiaAmmCreaC">
    <datalist id="tipologiaAmmCreaC">
      <option value="Elettrica">
      <option value="Semiacustica">
      <option value="Acustica">
      <option value="Classica">
    </datalist>
    <label for="legnoManicoCrea">Legno del manico</label>
    <input list="legnoManicoCrea" name="legnoManicoCrea">
    <datalist id="legnoManicoCrea">
      <option value="palissandro">
      <option value="mogano">
      <option value="acero">
      <option value="abete">
      <option value="ontano">
    </datalist>
    <label for="legnoCorpoCrea">Legno del corpo</label>
    <input list="legnoCorpoCrea" name="legnoCorpoCrea">
    <datalist id="legnoCorpoCrea">
      <option value="palissandro">
      <option value="acero">
      <option value="abete">
    </datalist>', $data);
   
  }
$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);
   

echo $web_page;
}


?>
