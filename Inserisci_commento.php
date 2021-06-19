<?php
include('PHP/back/Session.php');
require_once("PHP/back/ManageCommenti.php");
$tipo_prodotto = $_REQUEST['tipo_prodotto'];
$categoria = $tipo_prodotto;


if (isset($_REQUEST['codice_prodotto'])) {
    $codice_p=$_REQUEST['codice_prodotto'];
}

$web_page = file_get_contents('Html/Template.html');


$web_page = str_replace('<title_page/>', "Inserisci commento", $web_page);

$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteP', 'id="linkCorrente"', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>','Insersci commento', $web_page);


$web_page = str_replace('<gestioneAccesso/>', '<a href="Logout.php" id="logout">Logout</a>', $web_page);   
 
$commenti = file_get_contents('Html/Inserisci_commento.html');

$commenti = str_replace('<label_id/>', '<input type="hidden" id="codice_prodotto" name="codice_prodotto" value="'.$codice_p.'"/>', $commenti);
$commenti = str_replace('<tipo/>', '<input type="hidden" id="tipo_prodotto" name="tipo_prodotto" value="'.$categoria.'"/>', $commenti);


if (isset($_POST['submit'])) {
$id_prodotto = $_POST['codice_prodotto'];
$descrizione = $_POST['commento'];
$voto = $_POST['valutazione'];



if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
	$utente_login=$_SESSION['login_user'];
}
else{
	$permessi=-1;
	$utente_login="";
}


if($permessi ==0){

    $manage_comemnto=new ManageCommenti();
    $risultato = $manage_comemnto->inserisci_commento($descrizione,$voto,$id_prodotto,$utente_login);
    
   header("Location: Visualizza_prodotto.php?prodotto=".$id_prodotto."&tipo=".$tipo_prodotto);
    
}
}


$web_page = str_replace('<contenuto_to_insert/>', $commenti, $web_page);

echo $web_page;

?>

