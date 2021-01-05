<?php

$web_page = file_get_contents('Amministratore.html');

$web_page = str_replace('<title_page/>', "Amministratore", $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>','Amministrazione', $web_page);

$web_page = str_replace('<contenuto_to_insert/>', file_get_contents('Amministratore.html'), $web_page);

echo $web_page;

?>