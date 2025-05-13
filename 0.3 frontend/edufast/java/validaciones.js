function validarTiempoReal(input) {
  // Elimina caracteres no numéricos
  input.value = input.value.replace(/\D/g, '');

  const min = parseInt(input.getAttribute('data-min'), 10);
  const max = parseInt(input.getAttribute('data-max'), 10);
  const errorDiv = input.nextElementSibling;

  // Limitar la longitud al máximo permitido
  if (input.value.length > max) {
    input.value = input.value.slice(0, max);
  }

  // Validar si la longitud está dentro del rango
  if (input.value.length < min || input.value.length > max) {
    errorDiv.style.display = 'block';
  } else {
    errorDiv.style.display = 'none';
  }
}


function validarLongitud(input) {
      // Elimina caracteres no numéricos
      input.value = input.value.replace(/\D/g, '');

      // Longitud requerida desde atributo data-length
      const longitudRequerida = parseInt(input.getAttribute('data-length'), 10);

      // Limitar al máximo permitido
      if (input.value.length > longitudRequerida) {
        input.value = input.value.slice(0, longitudRequerida);
      }

      // Mostrar u ocultar el mensaje de error
      const errorDiv = input.nextElementSibling;
      if (input.value.length !== longitudRequerida) {
        errorDiv.style.display = 'block';
      } else {
        errorDiv.style.display = 'none';
      }
    }

    // Validar contraseña mientras escribes
    document.getElementById('password').addEventListener('input', function () {
      const password = this.value;
      const errorDiv = document.getElementById('error-password');
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

      if (!regex.test(password)) {
        errorDiv.style.display = 'block';
        errorDiv.textContent = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.';
      } else {
        errorDiv.style.display = 'none';
      }
    });

    // Validar todo el formulario al enviar
    function validarFormulario() {
      let esValido = true;

      // Validar campos con data-length
      const campos = document.querySelectorAll('input[data-length]');
      campos.forEach(input => {
        const longitud = parseInt(input.getAttribute('data-length'), 10);
        const errorDiv = input.nextElementSibling;
        input.value = input.value.replace(/\D/g, '');

        if (input.value.length !== longitud) {
          errorDiv.style.display = 'block';
          esValido = false;
        } else {
          errorDiv.style.display = 'none';
        }
      });

      // Validar contraseña
      const password = document.getElementById('password').value;
      const errorDivPassword = document.getElementById('error-password');
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

      if (!regex.test(password)) {
        errorDivPassword.style.display = 'block';
        errorDivPassword.textContent = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.';
        esValido = false;
      } else {
        errorDivPassword.style.display = 'none';
      }

      if (!esValido) {
        alert('Por favor corrige los errores antes de enviar el formulario.');
      }

      return esValido;
    }