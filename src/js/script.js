// Código para mover a imagem do globo de acordo com o mouse
const globe = document.querySelector('.globe');
document.addEventListener('mousemove', (e) => {
    let x = e.clientX / window.innerWidth * 100;
    let y = e.clientY / window.innerHeight * 100;
    globe.style.backgroundPosition = `${x}% ${y}%`;
});


// Código para o menu sumir e aparecer
const menu = document.querySelector('.menu');
console.log("Scroll:", window.scrollY);

addEventListener("scroll", (event) => {
    if(window.scrollY > 100){
        menu.classList.add('hiden');
    }else{
        menu.classList.remove('hiden');
    }
 })
 

// Código para a animação só funcionar quando estiver lá na imagem
function handleIntersection(entries, observer) {
    entries.forEach(entry => {
        if (entry.isIntersecting) { 
            entry.target.classList.add('animado');
            observer.unobserve(entry.target); 
        }
    });
}
const elementoParaAnimar = document.querySelector('.right img');

const observer = new IntersectionObserver(handleIntersection, {
    threshold: 0.1 
});
if (elementoParaAnimar) {
    observer.observe(elementoParaAnimar);
}