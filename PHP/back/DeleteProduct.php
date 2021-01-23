<?php

include('Session.php');
require_once("ManageProdotti.php");

$id_prodotto = $_REQUEST['prodotto'];


if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
	$utente_login=$_SESSION['login_user'];
}
else{
	$permessi=-1;
	$utente_login="";
}


if($permessi ==1){

    $manage_prodoto=new ManageProdotti();
    $risultato = $manage_prodoto->delete_prodotti($id_prodotto);
    header("Location: ../../Prodotti.php?operazione=1"); 
    
}else{
//reindirizzare a page 404

}


?>