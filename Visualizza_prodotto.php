
<?php
include('PHP/back/Session.php');

$id_prodotto = $_GET['prodotto'];
$tipo_prodotto= $_GET['tipo'];
$categoria = $tipo_prodotto;

require_once('PHP/back/ManageProdotti.php');
require_once('PHP/back/ManageCommenti.php');

$web_page = file_get_contents('Html/template.html');

if(isset($_SESSION['login_user'])){
	$permessi=$_SESSION['permessi'];
	$utente_login=$_SESSION['login_user'];
}
else{
	$permessi=-1;
	$utente_login="";
}


$gia_commentato=false;

/*------ QUERY -------*/

$manage_prodoto=new ManageProdotti();
$manage_commenti=new ManageCommenti();


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


$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteP', 'id="linkCorrente"', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteC', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);

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

	$web_page = str_replace('<gestioneAccessoMobile/>', '<a href="Login.php" id="accedi_menu">Accedi</a>     
	<a href="Registrati.php" id="registrati_menu">Registrati</a>  ', $web_page);
	}
	else{
		$web_page = str_replace('<gestioneAccesso/>', '<a href="Logout.php" id="logout">Logout</a>', $web_page);  
		$web_page = str_replace('<gestioneAccessoMobile/>', '<a href="Logout.php" id="logout_menu">Logout</a>', $web_page);
	}

/*------- DESCRIZIONE PRODOTTO -------*/

$web_page = str_replace('<title_page/>', "Specifiche prodotto", $web_page);


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
				<img src="'.$prodotto_selezionato['path'].'" alt="'.$prodotto_selezionato['short_desc'].'" id="anteprima_img" />
				<p><span id="prezzo">'.$prodotto_selezionato['prezzo'].'</span></p>
				<h2>SPECIFICHE</h2>
				<p>'.$prodotto_selezionato['descrizione'].'</p>';
				
	if($tipo_prodotto=='chitarre')
	{
		$contenuto.='<p>Legno manico: '.$prodotto_selezionato['legno_manico'].'</p>
				  	 <p>Legno corpo: '.$prodotto_selezionato['legno_corpo'].'</p>';
	}
	if($valutazione!='/')
	{
		$contenuto.='<p>Valutazione media degli utenti: '.$valutazione.' su 5</p>';
	}
	
	
	/*--------BottoniAmm--------*/
	if($permessi==1){
	$bottoniAmm='<a href="gestisciProdottoAmm.php?categoria='.$categoria.'&prodotto='.$id_prodotto.'" id="Modifica" >Modifica</a>'
	.
	'<button aria-label="Elimina prodotto" onclick="eliminaProdotto('.$id_prodotto.')" id="Elimina" >Elimina</button>';
	
	$contenuto=$contenuto.$bottoniAmm;
		if(isset($_GET['operazione']) && $_GET['operazione']==1)
		{
			$contenuto.='<p class="operazione_confermata" >Modifiche eseguite correttamenete.</p>';
		}
	}

	/*------- COMMENTI -------*/
	$contenuto=$contenuto.'<h2>Sezione commenti</h2>';
	$sezione_commenti='';
	$nessun_commento=true;
	if($num_commenti>0)
	{
		$sezione_commenti.='<ul>';
	
	foreach($commenti as $c) 
	{		
		if ($utente_login==$c['username']){
			$gia_commentato= true;
		}
		$nessun_commento= false;
		$sezione_commenti=$sezione_commenti.'
				
				<li class="commento">
				<p>'.$c['username'].'</p>
				<p>'.$c['data'].'</p>
				<p>'.$c['descrizione'].'</p>
				<p>Voto: '.$c['voto'].'</p>';
				
				if(($permessi == 1 || ($permessi==0 && $utente_login == $c['username'] ))){

					$sezione_commenti.= '<button aria-label="Elimina commento" onclick="eliminaCommento('.$c['id_commento'].')" class="eliminaC" >ELIMINA</button>';
		
				}
				$sezione_commenti.='</li>
				';
	
		
	}
	$sezione_commenti.='</ul>';
}
	if($nessun_commento==true)
	{
		$sezione_commenti='<p id="commentonascosto">Nessun commento disponibile</p>';
	}

	
	
	$sezione_commenti=$sezione_commenti;
	$contenuto=$contenuto.$sezione_commenti;
	
	if($permessi==0 && $gia_commentato==false)
	{
		
		$contenuto.='</br><a href="Inserisci_commento.php?codice_prodotto='.$id_prodotto.'&tipo_prodotto='.$categoria.'" class="bottone_std">Commenta</a>';
	}
	$contenuto=$contenuto.'</div><a id="floatDestra" class="aiuto" href="prodotti.php">Torna ai prodotti</a>';
	$web_page = str_replace('<contenuto_to_insert/>', $contenuto, $web_page);

echo $web_page;




?>