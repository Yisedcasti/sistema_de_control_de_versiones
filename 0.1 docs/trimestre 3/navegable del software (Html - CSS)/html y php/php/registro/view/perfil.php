<?php
session_start();
if (!isset($_SESSION['userId'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header("Location: ../index.php");
    exit();
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

            <a href="../../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</>
                <a href="index_registros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Registro</a>
                <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>
                <a href="../../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../../Observador/view/vista_o.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observador</a>
                <a href="../../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../../../admin/pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Volver</a>            
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
                    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index_registros.php">Volver</a>
  </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['user']; ?> <?php echo $_SESSION['usera']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container">
                <div class="row">
                    <div class="cols-1 cols-md-2 cols-lg-3 g-4  ">
                    <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-body text-center">
            <?php foreach ($perfiles as $perfil): ?>
            <img src="<?php echo "../../../imagenes/" . htmlspecialchars($perfil->foto_perfil); ?>" 
            alt="Imagen de Perfil" class="profile-img mb-3" style="width: 100px;">
        <input type="hidden" name="foto_perfil" value="<?php echo htmlspecialchars($perfil->foto_perfil); ?>">
            <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($perfil->nombres); ?> <?php echo htmlspecialchars($perfil->apellidos); ?>" 
               class="form-control border-0 bg-transparent text-center fs-4">

               <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($perfil->celular); ?> " 
               class="form-control border-0 bg-transparent text-center fs-5">

               <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($perfil->telefono); ?> " 
               class="form-control border-0 bg-transparent text-center fs-5"></a>

               <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($perfil->direccion); ?> " 
               class="form-control border-0 bg-transparent text-center fs-5"></a>

               <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($perfil->correo); ?>" 
               class="form-control border-0 bg-transparent text-center fs-5">

               <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($perfil->jornada); ?>" 
               class="form-control border-0 bg-transparent text-center fs-5">
            <!-- Enlaces de redes sociales -->
            <div class="mt-4">
              <a href="#" class="btn btn-success btn-sm me-2">
                <i class="bi bi-linkedin"></i> Actualizar
              </a>
              <a href="../../observador/vistas/observador.php?num_doc=<?php echo htmlspecialchars($perfil->num_doc) ?>">Datos restantes</a>
            </div>
            <?php endforeach; ?>
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
