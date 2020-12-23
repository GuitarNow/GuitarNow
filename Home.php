<?php

$categoria = $_REQUEST['categoria'];

$web_page = file_get_contents('html/template.html');

$web_page = str_replace('<title_page/>', "Home", $web_page);

$nav_bar = '       <li id="linkCorrente" class="link" role="none" xml:lang="en">Home</li> 
<li class="link" role="none"><a href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a href="Html/Servizi.html" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Html/Eventi.html" role="menuitem">Eventi</a></li>
<li class="link" role="none"><a href="Html/Chisiamo.html" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', '<span xml: lang="en">Home</span>', $web_page);

$contenuto_home = '   <div id="contenutoHome" class="contenuto">
<h1>Descrizione</h1>
<p id="descrizione">GuitarNow è uno dei più grandi e famosi rivenditori di chitarre di Padova. Presso il nostro store potrai trovare i
    marchi più rinomati e i prodotti più di nicchia. Ma non è finita qui. GuitarNow mette inoltre a disposzione un servizio 
    di manutenziome e pulizia delle chitarre perchè la cura del proprio strumento è un requisito fondamentale per ogni 
    chitarrista. Da un anno a questa parte, inoltre, abbiamo deciso di mettere a disposizione degli artisti emergenti un 
    servizio di registrazione professionale ad un prezzo veramnete vantaggioso. Un team di nostri tecnici ti seguirà durante 
    tutto il processo, dalla registrazione al mixaggio. Cosa aspetti vieni a trovarci!
 </p>

<h1>Chitarre Principali</h1>       
<ul class="chitCard">

<li>
<img class="chitarre" src="Images/CHITARRA-ACUSTICA-YAMAHA-F-370.jpg" alt="Chitarra acustica" />
<p>Chitarra Acustica Yamaha F-370</p>
<p>155,00€</p>
</li>

<li id="chittacapo">
<img class="chitarre" src="Images/valencia-classica.jpg" alt="Chitarra Classica" />
<p>Chitarra Classica Valencia Natural</p>
<p>85,00€</p>
</li>

<li>
<img class="chitarre" src="Images/washburn_-_s1hb.jpg" alt="Chitarra elettrica" />
<p>Washburn S1HB - Chitarra Elettrica</p>
<p>162,00€</p>
</li>   

<li>
<img class="chitarre" src="Images/EPIPHONE-JOE-PASS-EMPEROR-II-PRO-VINTAGE-SUNBURST.jpg" alt="Chitarra semiacustica" />
<p>Chitarra semiacustica</p>
<p>609,00€</p>
</li>

</ul>


<h1>Accessori Principali</h1>
<ul class="accCard">

    <li>
    <img id="acc1" class="accessori" src="Images/boss_RC30(249eurp).jpg" alt="boss RC30" />
    <p>Boss RC30</p>
    <p>249,00€</p>
    </li>

    <li>
    <img id="acc2" class="accessori" src="Images/fender_champion40(150euro).jpg" alt="fender champion" />
    <p>Fender Champion40</p>
    <p>150,00€</p>
    </li>
    
    <li>
    <img id="acc3" class="accessori" src="Images/marshall_action_2_(229euro).jpg" alt="marshall action" />
    <p>Marshall Action 2</p>
    <p>229,00€</p>
    </li>   

    <li>
    <img id="acc4" class="accessori" src="Images/plettri_metallica(1euro_al_pezzo).jpg" alt="plettri" />
    <p>Plettri metallica</p>
    <p>1,00€ al pezzo</p>
    </li>
   
    </ul>
</div>';

$web_page = str_replace('<contenuto_to_insert/>', $contenuto_home, $web_page);