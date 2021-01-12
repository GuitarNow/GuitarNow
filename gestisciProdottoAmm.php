
<?php
include('../PHP/back/Session.php');
require_once("../PHP/back/ManageProdotti.php");

$web_page = file_get_contents('templateAmm.html');

$web_page = str_replace('<title_page/>', "Gestisci Prodotti Amministrazione", $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', "Gestisci Prodotti - Amministrazione", $web_page);

$web_page = str_replace('<contenuto_to_insert/>', '<div id="contenutoRegistrati" class="contenuto">

    <form method="post" class="form" action="prodottiAmm.php" id="formSopra" >
    <fieldset>
    
    <img src="../Images/logo_bianco.png" alt="" />
    <label for="produttore">Produttore</label>
    <select name="produttoreAmm" id="produttoreAmm">
            <option>Epiphone</option>
            <option>Gibson</option>
            <option>Fender</option>
            <option>Ibanez</option>
            <option>Eko</option>
            <option>Yamaha</option>
            <option>Cort</option>
     </select>
    <label for="tipologia">Tipologia</label>
    <select name="tipologiaAmm" id="tipologiaAmm">
        <option>Elettrica</option>
        <option>Semiacustica</option>
         <option>Acustica</option>
         <option>Classica</option>
    </select>
    <label for="Descrizione">Descrizione</label>
    <textarea rows=“40" cols="40" name="message" > </textarea>
    <label for="immagine">Importa immagine</label>
    <input type="file"  enctype= “multipart/form-data” id="file"/>
    <label for="prezzo">Prezzo</label>
    <input type="text" name="prezzo" id="prezzo" value="€" />
    <input type="submit" name="Salva" value="Salva Prodotto" class="Salva" />
    <input type="submit" name="Annulla" value="Annulla" class="Annulla"  />  
 
    </fieldset>
    </form>
    <form method="post" class="form" action="amministratore.php" id="formElimina"> 
    <fieldset>
<input type="submit" name="Elimina" value="Elimina Prodotto" id="Elimina" />
</fieldset>
</form>
    
</div>', $web_page);

$web_page = str_replace('<logout_to_insert/>', '<input id="logout" type="submit" name ="logout" value="Logout" >', $web_page);

echo $web_page;
?>
