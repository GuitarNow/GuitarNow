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