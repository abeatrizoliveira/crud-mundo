document.addEventListener('DOMContentLoaded', () => {

// Código para mover a imagem do globo de acordo com o mouse
const globe = document.querySelector('.globe');
if (globe){
    document.addEventListener('mousemove', (e) => {
        let x = e.clientX / window.innerWidth * 100;
        let y = e.clientY / window.innerHeight * 100;
        globe.style.backgroundPosition = `${x}% ${y}%`;
        
    });
}


// Código para o menu sumir e aparecer
const menu = document.querySelector('.menu');
console.log("Scroll:", window.scrollY);

window.addEventListener("scroll", (event) => {
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
});

// Código para confirmar exclusão de uma cidade bonitinho
function confirmarExclusao(id) {
    Swal.fire({
        html: `
            <div class="alert-icon">
                <svg width="80" height="80" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#fff" d="M64 32.2c-4.4 0-8 3.3-8 7.3v24.8c0 4.1 3.6 7.3 8 7.3s8-3.3 8-7.3V39.5c0-4.1-3.6-7.3-8-7.3zM64 .3C28.7.3 0 28.8 0 64s28.7 63.7 64 63.7 64-28.5 64-63.7S99.3.3 64 .3zm0 121C32.2 121.3 6.4 95.7 6.4 64 6.4 32.3 32.2 6.7 64 6.7s57.6 25.7 57.6 57.3c0 31.7-25.8 57.3-57.6 57.3zm0-40.1c-4.4 0-8 3.3-8 7.3s3.6 7.3 8 7.3 8-3.3 8-7.3-3.6-7.3-8-7.3z"/>
                </svg>
            </div>
            <h2 class="alert-title">Tem certeza que deseja excluir essa cidade?</h2>
            <p class="alert-text">Essa ação não pode ser desfeita.</p>
        `,
        background: 'var(--dark-blue)',
        color: 'var(--white)',
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#4b4b4bff',
        customClass: {
            popup: 'swal-custom',
            htmlContainer: 'swal-html'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Excluído!",
                text: "Esta cidade foi excluída.",
                icon: "success",
                background: 'var(--dark-blue)',
                color: 'var(--white)',
                customClass: {
                    popup: 'swal-custom',
                    timerProgressBar: 'barra-progresso'
                },
                confirmButtonColor: '#A5DC86',
                timer: 1500,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = 'php/excluiCidade.php?id=' + id;
            });
        }
    });
}

// Código para confirmar exclusão de um país bonitinho
function confirmarExclusaoPais(id) {
    Swal.fire({
        html: `
            <div class="alert-icon">
                <svg width="80" height="80" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#fff" d="M64 32.2c-4.4 0-8 3.3-8 7.3v24.8c0 4.1 3.6 7.3 8 7.3s8-3.3 8-7.3V39.5c0-4.1-3.6-7.3-8-7.3zM64 .3C28.7.3 0 28.8 0 64s28.7 63.7 64 63.7 64-28.5 64-63.7S99.3.3 64 .3zm0 121C32.2 121.3 6.4 95.7 6.4 64 6.4 32.3 32.2 6.7 64 6.7s57.6 25.7 57.6 57.3c0 31.7-25.8 57.3-57.6 57.3zm0-40.1c-4.4 0-8 3.3-8 7.3s3.6 7.3 8 7.3 8-3.3 8-7.3-3.6-7.3-8-7.3z"/>
                </svg>
            </div>
            <h2 class="alert-title">Tem certeza que deseja excluir esse país?</h2>
            <p class="alert-text">Se ele estiver vinculado a uma cidade, a exclusão não poderá ser realizada.</p>
        `,
        background: 'var(--dark-blue)',
        color: 'var(--white)',
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#4b4b4bff',
        customClass: { popup: 'swal-custom', htmlContainer: 'swal-html' }
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('php/excluiPais.php?id=' + id)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: "Excluído!",
                            text: "O país foi excluído com sucesso.",
                            icon: "success",
                            background: 'var(--dark-blue)',
                            color: 'var(--white)',
                             customClass: {
                                popup: 'swal-custom',
                                timerProgressBar: 'barra-progresso'
                            },  
                            timer: 1500,
                            timerProgressBar: true
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            title: "Erro!",
                            text: data.message || "Não foi possível excluir o país.",
                            icon: "error",
                            background: 'var(--dark-blue)',
                            color: 'var(--white)'
                        });
                    }
                });
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
// Código para o carrossel dos países
  const carrossel = document.querySelector('.carrossel');
  const btnLeft = document.querySelector('.btn-left');
  const btnRight = document.querySelector('.btn-right');

  const cardWidth = 250 + 20;

if(carrossel && btnLeft && btnRight){

  btnRight.addEventListener('click', () => {
    carrossel.scrollBy({ left: cardWidth * 3, behavior: "smooth" });
  });

  btnLeft.addEventListener('click', () => {
    carrossel.scrollBy({ left: -(cardWidth * 3), behavior: "smooth" });
  });
}

 

// Código para INTEGRAÇÃO com a API (Rest Countries)
const cards = document.querySelectorAll('.card');
cards.forEach(card => {
    let codigo = card.dataset.codigo.toString();
    codigo = codigo.padStart(3, '0');

    fetch(`https://restcountries.com/v3.1/alpha/${codigo}`)
    .then(response => response.json())
    .then(data => {
        const pais = data[0];
        const bandeiraDiv = card.querySelector('.bandeira');
        const siglaSpan = card.querySelector('.sigla');

        const bandeiraUrl = pais.flags.png;
        const sigla = pais.cca2;

        bandeiraDiv.innerHTML = `<img src="${bandeiraUrl}" alt="Bandeira de ${pais.name.common}">`;
        siglaSpan.textContent = sigla;
    })
    .catch(error => console.error('Erro ao buscar país:', error));
}); 


const paisContainer = document.querySelector('.pais');
if (paisContainer) {
    let codigoBandeira = paisContainer.dataset.codigo.toString();
    codigoBandeira = codigoBandeira.padStart(3, '0');
    const bandeiraDiv = paisContainer.querySelector('.bandeira');
    const nomeDiv = paisContainer.querySelector('.nome-oficial');

    fetch(`https://restcountries.com/v3.1/alpha/${codigoBandeira}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`País com código ${codigoBandeira} não encontrado na API.`);
        }
        return response.json();
    })
    .then(data => {
        const pais = data[0];
        const nome = pais.translations.por.official;
        const bandeiraUrl = pais.flags.png;
        bandeiraDiv.innerHTML = `<img src="${bandeiraUrl}" alt="Bandeira de ${pais.name.common}">`;
        nomeDiv.textContent = nome;
    })
    .catch(error => console.error('Erro ao buscar país:', error));
} else {
    console.error("Elemento '.pais' não encontrado na página.");
}

});