<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/publicaciones.css">
    <link rel="stylesheet" href="../../../css/stylsrec.css"/>
  
    <title>Pagina Principal</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="../../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>
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

  <li class="nav-item">
    <a class="nav-link   active" aria-current="page" href="actualizar_evento.php">Eventos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active" aria-current="page" href="actualizar_noticia.php">Noticias</a>
  </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../../../admin/cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container ">
                <div class="row">
                    <div class="col-md-12 text-center">
                    <section class="main-container">
        <div class="form-wrapper">
            <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
                            ¡Creado con exitoso!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                } elseif ($_GET['status'] == 'error') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="autoCloseAlert">
                            Algo salió mal. Por favor verifique los datos y vuelva a intentarlo.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }
              }
            ?>
            <h1 class="text-center mb-5 ">Subir Evento o Noticia </h1>
            <div class="form-container">
            <form action="../funciones/crearevento.php" method="post" enctype="multipart/form-data" class="upload-form">
    <div class="image-upload">
        <h2>Subir Evento</h2>
        <div class="form-group">
            <label for="image">Imagen:</label>
            <input id="image" class="form-control" type="file" name="imagen" required>
        </div>
        <div class="form-group">
            <label for="event-name">Nombre del Evento:</label>
            <input id="event-name" class="form-control" type="text" name="evento" placeholder="Nombre del evento" required>
        </div>
        <div class="form-group">
            <label for="event-date">Fecha del Evento:</label>
            <input id="event-date" class="form-control" type="date" name="fecha_evento" required>
        </div>
        <input type="hidden" name="registro_num_doc" value="<?php echo $_SESSION['user']; ?>"> 
        <div class="form-group">
            <input class="submit-btn btn btn-dark" type="submit" value="Enviar">
        </div>
    </div>
</form>

                <form action="../funciones/crearnoticia.php" method="post" class="info-form">
                    <div class="info-upload">
                        <h2>Sube Noticia</h2>
                        <div class="form-group">
                            <label for="event-name">Titulo de la noticia:</label>
                            <input id="event-name" class="form-control" type="text" name="titulo" placeholder="Titulo de la noticia">
                        </div>
                        <div class="form-group">
                        <label for="event-name">Noticia:</label>
                        <textarea class="form-control" name="informacion" id="info" cols="40" rows="9" placeholder="Escribe aquí la información"></textarea>
</div>
<input type="hidden" name="registro_num_doc" value="<?php echo $_SESSION['user']; ?>">
                        <div class="form-group">
                            <input class="submit-btn btn btn-dark" type="submit" value="Enviar">
                        </P>
                    </div>
                </form>
            </div>
        </div>
    </section>
                    </div>
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
     <script src="../java/alertas.js"></script>
</body>

</html>
