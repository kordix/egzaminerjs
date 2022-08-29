document.querySelector('#navbarDropdownMenuLink').addEventListener('click', function(){
    document.querySelector('#navbardropdownmenu').classList.toggle('show');
})

document.querySelector('.navbar-nav').querySelector(`a[href="${window.location.pathname}"]`).classList.add('active');

document.querySelector('#hamburger').addEventListener('click', function(){
    document.querySelector('.navbar-collapse').classList.toggle('show');    

})