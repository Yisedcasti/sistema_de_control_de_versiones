// Validación en el input mientras escribes
document.getElementById('password').addEventListener('input', function () {
  const password = this.value;
  const errorDiv = document.getElementById('error-password');

  // Expresión regular para una contraseña segura
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

  // Validar la contraseña
  if (!regex.test(password)) {
      errorDiv.style.display = 'block'; // Mostrar el error
      errorDiv.textContent = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.';
  } else {
      errorDiv.style.display = 'none'; // Ocultar el error si es válida
  }
});

// Validación cuando intentas enviar el formulario
function validarFormulario() {
  const password = document.getElementById('password').value;
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

  // Validar la contraseña
  if (!regex.test(password)) {
      alert('La contraseña no cumple con los requisitos.');
      return false; // Evitar el envío del formulario si es incorrecta
  }

  return true; // Permitir el envío si es correcta
}
