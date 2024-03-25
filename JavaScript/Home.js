const reser = document.querySelector('#reservation')
const menu_res = document.querySelector('#reservationBox')
const close_res = document.querySelector('#closeButton')

reser.addEventListener('click' , () =>{
    menu_res.style.display = 'block';
})
close_res.addEventListener('click', () =>{
    menu_res.style.display = 'none';
})

document.addEventListener('DOMContentLoaded', function() {
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, idx) => {
            slide.classList.toggle('active', idx === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    prevButton.addEventListener('click', prevSlide);
    nextButton.addEventListener('click', nextSlide);
});