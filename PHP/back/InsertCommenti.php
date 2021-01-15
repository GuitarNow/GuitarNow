<?php
require_once('ManageCommenti.php');
$voto=$_POST['valutazione'];
$testo=$_POST['commento'];


$query='INSERT INTO commento (descrizione,voto,data) VALUES ("'.$testo.'","'.$voto.'","'.date("1").'");';
echo $query;
if(mysqli_query($query)){
    echo "si";
}else{
    echo "no";
}



?>