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

if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$tipologia_ricevuta = null;
$produttore = null;
$prezzo = null;
$cercato= false;
if (isset($_REQUEST['cercato'])) {
    $cercato=true;
    $_REQUEST['categoria']= $_REQUEST['cercato'];

if (isset($_REQUEST['tipologia'])) {
    $tipologia_ricevuta = $_REQUEST['tipologia'];
    
}

if (isset($_REQUEST['produttore'])) {
    $produttore = $_REQUEST['produttore'];
}


if (isset($_REQUEST['prezzo'])) {
    $prezzo = $_REQUEST['prezzo'];

}


}

$categoria = $_REQUEST['categoria'];


$contenuto='<div id="contenutoRegistrati" class="contenuto">

    <form method="post" class="form" id="formCrea" action="creaProdottoAmm.php" >
    <fieldset>
    
    <img src="Images/logo_bianco.png" alt="" />
    <label for="produttore">Produttore</label>';
  if($categoria == "accessori"){
    $contenuto.='<select name="produttoreAmm" class="produttoreAmm">
    <option>Daddario</option>
    <option>BOSS/option>
    <option>Fender</option>
    <option>ErnieBall</option>
</select>
<label for="tipologia">Tipologia</label>
<select name="tipologiaAmm" class="tipologiaAmm">
<option>Corde</option>
<option>Amplificatori</option>
 <option>Effetti</option>
 <option>Gadget</option>
</select>';
  }else{
      
    $contenuto.='<select name="produttoreAmm" class="produttoreAmm">
            <option>Epiphone</option>
            <option>Gibson</option>
            <option>Fender</option>
            <option>Ibanez</option>
            <option>Eko</option>
            <option>Yamaha</option>
            <option>Cort</option>
     </select>
    <label for="tipologia">Tipologia</label>
    <select name="tipologiaAmm" class="tipologiaAmm">
        <option>Elettrica</option>
        <option>Semiacustica</option>
         <option>Acustica</option>
         <option>Classica</option>
    </select>
    <label for="legnoManico">Legno del manico</label>
    <select name="legnoManico" class="legnoManico">
        <option>palissandro</option>
        <option>mogano</option>
         <option>acero</option>
         <option>abete</option>
         <option>ontano</option>
    </select>
    <label for="legnoCorpo">Legno del corpo</label>
    <select name="legnoCorpo" class="legnoCorpo">
    <option>palissandro</option>
     <option>acero</option>
     <option>abete</option>
    </select>';
  }
    $contenuto.='<label for="modello">Modello</label>
    <input type="text" name="modello" class="modello"  />
    <label for="Descrizione">Descrizione</label>
    <textarea rows=“40" cols="40" name="descrizione" > </textarea>
    <label for="immagine">Importa immagine</label>
    <input type="file" name="file" enctype= “multipart/form-data” id="file"/>
    <label for="DescrizioneImmagineL">Descrizione lunga immagine</label>
    <textarea rows=“40" cols="40" name="long_desc" > </textarea>
    <label for="DescrizioneImmagineC">Descrizione corta immagine</label>
    <input type="text" name="short_desc" class="immagineC" placeholder="rappresentazione della chitarra acustica fender" />
    <label for="prezzo">Prezzo</label>
    <input type="text" name="prezzo" class="prezzo" value="€" />
    <input type="submit" name="Salva" value="Crea Prodotto" class="Salva" />
    <input type="submit" name="Annulla" value="Annulla" class="Annulla"  />  
    </fieldset>
    </form>
    
</div>';
$web_page = str_replace('<contenuto_to_insert/>',$contenuto, $web_page);


    
     
if($categoria == "accessori"){
    if(isset($_POST['Salva'])){
        $produttoreAmm = $_POST['produttoreAmm'];
    $tipologia = $_POST['tipologiaAmm'];
    }else{
        $produttoreAmm = $_POST['produttoreAmm'];
        $tipo_chitarra = $_POST['tipologiaAmm'];
        $legno_manico = $_POST['legnoManico'];
        $legno_corpo = $_POST['legnoCorpo'];
    }
    $descrizione = $_POST['descrizione'];
    # $ = $_POST['']; #inserire immagine
        $long_desc = $_POST['long_desc'];
        $short_desc = $_POST['short_desc'];
        $prezzo_vendita = $_POST['prezzo'];

    $creazione = new ManageProdotti();
    $creazione->crea_prodotto($produttoreAmm, $tipologia, $descrizione, $prezzo_vendita);

    }
    


    

echo $web_page;
}


?>
