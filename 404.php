<?php

$web_page = file_get_contents('Html/Template.html');
$web_page = str_replace('<title_page/>', "Errore 404", $web_page);

$nav_bar = file_get_contents('Html/Header.html');

$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);

$image_404='<img src="Images/404.png" alt="Errore 404. Pagina non trovata." >';
$web_page = str_replace('<contenuto_to_insert/>', $image_404, $web_page);

echo $web_page;

?>