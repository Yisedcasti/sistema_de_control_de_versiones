setTimeout(() => {
    const alert = document.getElementById('autoCloseAlert');
    if (alert) {
        // Remueve las clases 'show' para iniciar la animación de desvanecimiento
        alert.classList.remove('show');

        // Opcional: Remueve el elemento del DOM después de la animación (500ms de duración predeterminada en Bootstrap)
        setTimeout(() => alert.remove(), 500);
    }
}, 2000);