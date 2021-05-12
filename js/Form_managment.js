var form_registrazione = {

    "email": [/^[A-z0-9\.\+_-]+@+[A-z0-9\._-]+\.+[A-z]{2,6}/,"Formato della email non corretto"],
    "username": [/[A-z0-9\.\+_-]{4,10}/,"Formato dello username non corretto"],
    "password": [/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/,"La password deve contenere almeno un numero, una lettera maiuscola e una minusola "]
};







function mostraErrore(input){

    
    var elemento=document.createElement("strong");
    elemento.className="errore";
    elemento.appendChild(document.createTextNode(form_registrazione[input.id][1]));
    var p=input.parentNode; 
    p.appendChild(elemento);


}


function validazioneCampoRegistrazione(input){
    
    //Reset messaggio d'errore
    var parent=input.parentNode;
    if(parent.children.lenght==2){
        parent.removeChild(parent.children[0]);
    }
    
    //Mostro messaggio d'errore
    var regex=form_registrazione[input.id][0];
    
    var valore=input.value;
    if(valore.search(regex) != 0)
    {
        mostraErrore(input);
        return false;
    }
    else
    {
        return true;
    }
}
 

function validaRegistrazione(){
   
    var corretto=true;
    for(var key in form_registrazione){
        var input=document.getElementById(key);
        var valore=validazioneCampoRegistrazione(input);
        corretto= corretto && valore;
    }
    return corretto;
}