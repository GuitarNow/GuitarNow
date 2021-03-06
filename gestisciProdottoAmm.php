
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
$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Gestisci Prodotti Amministrazione", $web_page);
$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteP', 'id="linkCorrente"', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteC', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<breadcrumbs_to_insert/>', "Gestisci Prodotti - Amministrazione", $web_page);


$web_page = str_replace('<gestioneAccesso/>', '<a href="Logout.php" id="logout">Logout</a>', $web_page);  
$web_page = str_replace('<gestioneAccessoMobile/>', '<a href="Logout.php" id="logout_menu">Logout</a>', $web_page);

    

  
  
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

  $produttore = quota($_POST['produttoreAmmMod']);
  $tipo = quota($_POST['tipologiaAmmMod']);
  $modello = quota($_POST['modelloMod']);
  $descrizione = $_POST['descrizioneMod'];
  $descrizione=str_replace('{en}','<span lang="en" >',$descrizione);
  $descrizione=str_replace('{/en}','</span>',$descrizione);
  $short_desc = quota($_POST['short_descMod']);

  $long_desc = quota($_POST['long_descMod']);

  $prezzo_vendita = $_POST['prezzoMod'];
  $descrizione= quota($descrizione);
  
  $modificaP = new ManageProdotti();




  $modificaP->modifica_prodP($modello, $produttore, $descrizione, $prezzo_vendita, $id_prodotto);


  if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];

    move_uploaded_file($file_tmp,"Images/".$file_name);
    $modificaI = new ManageProdotti();
    if($file_size == 0) {
      $modificaI->modifica_prodI($prodotto_selezionato['path'], $short_desc,$long_desc, $id_prodotto);
      
    }else{
      $modificaI->modifica_prodI("Images/".quota($file_name), $short_desc, $long_desc, $id_prodotto);
    }
  }

  if($categoria == "chitarre"){
    $legno_manico = quota($_POST['legnoManicoMod']);
    $legno_corpo = quota($_POST['legnoCorpoMod']);
    $modificaC = new ManageProdotti();
    $modificaC->modifica_prodC($tipo, $legno_manico, $legno_corpo, $id_prodotto);
  }

  if($categoria == "accessori"){
    $modificaA = new ManageProdotti();
    $modificaA->modifica_prodA($tipo, $id_prodotto);
  }


  header('Location: Visualizza_prodotto.php?prodotto='.$id_prodotto.'&tipo='.$categoria.'&operazione=1');

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
    $data = str_replace('<modificaDati/>',' <input type="hidden" name="codiceProdottoMod" value=""/>
    <label for="produttoreAmmMod">Produttore</label>
    <span><input list="produttoreAmmModA" id="produttoreAmmMod" name="produttoreAmmMod" value="'.$prodotto_selezionato['produttore'].'"/></span>
    <datalist id="produttoreAmmModA">
    '.
    $produttori_accessori
    .'
    </datalist>
<label for="tipologiaAmmMod">Tipologia</label>
<span><input list="tipologiaAmmModA" name="tipologiaAmmMod" id="tipologiaAmmMod" value="'.$prodotto_selezionato['categoria'].'"/></span>
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

    $data = str_replace('<modificaDati/>','   <label for="produttoreAmmMod">Produttore</label>
    <span><input list="produttoreAmmModA" id="produttoreAmmMod" name="produttoreAmmMod" value="'.$prodotto_selezionato['produttore'].'"/></span>
    <datalist id="produttoreAmmModA" >
    '.
    $produttori_chitarre.
    '
    </datalist>
    <label for="tipologiaAmmMod">Tipologia</label>
    <span><input list="tipologiaAmmModA" id="tipologiaAmmMod" name="tipologiaAmmMod" value="'.$prodotto_selezionato['tipo_chitarra'].'"/></span>
    <datalist id="tipologiaAmmModA">'.
    $tipi_chitarra
    .'
    </datalist>
    <label for="legnoManicoMod">Legno del manico</label>
    <span><input type="text" id="legnoManicoMod" name="legnoManicoMod" class="legnoManico" value="'.$prodotto_selezionato['legno_manico'].'"/></span>
    <label for="legnoCorpoMod">Legno del corpo</label>
    <span><input type="text" name="legnoCorpoMod" id="legnoCorpoMod" class="legnoCorpo" value="'.$prodotto_selezionato['legno_corpo'].'"/></span>
    ', $data);
  }



$web_page = str_replace('<contenuto_to_insert/>',$data, $web_page);

$web_page = str_replace('prezzoV','value="'.$prodotto_selezionato['prezzo'].'"', $web_page);

$desc=$prodotto_selezionato['descrizione'];
$desc=str_replace('<span lang="en" >','{en}',$desc);
$desc=str_replace('</span>','{/en}',$desc);
$web_page = str_replace('<descrizioneMod/>',$desc, $web_page);
$web_page = str_replace('<descrizioneImgShort/>',$prodotto_selezionato['short_desc'], $web_page);
$web_page = str_replace('<descrizioneImgLong/>',$prodotto_selezionato['long_desc'] , $web_page);
$web_page = str_replace('modelloV','value="'.$prodotto_selezionato['modello'].'"', $web_page);
$web_page = str_replace('catModF',$categoria, $web_page);
$web_page = str_replace('proModF',$id_prodotto, $web_page);

echo $web_page;

}

?>
