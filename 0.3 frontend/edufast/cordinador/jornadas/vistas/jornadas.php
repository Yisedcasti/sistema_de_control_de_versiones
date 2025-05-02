<?php
include_once "consultar.php"; 
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
    <link rel="stylesheet" href="../../../css/stylscoor.css"/>
    <title>jornadas</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
    <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">

                <a href="../../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="../../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>
                <a href="../../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
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
                            <a class="nav-link dropdown-toggle  text-white fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container mt-5 ms-4 ">
                <div class="row">
                    <?php
                     if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="autoCloseAlert">
                                    ¡Accion realizada exitosamente!
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
                <main class="container">
        <h1 class="text-center mb-4  text-white">Gestión de Jornadas</h1>

        <!-- Verificar si hay jornadas -->
        <?php if (!empty($jornadas)) : ?>
            <div class="row ">
                <?php foreach ($jornadas as $jornada) : ?>
                   <div class="card Regular shadow ms-3 mb-3" style="width: 18rem;">
  <img src="../../../imagenes/mañana.jpg" width="140px" class="rounded d-bloc mt-4 ms-5 me-4" alt="...">
  <div class="card-body">
 <h5 class="card-title text-center">Jornada</h5>
 <p class="text-center"><?php echo htmlspecialchars($jornada->jornada); ?></p>
  <table class="table ">
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?php echo htmlspecialchars($jornada->hora_inicio); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($jornada->hora_final); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Inicio</td>
                                            <td class="text-center">Fin</td>
                                        </tr>
                                    </tbody>
                                </table>
 <div class="d-flex justify-content-center ">
                                <a  class="btn btn-dark Regular shadow"  data-bs-toggle="modal" data-bs-target="#actualizar<?php echo $jornada->id_jornada?>">Actualizar</a>
                                <a  class="btn btn-danger ms-5 Regular shadow" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $jornada->id_jornada ?>">Eliminar</a>
                                </div>
  </div>
</div>
  <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-center">No se encontraron jornadas.</p>
        <?php endif; ?>
        <div class="d-flex justify-content-center ">
        <a class="btn btn-dark mb-4 Regular shadow" type="button"  data-bs-toggle="modal" data-bs-target="#crear">Crear Actividad</a>
        </div>
        
        <!-- MODEL CREAR-->
<div class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <header>
            <h1>Actualizar jornada</h1>
        </header>
        <form class="formulario" action="../funciones/crear.php" method="POST">
            <section class="jornada">
            <label for="jornada">Jornada</label>
                        <select name="jornada" id="jornada" required>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noche">Noche</option>
                            <option value="Unica">Unica</option>
                        </select>
            </section>

            <section class="time">
                <label for="hora_inicio">Hora de Inicio:</label>
                <input type="time" id="hora_inicio" name="hora_inicio" >
            </section>

            <section class="time">
                <label for="hora_final">Hora Final:</label>
                <input type="time" id="hora_final" name="hora_final" >
            </section>

            <section class="btn">
                <input type="submit" name="insertar" value="Crear">
            </section>
        </form>
            </div>
        </div>
    </div>
</div>

        
        <!-- MODEL ACTUALIZAR-->
        
        <?php foreach($jornadas as $jornada): ?>
            <div class="modal fade" id="actualizar<?php echo $jornada->id_jornada ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar jornada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="formulario" action="../funciones/actualizar.php" method="POST">
            <input type="hidden" name="id_jornada" value="<?= $jornada->id_jornada ?>">

            <section class="jornada">
                <label>Jornadas</label>
                <select id="jornada" name="jornada">
                    <option <?= $jornada->jornada == 'Mañana'? 'selected' : '' ?>>Mañana</option>
                    <option <?= $jornada->jornada == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                    <option <?= $jornada->jornada == 'Noche' ? 'selected' : '' ?>>Noche</option>
                    <option <?= $jornada->jornada == 'Unica' ? 'selected' : '' ?>>Unica</option>
                </select>
            </section>

            <section class="time">
                <label for="hora_inicio">Hora de Inicio:</label>
                <input type="time" id="hora_inicio" name="hora_inicio" value="<?= $jornada->hora_inicio ?>">
            </section>

            <section class="time">
                <label for="hora_final">Hora Final:</label>
                <input type="time" id="hora_final" name="hora_final" value="<?= $jornada->hora_final ?>">
            </section>

            <section class="btn">
                <input type="submit" name="insertar" value="Actualizar">
            </section>
        </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
            
        <!-- Modal de ELIMINACIÓN -->
        <?php foreach($jornadas as $jornada): ?>
            <div class="modal fade" id="confirmarModal<?php echo $jornada->id_jornada ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta jornada?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="../funciones/jornadaEliminar.php">
                        <input type="hidden" name="id_jornada" value="<?php echo $jornada->id_jornada ?>">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script src="../java/validaciones.js"></script>
</body>

</html>