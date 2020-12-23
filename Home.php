<?php

$web_page = file_get_contents('Html/template.html');

$web_page = str_replace('<title_page/>', "Home", $web_page);

$nav_bar = '       <li id="linkCorrente" class="link" role="none" xml:lang="en">Home</li> 
<li class="link" role="none"><a href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a href="Html/Servizi.html" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Html/Eventi.html" role="menuitem">Eventi</a></li>
<li class="link" role="none"><a href="Html/Chisiamo.html" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', '<span xml: lang="en"> Home</span>', $web_page);

$web_page = str_replace('<contenuto_to_insert/>',file_get_contents('Home.html'), $web_page);

echo $web_page;

?>