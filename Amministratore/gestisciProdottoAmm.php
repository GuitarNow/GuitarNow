
<?php
include('../PHP/back/Session.php');
require_once('../PHP/back/ManageProdotti.php');

$web_page = file_get_contents('templateAmm.html');

$web_page = str_replace('<title_page/>', "Gestisci Prodotti Amministrazione", $web_page);

$web_page = str_replace('<breadcrumbs_to_insert/>', "Gestisci Prodotti - Amministrazione", $web_page);

$web_page = str_replace('<contenuto_to_insert/>', '<div id="contenutoRegistrati" class="contenuto">
    <form method="post" class="form" >
    <fieldset>
    
    <img src="../Images/logo_bianco.png" alt="" />
    <label for="codice">Codice</label>
    <input type="text" name="codice" id="codice" placeholder="auto" /> 
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
    <textarea rows=“40" cols="40" name="message"> </textarea>
    <label for="immagine">Importa immagine</label>
    <input type="file"  enctype= “multipart/form-data” id="file" />
    <label for="prezzo">Prezzo</label>
    <input type="text" name="prezzo" id="prezzo" />
    <input type="submit" name="Salva" value="Salva Prodotto" id="Salva" />
    <input type="submit" name="Annulla" value="Annulla" id="Annulla" />
    <input type="submit" name="Elimina" value="Elimina Prodotto" id="Elimina" />
    </fieldset>
	</form>
</div>', $web_page);

echo $web_page;
?>
