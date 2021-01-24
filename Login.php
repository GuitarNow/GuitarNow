<?php
require_once('PHP/back/DatabaseConnection.php');

session_start();
if(isset($_SESSION['login_user'])){
    header("location: home.php");
    $_SESSION['cnt'] = 0;
}



$web_page = file_get_contents('Html/Template.html');

$web_page = str_replace('<title_page/>', "Accedi", $web_page);

$nav_bar = file_get_contents('Html/Header.html');
$nav_bar = str_replace('idlinkcorrenteH', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteP', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteS', '', $nav_bar);
$nav_bar = str_replace('idlinkcorrenteC', '', $nav_bar);
$web_page = str_replace('<header_to_insert/>', $nav_bar, $web_page);
$web_page = str_replace('<menu_to_insert/>', $nav_bar, $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>','Accedi', $web_page);




$data=file_get_contents('Html/Login.html');


if(isset($_GET['operazione']) && $_GET['operazione']==1)
{
    $data=str_replace('<messaggio/>', '<p class="operazione_confermata">Registrazione eseguita correttamenete.</p>', $data);
    $data = str_replace('<erroreLogin/>', '', $data);
    $data = str_replace('valueUsername', '', $data);
    $data = str_replace('<errorePassLogin/>', '', $data);
        $data = str_replace('<erroreUserLogin/>', '', $data);
        $data=str_replace('<messaggio/>', '', $data);
}
else
{
    
    $data=str_replace('<messaggio/>', '', $data);
}

if (isset($_POST['submit'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];  
    if (strlen($password) == 0 && strlen($username) ==0 ) {
        $data = str_replace('<errorePassLogin/>', 'Inserisci un valore', $data);
        $data = str_replace('<erroreUserLogin/>', 'Inserisci un valore', $data);
        } 
if (strlen($username) ==0) {
$data = str_replace('<erroreUserLogin/>', 'Inserisci un valore', $data);
}
else
    if (strlen($password) == 0) {
        $data = str_replace('<errorePassLogin/>', 'Inserisci un valore', $data);
        $data = str_replace('valueUsername', 'value="'.$username.'"', $data);
        }
        else
            if (strlen($password) < 3) {
                $data = str_replace('<errorePassLogin/>', 'Password di almeno 3 caratteri', $data);
                $data = str_replace('valueUsername', 'value="'.$username.'"', $data);
            }else{


                $database = new DatabaseConnection();
                // proteggere MySQL injection 
                $username = stripslashes($username);
                $password = stripslashes($password);
                $username = $database->escape_string($username);
                $password = $database->escape_string($password);
$utente = mysqli_fetch_assoc($database->get_result_query("select username, password, permessi from user where (password='$password' AND username='$username') "));	

if ($utente==NULL) {
    $data = str_replace('<erroreLogin/>', 'Password o Username non corretti', $data);
    $data = str_replace('valueUsername', 'value="'.$username.'"', $data);

} else {
    $_SESSION['login_user']=$username; 
$_SESSION['psw']=$password;
$_SESSION['permessi']=$utente['permessi'];
header("location: Home.php"); // indirizzamento
$data = str_replace('<erroreLogin/>', '', $data);
    $data = str_replace('valueUsername', '', $data);
    $data = str_replace('<errorePassLogin/>', '', $data);
        $data = str_replace('<erroreUserLogin/>', '', $data);
        $data=str_replace('<messaggio/>', '', $data);
}

}
}



$web_page = str_replace('<contenuto_to_insert/>', $data, $web_page);

echo $web_page;




?>


