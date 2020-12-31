<?php
$id_prodotto = $_GET['prodotto'];
$tipo_prodotto= $_GET['tipo'];

require_once('PHP/back/ManageProdotti.php');

$web_page = file_get_contents('Html/template.html');


$manage_prodoto=new ManageProdotti();

$prodotto_selezionato='';
if($tipo_prodotto=='chitarre')
{
	$prodotto_selezionato= $manage_prodoto->get_specifiche_chitarre($id_prodotto);	
}
else
{
	$prodotto_selezionato= $manage_prodoto->get_specifiche_accessori($id_prodotto);
}

$web_page = str_replace('<title_page/>', "Specifiche prodotto", $web_page);

	$nav_bar = '       <li  class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
	<li  id="linkCorrente" class="link" role="none">Prodotti</li>
	<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
	<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
	$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

	$web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Specifiche prodotto", $web_page);



	$contenuto='<div id="specifiche_prodotto">
				<h1>'.$prodotto_selezionato['produttore'].' '.$prodotto_selezionato['modello'].'</h1>
				<span id="dati_prodotto">
				<p>INFO GENERALI</p>
				<p>prezzo: '.$prodotto_selezionato['prezzo_vendita'].'&#128</p>
				<p>Voto medio: 5 </p>
				</span>
				<img src="'.$prodotto_selezionato['path'].'" alt="'.$prodotto_selezionato['short_desc'].'" id="anteprima_img" />
				<p>'.$prodotto_selezionato['descrizione'].'</p>
				</div>';

	$web_page = str_replace('<contenuto_to_insert/>', $contenuto, $web_page);

echo $web_page;




?>