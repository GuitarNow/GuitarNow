<?php
include('PHP/back/Session.php');
$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Inserisci commento", $web_page);

$nav_bar = '       <li class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
<li class="link" role="none"><a href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>','Insersci commento', $web_page);

$web_page = str_replace('<contenuto_to_insert/>', file_get_contents('Html/Inserisci_commento.html'), $web_page);

echo $web_page;

?>

