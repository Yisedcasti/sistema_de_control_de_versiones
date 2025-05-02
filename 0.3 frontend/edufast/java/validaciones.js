// Validar tiempo real para un campo específico
function validarTiempoReal(input) {
    // Elimina caracteres no numéricos
    input.value = input.value.replace(/\D/g, '');

    // Obtén la longitud requerida desde el atributo data-length
    const longitudRequerida = parseInt(input.getAttribute('data-length'), 10);

    // Limita el número de caracteres al máximo permitido
    if (input.value.length > longitudRequerida) {
      input.value = input.value.slice(0, longitudRequerida); // Recorta al máximo permitido
    }

    // Muestra u oculta el mensaje de error dependiendo de la longitud
    const errorDiv = input.nextElementSibling; // Div inmediatamente después del input
    if (input.value.length !== longitudRequerida) {
      errorDiv.style.display = 'block'; // Muestra el mensaje de error
    } else {
      errorDiv.style.display = 'none'; // Oculta el mensaje de error si es válido
    }
  }

  function validarFormulario() {
    let esValido = true;

    // 1. Validación de los campos de texto
    const inputs = document.querySelectorAll('input[type="text"]');
    inputs.forEach(input => {
        const longitudRequerida = parseInt(input.getAttribute('data-length'), 10);
        const errorDiv = input.nextElementSibling; // Div de error asociado
        if (input.value.length !== longitudRequerida) {
            errorDiv.style.display = 'block'; // Muestra el error
            esValido = false; // Indica que hay errores
        } else {
            errorDiv.style.display = 'none'; // Oculta el error si es válido
        }
    });

    // 2. Validación de la contraseña
    const password = document.getElementById('password').value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&#*])[A-Za-z\d@$!%?&#*]{8,}$/;

    if (!regex.test(password)) {
        alert('La contraseña no cumple con los requisitos.');
        esValido = false; // Evitar el envío del formulario si la contraseña es incorrecta
    }

    return esValido; // Retorna true si todo es válido, false si hay errores
}
