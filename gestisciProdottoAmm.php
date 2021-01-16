
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

$web_page = str_replace('<breadcrumbs_to_insert/>', "Gestisci Prodotti - Amministrazione", $web_page);


$web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="GET">
    <input  id="logout" type="submit" name ="logout" value="Logout" > 
     </form> ', $web_page); 








if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$categoria = $_REQUEST['categoria'];


$contenuto='<div id="contenutoGestisci" class="contenuto">

    <form method="post" class="form" id="formMod" action="prodotti.php" >
    <fieldset>
    
    <img src="Images/logo_bianco.png" alt="" />';
  if($categoria == "accessori"){
    $contenuto.=' <input type="hidden" name="codiceProdottoMod"" value=""/>
    <label for="produttoreAmmModA">Produttore</label>
    <input list="produttoreAmmModA" name="produttoreAmmModA">
    <datalist id="produttoreAmmModA">
      <option value="Daddario">
      <option value="BOSS">
      <option value="Fender">
      <option value="ErnieBall">
    </datalist>
<label for="tipologiaAmmModA">Tipologia</label>
<input list="tipologiaAmmModA" name="tipologiaAmmModA">
<datalist id="tipologiaAmmModA">
  <option value="Corde">
  <option value="Amplificatori">
  <option value="Effetti">
  <option value="Gadget">
</datalist>';
  }else{
      
    $contenuto.='   <label for="produttoreAmmModC">Produttore</label>
    <input list="produttoreAmmModC" name="produttoreAmmModC">
    <datalist id="produttoreAmmModC">
      <option value="Epiphone">
      <option value="Gibson">
      <option value="Fender">
      <option value="Ibanez">
      <option value="Eko">
      <option value="Yamaha">
      <option value="Cort">
    </datalist>
    <label for="tipologiaAmmModC">Tipologia</label>
    <input list="tipologiaAmmModC" name="tipologiaAmmModC">
    <datalist id="tipologiaAmmModC">
      <option value="Elettrica">
      <option value="Semiacustica">
      <option value="Acustica">
      <option value="Classica">
    </datalist>
    <label for="legnoManicoMod">Legno del manico</label>
    <input list="legnoManicoMod" name="legnoManicoMod">
    <datalist id="legnoManicoMod">
      <option value="palissandro">
      <option value="mogano">
      <option value="acero">
      <option value="abete">
      <option value="ontano">
    </datalist>
    <label for="legnoCorpoMod">Legno del corpo</label>
    <input list="legnoCorpoMod" name="legnoCorpoMod">
    <datalist id="legnoCorpoMod">
      <option value="palissandro">
      <option value="acero">
      <option value="abete">
    </datalist>';
  }
    $contenuto.='<label for="DescrizioneMod">Descrizione</label>
    <textarea rows=“40" cols="40" name="DescrizioneMod" > </textarea>
    <label for="DescrizioneImmagineLMod">Descrizione lunga immagine</label>
    <textarea rows=“40" cols="40" name="long_descMod" > </textarea>
    <label for="DescrizioneImmagineCMod">Descrizione corta immagine</label>
    <input type="text" name="immagineCMod" class="immagineC" />
    <label for="prezzoMod">Prezzo</label>
    <input type="text" name="prezzoMod" class="prezzo" />
    <input type="submit" name="SalvaMod" value="Salva Prodotto" class="Salva" />
    <a href="prodotti.php" class="Annulla">Annulla</a>  
    </fieldset>
    </form>
    
</div>';
$web_page = str_replace('<contenuto_to_insert/>',$contenuto, $web_page);

echo $web_page;
}

?>
