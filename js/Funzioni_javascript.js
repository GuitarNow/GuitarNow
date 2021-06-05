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

/* FUNZIONI PER LA GESTIONE DEL FORM DELLA PAGINA DI LOGIN  */
var form_login={

    "username": [/^[A-z0-9\.\+_-]{4,10}/,"Formato dello username non corretto"],
    "password": [/^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{5,}/,"Formato della password non corretto "]
}

function validaLogin(){
   
    var corretto=true;
    for(var key in form_login){
        var input=document.getElementById(key);
        var valore=validazioneCampo(input,form_login);
        corretto= corretto && valore;
    }
    return corretto;
}


/* FUNZIONI PER IL MENU */

function menuOn(){
    var menu = document.getElementById('menu');
    var close = document.getElementById('logo_chiusura');
    var a =  document.getElementsByClassName('a_header');
    var link_c= document.getElementById('linkCorrente');
    
    if(menu.className==='menu'){
        menu.classList.remove('menu');
        menu.classList.add('menu_on');

        for(let i=0;i<=3;i++){
            document.getElementsByClassName('a_header')[i].classList.add('a_on');
        }
        link_c.classList.add('link_c');
        
    
        
        close.classList.add('dU');
    }else{
        menu.classList.remove('menu_on');
        menu.classList.add('menu');
        close.classList.remove('dU');
        
    
        for(let i=0;i<3;i++){
            document.getElementsByClassName('a_header')[i].classList.remove('a_on');
        }
        link_c.classList.remove('link_c');

    }
    
}

function menuOff(){
    menu.classList.add('menu');
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