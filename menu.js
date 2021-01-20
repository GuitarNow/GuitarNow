function menuOn(){
    var menu = document.getElementById('menu');
    var close = document.getElementById('logo_chiusura');
    var a =  document.getElementsByClassName('a_header');
    
    if(menu.className==='menu'){
        menu.classList.remove('menu');
        menu.classList.add('menu_on');
        for(var i=0;i<3;i++){
            a[i].classList.add('a_on');
            a[i].classList.remove('a_header');
           
        }
        close.classList.remove('dN');
        close.classList.add('dU');
        
    }else{
        menu.classList.remove('menu_on');
        menu.classList.add('menu');
        close.classList.remove('dU');
        close.classList.add('dN');

    }
    
}

function menuOff(){
    menu.classList.add('menu');
}