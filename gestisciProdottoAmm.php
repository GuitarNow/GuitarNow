
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
    
    <img src="Images/logo_bianco.png" alt="" />
    <label for="produttoreAmmMod">Produttore</label>';
  if($categoria == "accessori"){
    $contenuto.='<select name="produttoreAmmMod" class="produttoreAmm">
    <option>Daddario</option>
    <option>BOSS/option>
    <option>Fender</option>
    <option>ErnieBall</option>
</select>
<label for="tipologiaAmmMod">Tipologia</label>
<select name="tipologiaAmmMod" class="tipologiaAmm">
<option>Corde</option>
<option>Amplificatori</option>
 <option>Effetti</option>
 <option>Gadget</option>
</select>';
  }else{
      
    $contenuto.='<select name="produttoreAmmMod" class="produttoreAmm">
            <option>Epiphone</option>
            <option>Gibson</option>
            <option>Fender</option>
            <option>Ibanez</option>
            <option>Eko</option>
            <option>Yamaha</option>
            <option>Cort</option>
     </select>
    <label for="tipologiaAmmMod">Tipologia</label>
    <select name="tipologiaAmmMod" class="tipologiaAmm">
        <option>Elettrica</option>
        <option>Semiacustica</option>
         <option>Acustica</option>
         <option>Classica</option>
    </select>
    <label for="legnoManicoMod">Legno del manico</label>
    <select name="legnoManicoMod" class="legnoManico">
        <option>palissandro</option>
        <option>mogano</option>
         <option>acero</option>
         <option>abete</option>
         <option>ontano</option>
    </select>
    <label for="legnoCorpoMod">Legno del corpo</label>
    <select name="legnoCorpoMod" class="legnoCorpo">
    <option>palissandro</option>
     <option>acero</option>
     <option>abete</option>
    </select>';
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
