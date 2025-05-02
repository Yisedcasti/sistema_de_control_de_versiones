<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
 include_once "../funciones/consulta.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/nav.css"/>
  
    <title>Perfil</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="../../observador/vistas/observador.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">observador</a>
                <a href="../../asistencia/asistencia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>
                <a href="../../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>

            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Bienvenido</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../../cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container">
                <div class="row">
                    <div class="cols-1 cols-md-2 cols-lg-3 g-4  ">
                    <div class="container perfil">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-body text-center">

          <form action="../funciones/actualizarDatos.php" method="POST" enctype="multipart/form-data">

            <?php foreach ($perfiles as $perfil): ?>
                <div class="foto mb-4">
            <img class="rounded-5 mt-5 mb-2" src="<?php echo "../../../imagenes/" . htmlspecialchars($perfil->foto_perfil); ?>" 
            alt="Imagen de Perfil" class="profile-img mb-3" style="width: 100px; height: auto;">
            <input type="hidden" name="foto_perfil" value="<?php echo htmlspecialchars($perfil->foto_perfil); ?>">
            <input type="file" name="nueva_img" class="form-control form-control-sm">
            </div>

            <style>
                .perfil{
                    width: 1000px;
                    margin-bottom: 90px;
                }
            </style>

     <div class="d-flex align-items-center gap-3">
    <label class="col-form-label fs-6">Nombres y apellidos :</label>
    <p class="fs-5 mb-0 text-end"><?php echo htmlspecialchars($perfil->nombres); ?> <?php echo htmlspecialchars($perfil->apellidos); ?></p>
</div>

<div class="d-flex align-items-center gap-3">
    <label class="col-form-label fs-6">Número de documento :</label>
    <p class="fs-5 mb-0 text-end"><?php echo htmlspecialchars($perfil->num_doc); ?></p>
    <input type="hidden" 
         name="num_doc" 
         value="<?php echo htmlspecialchars($perfil->num_doc); ?>" >
</div>

<div class="d-flex align-items-center gap-3">
    <label class="col-form-label fs-6">Número de documento :</label>
    <p class="fs-5 mb-0 text-end"><?php echo htmlspecialchars($perfil->tipo_doc); ?></p>
</div>

<div class="d-flex align-items-center gap-3">
   <label class="col-form-label fs-6">Celular:</label>
   <input type="text" 
         id="celular"
         name="celular" 
         value="<?php echo htmlspecialchars($perfil->celular); ?>" 
         class="form-control fs-5 border-0 bg-transparent shadow-none text-start">
</div>

<div class="d-flex align-items-center gap-3">
   <label class="col-form-label fs-6">Telefono:</label>
   <input type="text" 
         id="Telefono"
         name="telefono" 
         value="<?php echo htmlspecialchars($perfil->telefono); ?>" 
         class="form-control fs-5 border-0 bg-transparent shadow-none text-start">
</div>
  
<div class="d-flex align-items-center gap-3">
   <label class="col-form-label fs-6">Direcciòn:</label>
   <input type="text" 
         id="direccion"
         name="direccion" 
         value="<?php echo htmlspecialchars($perfil->direccion); ?> " 
         class="form-control fs-5 border-0 bg-transparent shadow-none text-start">
</div>
<div class="d-flex align-items-center gap-3">
   <label class="col-form-label fs-6">Correo:</label>
   <input type="text" 
         id="correo"
         name="correo" 
         value="<?php echo htmlspecialchars($perfil->correo); ?>" 
         class="form-control fs-5 border-0 bg-transparent shadow-none text-start">
</div>

<div class="d-flex align-items-center gap-3">
   <label class="col-form-label fs-6"> Jornada:</label>
   <p class="fs-5 mb-0 text-end"><?php echo htmlspecialchars($perfil->jornada); ?></p>
</div>

               
            <!-- Enlaces de redes sociales -->
            <div class="mt-4">
            <button type="submit" class="btn btn-secondary">Editar</button>   
            </div>
            <?php endforeach; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
        </div>
    </main>
                </div>
            </div>

            </div>
        </div>
    </div>
<footer class="footer-bottom bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">©2024 codeOpacity. Designed by <span>EDUFAST</span></p>
        <div class="socials d-flex justify-content-center mt-2">
            <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/plumapaulista/" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/Cedidsanpablo" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" class="text-white mx-2"><i class="fab fa-google"></i></a>
        </div>
    </footer>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>
