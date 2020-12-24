<?php
$id_prodotto = $_GET['prodotto'];

require_once('PHP/back/DatabaseConnection.php');

$web_page = file_get_contents('Html/template.html');


$manage_prodoto=new ManageProdotti();

$chitarra_selezionata= $manage_prodoto->get_specifiche_chitarra($id_prodotto);


$web_page = str_replace('<title_page/>', "Specifiche prodotto", $web_page);

$nav_bar = '       <li  class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
<li  id="linkCorrente" class="link" role="none">Prodotti</li>
<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Specifiche prodotto", $web_page);


// essendo che ritorna solamente un elemento non so se funziona il foreach
foreach($chitarra_selezionata as $c)
{

$contenuto='<div id="specifiche_prodotto"><h1>'.$c['produttore'].' '.$c['modello'].'</h1></div>';

}
$web_page = str_replace('<contenuto_to_insert/>', $contenuto, $web_page);

echo $web_page;




?>