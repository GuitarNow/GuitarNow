<?php
include('PHP/back/Session.php');
$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Chi siamo", $web_page);

$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteC', 'id="linkCorrente"', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteP', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', 'Chi siamo', $web_page);

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
        $web_page = str_replace('<gestioneAccesso/>', '<a href="Logout.php" id="logout">Logout</a>', $web_page);  
    }

$web_page = str_replace('<contenuto_to_insert/>', file_get_contents('Html/Chisiamo.html'), $web_page);

echo $web_page;


?>
