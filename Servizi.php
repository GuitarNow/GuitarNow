
<?php

include('PHP/back/Session.php');
$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Servizi", $web_page);

$nav_bar = '       <li  class="link" role="none" xml:lang="en"><a class="a_header" href="Home.php" role="menuitem">Home</a></li> 
<li class="link" role="none"><a class="a_header" href="Prodotti.php?categoria=chitarre" role="menuitem">Prodotti</a></li>
<li  id="linkCorrente" class="link" role="none">Servizi</li>
<li class="link" role="none"><a class="a_header" href="Chisiamo.php" role="menuitem">Chi siamo</a></li>';
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', 'Servizi', $web_page);

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

$web_page = str_replace('<contenuto_to_insert/>', file_get_contents('Html/Servizi.html'), $web_page);

echo $web_page;

?>