<?php

include('Session.php');
require_once("ManageCommenti.php");

$id_commento = $_REQUEST['commento'];


if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
	$utente_login=$_SESSION['login_user'];
}
else{
	$permessi=-1;
	$utente_login="";
}


if($permessi ==1){

    $manage_commenti=new ManageCommenti();
    $risultato = $manage_commenti->delete_commenti($id_commento);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
}else{
//reindirizzare a page 404

}


?>