<?php

$web_page = file_get_contents('Html/Template.html');
$web_page = str_replace('<title_page/>', "Errore 404", $web_page);

$nav_bar = '       <li class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
<li class="link" role="none"><a class="a_header" href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a class="a_header" href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a class="a_header" href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$image_404='<img src="Images/Error_404.png" alt="Errore 404. Pagina non trovata.">';
$web_page = str_replace('<contenuto_to_insert/>', $image_404, $web_page);

echo $web_page;

?>