<?php
$id_prodotto = $_GET['prodotto'];
$tipo_prodotto= $_GET['tipo'];

require_once('PHP/back/ManageProdotti.php');

$web_page = file_get_contents('Html/template.html');

/*------ QUERY -------*/

$manage_prodoto=new ManageProdotti();
$manage_commenti=new ManageProdotti();

$prodotto_selezionato='';
if($tipo_prodotto=='chitarre')
{
	$prodotto_selezionato= $manage_prodoto->get_specifiche_chitarre($id_prodotto);	
}
else
{
	$prodotto_selezionato= $manage_prodoto->get_specifiche_accessori($id_prodotto);
}

$commenti=$manage_commenti->get_commenti($id_prodotto);


/*------- DESCRIZIONE PRODOTTO -------*/

$web_page = str_replace('<title_page/>', "Specifiche prodotto", $web_page);

	$nav_bar = '       <li  class="link" role="none" xml:lang="en"><a href="Home.php" role="menuitem">Home</a></li> 
	<li  id="linkCorrente" class="link" role="none">Prodotti</li>
	<li class="link" role="none"><a href="Servizi.php" role="menuitem">Servizi</a></li>
	<li class="link" role="none"><a href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
	$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

	$web_page = str_replace('<breadcrumbs_to_insert/>', "Prodotti/Specifiche prodotto", $web_page);

	$num_commenti=0;
	$somma_commenti=0;
	foreach($commenti as $c)
	{
		$num_commenti=$num_commenti+1;
		$somma_commenti=$somma_commenti+$c['voto'];
	}
	if($num_commenti>0)
	{
		$valutazione=$somma_commenti/$num_commenti;
	}
	else
	{
		$valutazione='/';
	}
	$contenuto='<div id="scheda_prodotto">
				<h1>'.$prodotto_selezionato['produttore'].' '.$prodotto_selezionato['modello'].'</h1>
				<span id="specifiche_prodotto">
				<p>SPECIFICHE</p>
				<p>prezzo: '.$prodotto_selezionato['prezzo'].'&#128</p>
				<p>Voto medio: '.$valutazione.'</p>';
	if($tipo_prodotto=='chitarre')
	{
		$contenuto=$contenuto.'<p>Manico: '.$prodotto_selezionato['legno_manico'].'</p>
				  			   <p>Corpo: '.$prodotto_selezionato['legno_corpo'].'</p>';
	}
	$contenuto=$contenuto.'</span>
						   <img src="'.$prodotto_selezionato['path'].'" alt="'.$prodotto_selezionato['short_desc'].'" id="anteprima_img" />
				           <p>'.$prodotto_selezionato['descrizione'].'</p>
				           <h2>Sezione commenti</h2>';


	/*------- COMMENTI -------*/

	$sezione_commenti='';
	$nessun_commento=true;
	foreach($commenti as $c) /* Gestire caso zero commenti */
	{		
		$nessun_commento=false;	
	$sezione_commenti=$sezione_commenti.'
				<ul>
				<li id="commento">
				<p>'.$c['username'].'</p>
				<p>'.$c['data'].'</p>
				<p>'.$c['descrizione'].'</p>
				<p>Voto: '.$c['voto'].'</p>
				</li>
	
	
			   </ul>';
	}
	if($nessun_commento==true)
	{
		$sezione_commenti='<p>Nessun commento disponibile</p>';
	}
	$sezione_commenti=$sezione_commenti.'</div>';
	$contenuto=$contenuto.$sezione_commenti;
	$web_page = str_replace('<contenuto_to_insert/>', $contenuto, $web_page);

echo $web_page;




?>