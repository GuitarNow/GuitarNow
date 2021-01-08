<?php
include('PHP/back/Session.php');
require_once("PHP/back/ManageProdotti.php");

if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$tipologia_ricevuta = null;
$produttore = null;
$prezzo = null;

if (isset($_REQUEST['cercato'])) {
    
    $_REQUEST['categoria']= $_REQUEST['cercato'];

if (isset($_REQUEST['tipologia'])) {
    $tipologia_ricevuta = $_REQUEST['tipologia'];
    
}

if (isset($_REQUEST['produttore'])) {
    $produttore = $_REQUEST['produttore'];
}


if (isset($_REQUEST['prezzo'])) {
    $prezzo = $_REQUEST['prezzo'];

}


}




$categoria = $_REQUEST['categoria'];



$web_page = file_get_contents('html/template.html');

$web_page = str_replace('<title_page/>', "Prodotti", $web_page);

$nav_bar = '       <li  class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
<li  id="linkCorrente" class="link" role="none">Prodotti</li>
<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);


$web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Chitarre", $web_page);


// ----- FILTRO CATEGORIA PRODOTTO -------
$menu_prodotto ="";
if($categoria == "chitarre" || $categoria == NULL){
    $menu_prodotto = '
<li id="linkCorrenteProdotti" class="link" role="none" >Chitarre</li> 
<li class="link" role="none"><a href="Prodotti.php?categoria=accessori" role="menuitem">Accessori</a></li>
    ';
}elseif($categoria == "accessori"){
    $menu_prodotto = '
    <li  class="link" role="none"><a href="Prodotti.php?categoria=chitarre" role="menuitem">Chitarre</a></li> 
    <li id="linkCorrenteProdotti" class="link" role="none">Accessori</a></li>';
}




$filtri=file_get_contents('Html/Filtri.html');
$filtri = str_replace('<menu_prodotti/>', $menu_prodotto, $filtri);

//-------------------FILTRO PRODUTTORI ----------------
$produttori_manage = new ManageProdotti();

$produttori="";
$filtro_produttori ="";
if($categoria == "accessori"){
    $produttori = $produttori_manage->get_produttori_accessori();
}elseif($categoria == "chitarre"){
    $produttori = $produttori_manage->get_produttori_chitarre();
}

foreach($produttori as $produttori_da_visualizzare){
    $filtro_produttori.= "<option>".$produttori_da_visualizzare['produttore']."</option>";
}


$filtri = str_replace('<filtro_produttore/>', $filtro_produttori, $filtri);

// -------- FILTRO CATEGORIA ----------------
$tipo_manage = new ManageProdotti();
$tipo="";
$filtro_tipo ="";
if($categoria == "accessori"){
    $tipo = $tipo_manage->get_tipo_accessori();
}elseif($categoria == "chitarre"){
    $tipo = $tipo_manage->get_tipo_chitarre();
}

foreach($tipo as $tipi_da_visualizzare){
    $filtro_tipo.= "<option>".$tipi_da_visualizzare['tipo']."</option>";
}

$filtri = str_replace('<filtro_tipologia/>', $filtro_tipo, $filtri);



$filtri = str_replace('<categoria_da_passare/>', '<input type="hidden" id="cercato" name="cercato" value="'.$categoria.'">', $filtri);




// ----------------FILTRO ---------------------------
$contenuto_pagina ="<div id='container_prodotti_filtri'>";
$contenuto_pagina .=$filtri;






$contenuto_pagina .='<ul class="page_prodotti chitCard">';
$prodotti_manage = new ManageProdotti();

if($categoria == "accessori"){
    $prodotti_database = $prodotti_manage->filtri_accessori($tipologia_ricevuta,$produttore,$prezzo);
}else{
    $prodotti_database = $prodotti_manage->filtri_chitarre($tipologia_ricevuta,$produttore,$prezzo);
}

/*------IMPAGINAZIONE PRODOTTI---*/
$manage_numero_prodotti=new ManageProdotti();
if($categoria=='chitarre')
{
	$numero_prodotti=$manage_numero_prodotti->get_numero_chitarre();
}
else
{
	$numero_prodotti=$manage_numero_prodotti->get_numero_accessori();
}
foreach($numero_prodotti as $num)
{$num_pagine=ceil($num['Num']/8);}

if (isset($_REQUEST['pagina'])) {
    
    $pagina_corrente= 1;
}

$pagina_corrente=1;


// Predisposizione di un campo nascosto nella carta dove inserire l'id della chitarra , in modo da reindirizzare alla pagina_dettaglio della chitarra
foreach($prodotti_database as $prodotti)
{
    $contenuto_pagina.= '<a class="a_page_prodotti" href="Visualizza_prodotto.php?prodotto='.$prodotti['codice_prodotto'].'&tipo='.$categoria.'"><li class="chitarre_prodotti">
    <img class="chitarre " src="'.$prodotti['path'].'" alt="Chitarra acustica" />'.
    '<p>'.$prodotti['produttore'].' '.$prodotti['modello'].
    '</p><p>'.$prodotti['prezzo'].'€</p>
    </li></a>';
}

$contenuto_pagina .= '</ul></div>';
if($pagina_corrente!=1)
{
    $contenuto_pagina.='<a  href="' . $_SERVER['PHP_SELF'] . '?pagina="'. ($pagina_corrente - 1) .'">Indietro</a>';
}
$contenuto_pagina.='<p>'.$pagina_corrente.'/'.$num_pagine.'</p>';
if($pagina_corrente!=$num_pagine)
{
    $contenuto_pagina.='<a  href="' . $_SERVER['PHP_SELF'] . '?pagima="' . ($pagina_corrente + 1) .'">Avanti</a>';
}
$web_page = str_replace('<contenuto_to_insert/>', $contenuto_pagina, $web_page);

echo $web_page;

?>