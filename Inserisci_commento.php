<?php
include('PHP/back/Session.php');

if (isset($_REQUEST['codice_prodotto'])) {
    $codice_p=$_REQUEST['codice_prodotto'];
}

$web_page = file_get_contents('Html/Template.html');


$web_page = str_replace('<title_page/>', "Inserisci commento", $web_page);

$nav_bar = '       <li class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
<li class="link" role="none"><a href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>','Insersci commento', $web_page);


        $web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="GET">
        <input  id="logout" type="submit" name ="logout" value="Logout" > 
         </form> ', $web_page);  
 
$commenti = file_get_contents('Html/Inserisci_commento.html');

$commenti = str_replace('<label_id/>', '<input type="hidden" id="codice_prodotto" name="codice_prodotto" value="'.$codice_p.'"/>', $commenti);

$web_page = str_replace('<contenuto_to_insert/>', $commenti, $web_page);

echo $web_page;

?>

