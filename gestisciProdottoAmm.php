
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
              $long_desc = $_POST['long_descMod'];
              $short_desc = $_POST['short_descMod'];
              $prezzo_vendita = $_POST['prezzoMod'];
      
          $modificaP = new ManageProdotti();
          $modificaP->modifica_prodP($modello, $produttore, $descrizione, $prezzo_vendita);
          $modificaC = new ManageProdotti();
          $modificaC->modifica_prodC($tipo, $legno_manico, $legno_corpo);
          $modificaI = new ManageProdotti();
          $modificaI->modifica_prodI($immagine, $short_desc, $long_desc);
           
           }
        }


$dataMod=file_get_contents('Html/gestisciProdotto.html');
  if($categoria == "accessori"){
    $dataMod = str_replace('<modAcc/>',' <input type="hidden" name="codiceProdottoMod"" value=""/>
    <label for="produttoreAmmModA">Produttore</label>
    <input list="produttoreAmmModA" name="produttoreAmmModA" value="'.$prodotto_selezionato['produttore'].'">
    <datalist id="produttoreAmmModA">
      <option value="Daddario">
      <option value="BOSS">
      <option value="Fender">
      <option value="ErnieBall">
    </datalist>
<label for="tipologiaAmmModA">Tipologia</label>
<input list="tipologiaAmmModA" name="tipologiaAmmModA" value="'.$prodotto_selezionato['categoria'].'">
<datalist id="tipologiaAmmModA">
  <option value="Corde">
  <option value="Amplificatori">
  <option value="Effetti">
  <option value="Gadget">
</datalist>',$dataMod);
  }else{
      
    $dataMod = str_replace('<modChit/>','   <label for="produttoreAmmModC">Produttore</label>
    <input list="produttoreAmmModC" name="produttoreAmmModC" value="'.$prodotto_selezionato['produttore'].'">
    <datalist id="produttoreAmmModC" >
      <option value="Epiphone">
      <option value="Gibson">
      <option value="Fender">
      <option value="Ibanez">
      <option value="Eko">
      <option value="Yamaha">
      <option value="Cort">
    </datalist>
    <label for="tipologiaAmmModC">Tipologia</label>
    <input list="tipologiaAmmModC" name="tipologiaAmmModC" value="'.$prodotto_selezionato['tipo_chitarra'].'">
    <datalist id="tipologiaAmmModC">
      <option value="Elettrica">
      <option value="Semiacustica">
      <option value="Acustica">
      <option value="Classica">
    </datalist>
    <label for="legnoManicoMod">Legno del manico</label>
    <input type="text" name="legnoManicoMod" class="legnoManico" value="'.$prodotto_selezionato['legno_manico'].'">
    <label for="legnoCorpoMod">Legno del corpo</label>
    <input type="text" name="legnoCorpoMod" class="legnoCorpo" value="'.$prodotto_selezionato['legno_corpo'].'">
    ', $dataMod);
  }
$web_page = str_replace('<contenuto_to_insert/>',$dataMod, $web_page);

$web_page = str_replace('<prezzoV/>',$prodotto_selezionato['prezzo'], $web_page);
$web_page = str_replace('<descrCV/>',$prodotto_selezionato['short_desc'], $web_page);
$web_page = str_replace('<descrLV/>',$prodotto_selezionato['long_desc'], $web_page);
$web_page = str_replace('<descrProdV/>',$prodotto_selezionato['descrizione'], $web_page);

echo $web_page;
}

?>
