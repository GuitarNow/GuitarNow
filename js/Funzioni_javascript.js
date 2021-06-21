/* FUNZIONI GENERALI PER I FORM */

function mostraErrore(input,arr){

    
    var elemento=document.createElement("strong");
    elemento.className="errore";
    elemento.appendChild(document.createTextNode(arr[input.id][1]));
    var p=input.parentNode; 
    p.appendChild(elemento);


}


function validazioneCampo(input,arr){
    
    //Reset messaggio d'errore
    
    var parent=input.parentNode;
    
    if(parent.children.length==2){
        parent.removeChild(parent.children[1]);
    }

    
    //Mostro messaggio d'errore
    var regex=arr[input.id][0];
    
    var valore=input.value;
    if(valore.search(regex) != 0)
    {
        mostraErrore(input,arr);
        return false;
    }
    else
    {
        return true;
    }
}

/* FUNZIONI PER LA GESTIONE DEL FORM DELLA PAGINA DI REGISTRAZIONE  */
var form_registrazione = {

    "email": [/^[A-z0-9\.\+_-]+@+[A-z0-9\._-]+\.+[A-z]{2,6}/,"Formato della email non corretto"],
    "username": [/^[A-z0-9\.\+_-]{4,10}/,"Lo username deve essere di almeno 4 e massimo 10 caratteri."],
    "password": [/^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{5,}/,"La password deve contenere almeno una lettera maiuscola, una minusola e contenere almeno 5 caratteri"]
};


function validaRegistrazione(){
   
    var corretto=true;
    for(var key in form_registrazione){
        var input=document.getElementById(key);
        var valore=validazioneCampo(input,form_registrazione);
        corretto= corretto && valore;
    }
    return corretto;
}

/* FUNZIONI PER LA GESTIONE DEL FORM IN CREA PRODOTTO (CHITARRA)  */
var formCreaChitarra={
    "produttoreCrea":[/^[A-z0-9\.\+_-]{2,15}/,"Il produttore deve essere di almeno 2 caratteri e massimo 15 "],
    "tipologiaCrea":[/^[A-z0-9\.\+_-]{2,15}/,"La tipologia deve essere di almeno 2 caratteri e massimo 15 "],
    "legnoManicoCrea":[/^[A-z0-9\.\+_-]{2,10}/,"Il legno manico deve essere di almeno 2 caratteri e massimo 10 "],
    "legnoCorpoCrea":[/^[A-z0-9\.\+_-]{2,10}/,"Il legno corpo deve essere di almeno 2 caratteri e massimo 10 "],
    "modelloCrea": [/^[A-z0-9\.\+_-]{2,15}/,"Il modello deve essere di almeno 2 caratteri e massimo 15 "],
    "descrizioneCrea":[/^[A-z0-9\.\+_-]{5,500}/,"La descrizone deve essere di almeno 5 caratteri e massimo 500 "],
    "short_descCrea": [/^[A-z0-9\.\+_-]{5,100}/,"L'alt deve essere di almeno 5 caratteri e massimo 100 "],
    "long_descCrea":[/^[A-z0-9\.\+_-]{5,500}/,"La longdesc deve essere di almeno 5 caratteri e massimo 500 "],
    "prezzoCrea":[/^[0-9]+(\.[0-9]{1,2})?/,"Formato prezzo non valido"]
}

function validaCreaProdotto(){
   
    var corretto=true;
    for(var key in formCreaChitarra){
        var input=document.getElementById(key);
        var valore=validazioneCampo(input,formCreaChitarra);
        corretto= corretto && valore;
    }


    return corretto;
}


/* FUNZIONI PER IL MENU */



function funzioneMenu() {
    var x = document.getElementById("myLinks");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }





/* FUNZIONI PER I FILTRI */

function dNone(){
    var el = document.getElementById('form_filtri');
    var pg =  document.getElementById('pg_prodotti');
   
    if(el.className==='dN'){
       
        el.classList.remove('dN');
        el.classList.add('dU');
        pg.classList.remove('margin_less');
        pg.classList.add('margin_plus');
    }
     else{
        el.classList.remove('dU');
        el.classList.add('dN');
        pg.classList.remove('margin_plus');
        pg.classList.add('margin_less');
     }
}


function eliminaProdotto(id){
    if (confirm('Vuoi eliminare il prodotto?')) {
        var url = "PHP/back/DeleteProduct.php?prodotto="+id;
        location.href = url;
        
        console.log('Thing was saved to the database.');
      } else {
        // Do nothing!
        console.log('Thing was not saved to the database.');
      }
}

function eliminaCommento(id){
    if (confirm('Vuoi eliminare il commento?')) {
        var url = "PHP/back/DeleteCommenti.php?commento="+id;
        location.href = url;
      } else {
        // Do nothing!
      }
}