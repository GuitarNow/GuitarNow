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
    # $ = $_POST['']; #inserire immagine
        $long_desc = $_POST['long_descCrea'];
        $short_desc = $_POST['short_descCrea'];
        $prezzo_vendita = $_POST['prezzoCrea'];

    $creazione = new ManageProdotti();
   $creazione->crea_prodotto($modello, $produttore, $descrizione, $prezzo_vendita);
    
    }
    



$contenuto='<div id="contenutoCrea" class="contenuto">

    <form method="POST" class="form" id="formCrea" action="creaProdottoAmm.php" >    
    <fieldset>
    <img src="Images/logo_bianco.png" alt="" />';
  if($categoria == "accessori"){
    $contenuto.='
    <input type="hidden" name="codiceProdottoCrea"" value=""/>
    <label for="produttoreAmmCreaA">Produttore</label>
    <select name="produttoreAmmCreaA" class="produttoreAmm">
    <option>Daddario</option>
    <option>BOSS/option>
    <option>Fender</option>
    <option>ErnieBall</option>
</select>
<label for="tipologiaAmmCreaA">Tipologia</label>
<select name="tipologiaAmmCreaA" class="tipologiaAmm">
<option>Corde</option>
<option>Amplificatori</option>
 <option>Effetti</option>
 <option>Gadget</option>
</select>';
  }else{
      
    $contenuto.='
    <input list="browsers" name="browser">
<datalist id="browsers">
  <option value="Internet Explorer">
  <option value="Firefox">
  <option value="Chrome">
  <option value="Opera">
  <option value="Safari">
 
</datalist>
    <label for="produttoreAmmCreaC">Produttore</label>
    <select name="produttoreAmmCreaC" class="produttoreAmm">
            <option>Epiphone</option>
            <option>Gibson</option>
            <option>Fender</option>
            <option>Ibanez</option>
            <option>Eko</option>
            <option>Yamaha</option>
            <option>Cort</option>
     </select>
    <label for="tipologiaAmmCreaC">Tipologia</label>
    <select name="tipologiaAmmCreaC" class="tipologiaAmm">
        <option>Elettrica</option>
        <option>Semiacustica</option>
         <option>Acustica</option>
         <option>Classica</option>
    </select>
    <label for="legnoManicoCrea">Legno del manico</label>
    <select name="legnoManicoCrea" class="legnoManico">
        <option>palissandro</option>
        <option>mogano</option>
         <option>acero</option>
         <option>abete</option>
         <option>ontano</option>
    </select>
    <label for="legnoCorpoCrea">Legno del corpo</label>
    <select name="legnoCorpoCrea" class="legnoCorpo">
    <option>palissandro</option>
     <option>acero</option>
     <option>abete</option>
    </select>';
  }
    $contenuto.='<label for="modelloCrea">Modello</label>
    <input type="text" name="modelloCrea" class="modello"  />

    <label for="descrizioneCrea">Descrizione</label>
    <textarea rows=“40" cols="40" name="descrizioneCrea" > </textarea>
    <label for="immagineCrea">Importa immagine</label>
    <input type="file" name="file" enctype= “multipart/form-data” id="file"/>
    <label for="DescrizioneImmagineLCrea">Descrizione lunga immagine</label>
    <textarea rows=“40" cols="40" name="long_descCrea" > </textarea>
    <label for="DescrizioneImmagineCCrea">Descrizione corta immagine</label>
    <input type="text" name="short_descCrea" class="immagineC" placeholder="rappresentazione della chitarra acustica fender" />
    <label for="prezzoCrea">Prezzo</label>
    <input type="text" name="prezzoCrea" class="prezzo" placeholder="€" value="" />
    <input type="submit" name="SalvaCrea" value="Crea Prodotto" class="Salva" />   
    <a href="prodotti.php" class="Annulla">Annulla</a>
    </fieldset>
    </form>
</div>';
$web_page = str_replace('<contenuto_to_insert/>',$contenuto, $web_page);
   

echo $web_page;
}


?>
