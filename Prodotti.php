<?php

$categoria = $_REQUEST['categoria'];

require_once("PHP/back/ManageProdotti.php");

$web_page = file_get_contents('html/template.html');

$web_page = str_replace('<title_page/>', "Prodotti", $web_page);

$nav_bar = '       <li  class="link" role="none" xml:lang="en"><a href="Home.html" role="menuitem">Home</a></li> 
<li  id="linkCorrente" class="link" role="none">Prodotti</li>
<li class="link" role="none"><a href="Servizi.html" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Chisiamo.html" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);


$web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Chitarre", $web_page);

$chitare_da_visualizzare 
= '<ul class="chitCard">';

$chitarre_manage = new ManageProdotti();
if($categoria == "accessori"){
    $chitarre_database = $chitarre_manage->get_accessori();
}else{
    $chitarre_database = $chitarre_manage->get_chitarra();
}


foreach($chitarre_database as $chitarre)
{
    $chitare_da_visualizzare.= '<li>
    <img class="chitarre" src="Images/CHITARRA-ACUSTICA-YAMAHA-F-370.jpg" alt="Chitarra acustica" />'.
    '<p>'.$chitarre['produttore'].$chitarre['modello'].'</p>'.
    '<p>'.$chitarre['prezzo_vendita'].'€</p>
    </li>';
}

$chitare_da_visualizzare .= '</ul>';

$web_page = str_replace('<contenuto_to_insert/>', $chitare_da_visualizzare, $web_page);

echo $web_page;

?>