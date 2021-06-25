<?php

$web_page = file_get_contents('Html/Template.html');
$web_page = str_replace('<title_page/>', "Errore 404", $web_page);

$nav_bar = file_get_contents('Html/Header.html');

$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<breadcrumbs_to_insert/>',"Page 404", $web_page);
$web_page = str_replace('idlinkcorrenteH',"", $web_page);
$web_page = str_replace('idlinkcorrenteP',"", $web_page);
$web_page = str_replace('idlinkcorrenteS',"", $web_page);
$web_page = str_replace('idlinkcorrenteC',"", $web_page);

$web_page = str_replace('<gestioneAccesso/>',"", $web_page);
$web_page = str_replace('<gestioneAccessoMobile/>',"", $web_page);

$image_404='<div id="errorDiv">
    <p class="hError"> 404 </p>
    <p class="hError" id ="pError"> Sembra che questa non sia la pagina che stavi cercando </p>
<img src="Images/404.png" id="imgError"alt="Errore 404. Pagina non trovata." ></div>';
$web_page = str_replace('<contenuto_to_insert/>', $image_404, $web_page);

echo $web_page;

?>
