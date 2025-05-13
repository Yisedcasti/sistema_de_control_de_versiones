<!DOCTYPE html> 
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/inicio2.css">
    <title>Login</title>
</head>

<body>
    <header class="navbar navbar-expand-lg bg-body-tertiary containernav shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold text-success d-flex align-items-center gap-2" href="#" style="cursor: default;">
                <img src="../../imagenes/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                <span class="text-white">EDUFAST</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto fs-5">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="../../index.php">Index</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../../registro.php">Registrarse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main class="main-container">
        <div class="container mt-5 d-flex justify-content-center p-3">
            <form action="login.php" method="POST" class="col-md-6">
                <h1 class="text-center">Inicio de sesión</h1>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <?php
 if (isset($_GET['status'])) {
  if ($_GET['status'] == 'success') {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
              ¡Accion realizada exitosamente!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  } elseif ($_GET['status'] == 'error') {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="autoCloseAlert">
              Credenciales incorrectas. Por favor verifique los datos y vuelva a intentarlo.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  }
}
?>

                <div class="mb-3">
                    <label for="user" class="form-label ps-3"><b>Usuario:</b></label>
                    <input type="text" class="form-control" name="num_doc" oninput="validarTiempoReal(this)" maxlength="10" data-min="8" data-max="10" id="num_doc" type="number" placeholder="Ingresa tu numero de documento" required>
                    <div id="error" style="color: red; display: none;">El número debe tener exactamente 10 dígitos.</div>
                    <small class="form-text">Asegúrate de introducir el numero de documento correcto.</small>
                </div>

                <div class="mb-3">
                    <label for="pass" class="form-label ps-3"><b>Contraseña:</b></label>
                    <input type="password"  id="password" class="form-control" name="pass" placeholder="Ingresa tu contraseña" required>
                    <div id="error-password"></div>
                    <small class="form-text">Asegúrate de introducir la contraseña correcta.</small>
                </div>
              
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
<script>
      function validarTiempoReal(input) {
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

  // Validar contraseña mientras escribes
  document.getElementById('password').addEventListener('input', function () {
      const password = this.value;
      const errorDiv = document.getElementById('error-password');
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

      if (!regex.test(password)) {
        errorDiv.style.display = 'block';
        errorDiv.style.color = 'red'; 
        errorDiv.textContent = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.';
      } else {
        errorDiv.style.display = 'none';
      }
    });

</script>
    <script src="java/alertas.js"></script>

</html>
</html>
