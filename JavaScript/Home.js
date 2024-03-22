const reser = document.querySelector('#reservation')
const menu_res = document.querySelector('#reservationBox')
const close_res = document.querySelector('#closeButton')

reser.addEventListener('click' , () =>{
    menu_res.style.display = 'block';
})
close_res.addEventListener('click', () =>{
    menu_res.style.display = 'none';
})
