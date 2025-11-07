document.addEventListener('DOMContentLoaded', () => {

    // Código para mover a imagem do globo de acordo com o mouse
    const globe = document.querySelector('.globe');
    if (globe) {
        document.addEventListener('mousemove', (e) => {
            let x = e.clientX / window.innerWidth * 100;
            let y = e.clientY / window.innerHeight * 100;
            globe.style.backgroundPosition = `${x}% ${y}%`;

        });
    }


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

    const cardWidth = 280 + 70;

    if (carrossel && btnLeft && btnRight) {

        btnRight.addEventListener('click', () => {
            carrossel.scrollBy({ left: cardWidth * 3, behavior: "smooth" });
        });

        btnLeft.addEventListener('click', () => {
            carrossel.scrollBy({ left: -(cardWidth * 3), behavior: "smooth" });
        });
    }

    // Código para o carrossel das cidades
    const cidades = document.querySelector('.carrossel-cidades');
    const buttonLeft = document.querySelector('.btn-left-cidades');
    const buttonRight = document.querySelector('.btn-right-cidades');

    const cidadesWidth = 220;

    if (cidades && buttonLeft && buttonRight) {

        buttonRight.addEventListener('click', () => {
            cidades.scrollBy({ left: cidadesWidth * 1, behavior: "smooth" });
        });

        buttonLeft.addEventListener('click', () => {
            cidades.scrollBy({ left: -(cidadesWidth * 1), behavior: "smooth" });
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


    // Esse código é para página de detalhe do país (tá puxando dados tipo bandeira, nome oficial, moeda e etc...)
    const paisContainer = document.querySelector('.pais-container');
    if (paisContainer) {
        
        let codigoBandeira = paisContainer.dataset.codigo.toString();
        codigoBandeira = codigoBandeira.padStart(3, '0');
        const bandeiraDiv = paisContainer.querySelector('.bandeira');
        const nomeDiv = paisContainer.querySelector('.nome-oficial');
        const capitalDiv = paisContainer.querySelector('.capital');
        const moedaDiv = paisContainer.querySelector('.moeda');
        const moedaNomeDiv = paisContainer.querySelector('.moeda-nome');

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
                const capital = pais.capital;
                const moeda = Object.values(pais.currencies)[0].symbol;
                const moedaNome = Object.values(pais.currencies)[0].name;
                const timezone = pais.timezones;
                const bandeiraUrl = pais.flags.png;
                bandeiraDiv.innerHTML = `<img src="${bandeiraUrl}" alt="Bandeira de ${pais.name.common}">`;
                nomeDiv.textContent = nome;
                capitalDiv.textContent = capital;
                moedaDiv.textContent = moeda;
                moedaNomeDiv.textContent = moedaNome;
            })
            .catch(error => console.error('Erro ao buscar país:', error));
    } else {
        console.error("Elemento '.pais' não encontrado na página.");
    }

});

// Código para chamar a API OpenWeather
const apiKey = '7caf9f0ea915b65afd4f136881e9fb5c';
const apiUrl = 'https://api.openweathermap.org/data/2.5/weather';

const imagemClima = document.querySelector('.icone-clima');
const temperatura = document.querySelector('.temperatura');
const situacao = document.querySelector('.situacao');

const weather = document.querySelector('.pais-weather');

if (weather) {
    const localPais = weather.dataset.codigo.toString();
    if (localPais) {
        fetchWeatherCity(localPais);
    }
}

const weather2 = document.querySelector('.cidade-weather');
if (weather2) {
    const localPais = weather2.dataset.codigo.toString();
    if (localPais) {
        fetchWeatherCity(localPais);
    }
}

function fetchWeatherCity(localPais) {
    const url = `${apiUrl}?q=${localPais}&appid=${apiKey}&units=metric`;
    fetchWeather(url);
}

function fetchWeather(url) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            temperatura.textContent = `${Math.round(data.main.temp)}°C`;
            situacao.textContent = data.weather[0].description;
            const weatherMain = data.weather[0].main;
            const icon = data.weather[0].icon;
            const isDay = icon.includes("d");
            atualizarImagem(weatherMain, isDay);
        })
        .catch(error => {
            console.error("Erro nos dados do tempo:", error);
            if (locationElement) {
                alert("A não! Não foi possível achar a temperatura...");
                temperatura.textContent = '';
                situacao.textContent = '';
            }
        })
}

// Função para alterar os ícones padrões da API para personalizados
function atualizarImagem(weatherMain, isDay) {
    const imagemClima = document.querySelector('.icone-clima');

    const periodo = isDay ? "day" : "night";

    const imagens = {
        "Clear_day": "../src/assets/images/clear-day.svg",
        "Clear_night": "../src/assets/images/clear-night.svg",
        "Clouds_day": "../src/assets/images/cloudy.svg",
        "Clouds_night": "../src/assets/images/cloudy.svg",
        "Rain_day": "../src/assets/images/rain.svg",
        "Rain_night": "../src/assets/images/rain.svg",
        "Drizzle_day": "../src/assets/images/drizzle.svg",
        "Drizzle_night": "../src/assets/images/drizzle.svg",
        "Thunderstorm_day": "../src/assets/images/thunderstorm.svg",
        "Thunderstorm_night": "../src/assets/images/thunderstorm.svg",
        "Snow_day": "../src/assets/images/snow.svg",
        "Snow_night": "../src/assets/images/snow.svg",
        "Tornado_day": "../src/assets/images/tornado.svg",
        "Tornado_night": "../src/assets/images/tornado.svg",
        "Mist_day": "../src/assets/images/mist.svg",
        "Mist_night": "../src/assets/images/mist.svg",
        "Fog_day": "../src/assets/images/fog.svg",
        "Fog_night": "../src/assets/images/fog.svg",
    };
    const chave = `${weatherMain}_${periodo}`;
    const imagemSelecionada = imagens[chave] || "../src/assets/images/clear-day.svg";
    imagemClima.src = imagemSelecionada;
}