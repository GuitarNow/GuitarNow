function menuOn(){
    var menu = document.getElementById('menu');
    var close = document.getElementById('logo_chiusura');
    var a =  document.getElementsByClassName('a_header');
    var link_c= document.getElementById('linkCorrente');
    
    if(menu.className==='menu'){
        menu.classList.remove('menu');
        menu.classList.add('menu_on');

        for(let i=0;i<3;i++){
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