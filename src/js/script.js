// Código para mover a imagem do globo de acordo com o mouse
const globe = document.querySelector('.globe');
document.addEventListener('mousemove', (e) => {
    let x = e.clientX / window.innerWidth * 100;
    let y = e.clientY / window.innerHeight * 100;
    globe.style.backgroundPosition = `${x}% ${y}%`;
});

// Script para slider funcionar
const slider = document.querySelectorAll('.slider');
const btnPrev = document.getElementById('prev-button');
const btnNext = document.getElementById('next-button');

let currentSlide = 0;

function hideSlider() {
    slider.forEach(item => item.classList.remove('active'))
}

function showSlider() {
    slider[currentSlide].classList.add('active')
}

function nextSlider() {
    hideSlider();
    if(currentSlide === slider.length - 1) {
        currentSlide = 0;
    } else {
        currentSlide++;
    }
    showSlider();
}

function prevSlider() {
    hideSlider();
    if(currentSlide === 0) {
        currentSlide = slider.length - 1
    } else {
        currentSlide--;
    }
    showSlider();
}

btnPrev.addEventListener('click', prevSlider);
btnNext.addEventListener('click', nextSlider);