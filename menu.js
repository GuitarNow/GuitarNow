function menuOn(){
    var menu = document.getElementById('menu');
    var close = document.getElementById('logo_chiusura');
    var a =  document.getElementsByClassName('a_header');
    
    if(menu.className==='menu'){
        menu.classList.remove('menu');
        menu.classList.add('menu_on');
        /*
        for(var i=0;i<3;i++){
            a[i].classList.add('');
            a[i].classList.remove('');
           
        }
        */
        close.classList.remove('scompare');
        close.classList.add('dU');
    }else{
        menu.classList.remove('menu_on');
        menu.classList.add('menu');
        close.classList.remove('dU');
        close.classList.add('scompare');

    }
    
}

function menuOff(){
    menu.classList.add('menu');
}