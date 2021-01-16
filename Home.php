<?php
include('PHP/back/Session.php');
require_once("PHP/back/ManageProdotti.php");

$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Home", $web_page);

$nav_bar = '       <li id="linkCorrente" class="link" role="none" xml:lang="en">Home</li> 
<li class="link" role="none"><a href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', '<span xml: lang="en"> Home</span>', $web_page);

//login logout
if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
}
else{
	$permessi=-1;
}

if($permessi==-1){
$web_page = str_replace('<gestioneAccesso/>', '<a href="Login.php" id="accedi">Accedi</a>     
        <a href="Registrati.php" id="registrati">Registrati</a>  ', $web_page);
}
else{
    $web_page = str_replace('<gestioneAccesso/>', '<form  action="Logout.php" method="GET">
    <input  id="logout" type="submit" name ="logout" value="Logout" > 
     </form> ', $web_page);  
}

$pagina_home =  file_get_contents('Html/Home.html');

$chitarre = new ManageProdotti();
$accessori = new ManageProdotti();

$ultimi_arrivi_chitarre = $chitarre->get_ultimi_arrivi_chitarre();
$ultimi_arrivi_accessori = $accessori->get_ultimi_arrivi_accessori();

$chitarre_da_visualizzare="";
foreach($ultimi_arrivi_chitarre as $prodotti)
{
    $chitarre_da_visualizzare.= '<a href="Visualizza_prodotto.php?prodotto='.$prodotti['codice_prodotto'].'&tipo=chitarre"><li>
    <img class="chitarre" src="'.$prodotti['path'].'" alt="'./*$prodotti['alt'].*/'" />'.
    '<p>'.$prodotti['produttore'].' '.$prodotti['modello'].
    '</p><p>'.$prodotti['prezzo'].'€</p>
    </li></a>';
}

$pagina_home = str_replace('<ultimi_arrivi_chitarre/>',$chitarre_da_visualizzare , $pagina_home);


$accessori_da_visualizzare="";
foreach($ultimi_arrivi_accessori as $accessori_da_scorrere)
{
    $accessori_da_visualizzare.= '<a href="Visualizza_prodotto.php?prodotto='.$accessori_da_scorrere['codice_prodotto'].'&tipo=accessori"><li>
    <img class="accessori" src="'.$accessori_da_scorrere['path'].'" alt="'./*$accessori_da_scorrere['alt'].*/'" />'.
    '<p>'.$accessori_da_scorrere['produttore'].' '.$accessori_da_scorrere['modello'].
    '</p><p>'.$accessori_da_scorrere['prezzo'].'€</p>
    </li></a>';
}

$pagina_home = str_replace('<ultimi_arrivi_accessori/>',$accessori_da_visualizzare , $pagina_home);



$web_page = str_replace('<contenuto_to_insert/>',$pagina_home, $web_page);

echo $web_page;

?>