<?php
include('PHP/back/Session.php');
require_once("PHP/back/ManageProdotti.php");

if (!isset($_REQUEST['categoria'])) {
    $_REQUEST['categoria']="chitarre";
}

$tipologia_ricevuta = null;
$produttore = null;
$prezzo = null;
$cercato= false;
if (isset($_REQUEST['cercato'])) {
    $cercato=true;
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

$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteP', 'id="linkCorrente"', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteC', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);

if($categoria == "chitarre" || $categoria == NULL){
    $web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Chitarre", $web_page);
}
else{
    $web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Accessori", $web_page);  
}

//login logout
if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
}
else{
	$permessi=-1;
}

if($permessi==-1){
$web_page = str_replace('<gestioneAccesso/>', '<a href="Login.php" id="accedi">Accedi</a>     
<a href="Registrati.php" id="registrati">Registrati</a> ', $web_page);
}
else{
    $web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="GET">
    <input  id="logout" type="submit" name ="logout" value="Logout" > 
     </form> ', $web_page);  
}

// ----- FILTRO CATEGORIA PRODOTTO -------
$menu_prodotto ="";
if($categoria == "chitarre" || $categoria == NULL){
    $menu_prodotto = '
<li id="linkCorrenteProdotti" class="link" role="none" >Chitarre</li> 
<li id="btn_accessori" class="link" role="none"><a href="Prodotti.php?categoria=accessori" role="menuitem">Accessori</a></li>
    ';
}elseif($categoria == "accessori"){
    $menu_prodotto = '
    <li id="btn_chitarre" class="link" role="none"><a id="a_chitarre" href="Prodotti.php?categoria=chitarre" role="menuitem">Chitarre</a></li> 
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






$contenuto_pagina .='<ul id="pg_prodotti" class="page_prodotti chitCard margin_less">';
$prodotti_count = new ManageProdotti();
$prodotti_get=new ManageProdotti();
if($categoria == "accessori"){
    $prodotti_database = $prodotti_count->filtri_accessori($tipologia_ricevuta,$produttore,$prezzo);
}else{
    $prodotti_database = $prodotti_count->filtri_chitarre($tipologia_ricevuta,$produttore,$prezzo);
}

/*------IMPAGINAZIONE PRODOTTI---*/

if(isset($_REQUEST['pagina']))
{
    $pagina_corrente=$_REQUEST['pagina'];
}
else
{
    $pagina_corrente=1;
}
$numero_prodotti=0;
if($prodotti_database!=NULL)
{
    foreach($prodotti_database as $p)
    {
        $numero_prodotti+=1;
    }
}


if($numero_prodotti!=0)
{
    $num_pagine=ceil($numero_prodotti/8);

    $fine=$pagina_corrente*8;
    $inizio=$fine-8;
    $fine=8;
    if($categoria == "accessori"){
        $prodotti_database = $prodotti_get->filtri_accessori($tipologia_ricevuta,$produttore,$prezzo,$inizio,$fine);
    }else{
        $prodotti_database = $prodotti_get->filtri_chitarre($tipologia_ricevuta,$produttore,$prezzo,$inizio,$fine);
    }

   



    // Predisposizione di un campo nascosto nella carta dove inserire l'id della chitarra , in modo da reindirizzare alla pagina_dettaglio della chitarra
    foreach($prodotti_database as $prodotti)
    {
        $contenuto_pagina.= '<li class="chitarre_prodotti"><a class="a_page_prodotti" href="Visualizza_prodotto.php?prodotto='.$prodotti['codice_prodotto'].'&tipo='.$categoria.'">
        <img class="chitarre " src="'.$prodotti['path'].'" alt="'.'a'.$prodotti['alt'].'" />'.
        '<p>'.$prodotti['produttore'].' '.$prodotti['modello'].
        '</p><p>'.$prodotti['prezzo'].'€</p>
        </a></li>';
    }

    $contenuto_pagina .= '</ul></div>';

    if(isset($_GET['operazione']) && $_GET['operazione']==1)
    {
        $contenuto_pagina.='<p class="operazione_confermata" >Prodotto eliminato correttamenete.</p>';
    }

    if($pagina_corrente!=1)
    {
        if($cercato!=null){
            $contenuto_pagina.='<a class="indietro" href="' . $_SERVER['PHP_SELF'] . '?pagina='. ($pagina_corrente - 1) .'&produttore='.$produttore.'&tipologia='.$tipologia_ricevuta.'&prezzo='.$prezzo.'&cercato='.$_REQUEST['categoria'].'" ><img src="Images/Indietro.png"></a>';
        }
        else
        {
            $contenuto_pagina.='<a class="indietro" href="' . $_SERVER['PHP_SELF'] . '?pagina='. ($pagina_corrente - 1) .'"   ><img src="Images/Indietro.png"</a>';
        }
    }

    if($pagina_corrente!=$num_pagine)
    {
        if($cercato!=null){
            $contenuto_pagina.='<a  class="avanti"   href="' . $_SERVER['PHP_SELF'] . '?pagina='.($pagina_corrente + 1).'&produttore='.$produttore.'&tipologia='.$tipologia_ricevuta.'&prezzo='.$prezzo.'&cercato='.$_REQUEST['categoria'].'" ><img src="Images/Avanti.png"></a>';
           
        }else{
            $contenuto_pagina.='<a  class="avanti"  href="' . $_SERVER['PHP_SELF'] . '?pagina='.($pagina_corrente + 1).'" ><img src="Images/Avanti.png"></a>';
        }
    }
    $contenuto_pagina.='<p id="paginazione">'.$pagina_corrente.'/'.$num_pagine.'</p>';
    
    
    


    
    
    
}
else
{
    $contenuto_pagina.='<p id="Nessun_prodotto">Spiacente non è stato trovato nessuno prodotto.</p>';
}
$web_page = str_replace('<contenuto_to_insert/>', $contenuto_pagina, $web_page);

if($permessi==1){
    $web_page = str_replace('<amministratorCrea />', 
' <hr/>

<a href="creaProdottoAmm.php?categoria='.$categoria.'" id="Crea" ><span class="tasto">Crea</span></a>' , $web_page);
}
else{
    $web_page = str_replace('<amministratorCrea />','', $web_page);
}

echo $web_page;

?>