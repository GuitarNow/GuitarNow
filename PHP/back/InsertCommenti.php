<?php

include('Session.php');
require_once("ManageCommenti.php");

$id_prodotto = $_REQUEST['codice_prodotto'];
$descrizione = $_REQUEST['commento'];
$voto = $_REQUEST['valutazione'];


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
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
}else{
//reindirizzare a page 404

}


?>