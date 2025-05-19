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

  // Validar todo el formulario antes de enviarlo
  function validarFormulario() {
    let esValido = true;

    // Selecciona todos los inputs y verifica cada uno
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

    return esValido; 
  }