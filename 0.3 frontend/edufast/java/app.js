let atras = document.getElementById('atras');
let adelante = document.getElementById('adelante');
let imagen = document.getElementById('img');
let puntos = document.getElementById('puntos');
let texto = document.getElementById('texto');
let actual = 0;

function mostrarImagen() {
    imagen.innerHTML = `<img class="img" src="${imagenes[actual].url}" alt="Imagen carrusel" loading="lazy">`;
    texto.innerHTML = `
        <h3>${imagenes[actual].nombre}</h3>
        <p>${imagenes[actual].descripcion}</p>
    `;
    posicionCarrusel();
}

function posicionCarrusel() {
    puntos.innerHTML = "";
    imagenes.forEach((_, i) => {
        puntos.innerHTML += `<span class="${i === actual ? 'activo' : ''}">•</span>`;
    });
}

atras.addEventListener('click', () => {
    actual = (actual - 1 + imagenes.length) % imagenes.length;
    mostrarImagen();
});

adelante.addEventListener('click', () => {
    actual = (actual + 1) % imagenes.length;
    mostrarImagen();
});

mostrarImagen();
