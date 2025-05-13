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
    <link rel="stylesheet" href="../../../css/stylsadm.css"/>
  
    <title>Pagina Principal</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
            <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Volver</a>
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
    <a class="nav-link  text-white active" aria-current="page" href="actualizar_noticia.php">Noticias</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  text-white active" aria-current="page" href="publicaciones_crear.php">Volver</a>
  </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
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

			<div class="container mt-5">
                <div class="row">
                    <div class="">
                    <?php
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
                                    ¡Accion realizada  exitosamente!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($_GET['status'] == 'error') {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="autoCloseAlert">
                                    Algo a salido mal.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                      }
                    ?>
    <h1 class="titulo mb-4 text-center"> Actualizar Eventos</h1>

    <table class="table table-bordered text-center align-middle">
    <thead class="table-secondary">
        <tr>
            <th>Imagen </th>
            <th>Evento</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($publicacionesEventos as $publicacion): ?>
        <tr>
        <form action="../funciones/actuali.php" method="POST" enctype="multipart/form-data">
    <td>
        <!-- Imagen actual -->
        <img src="<?php echo "../../../imagenes/" . htmlspecialchars($publicacion->img); ?>" 
             alt="Imagen del evento" 
             class="img-fluid mb-2" style="width: 100px;">
        <input type="hidden" name="img_actual" value="<?php echo htmlspecialchars($publicacion->img); ?>">
        <!-- Subir nueva imagen -->
        <input type="file" name="nueva_img" class="form-control form-control-sm">
    </td>
    <td>
        <!-- Campo para el evento -->
        <input type="text" 
               name="evento" 
               value="<?php echo htmlspecialchars($publicacion->evento); ?>" 
               class="form-control border-0 bg-transparent text-center">
    </td>
    <td>
        <!-- Campo para la fecha -->
        <input type="date" 
               name="fecha_evento" 
               value="<?php echo htmlspecialchars($publicacion->fecha_evento); ?>" 
               class="form-control border-0 bg-transparent text-center">
    </td>
    <td>
        <input type="hidden" name="id_evento" value="<?php echo $publicacion->id_evento; ?>">
        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn"><i class="fas fa-edit"></i></button>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $publicacion->id_evento ?>">
        <i class="fas fa-trash-alt"></i></button>
    </td>
</form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>
        </div>
        
        <?php foreach ($publicacionesEventos as $publicacion): ?>
    <div class="modal fade" id="confirmarModal<?php echo $publicacion->id_evento ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $publicacion->id_evento ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $publicacion->id_evento ?>">Confirmar Eliminación </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="../funciones/eliminar.php">
                        <input type="hidden" name="id_evento" value="<?php echo $publicacion->id_evento ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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
