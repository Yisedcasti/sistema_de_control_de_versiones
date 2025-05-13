<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}

include_once "consulta.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/grados.css"/>
    <link rel="stylesheet" href="../../../css/stylscoor.css"/>
    <title>Grados</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
    <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="../../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
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
                <main class="main-container">
        <section class="container">
            <h2 class=" text-white mb-4">Grados Existentes</h2>
            
            <table class="table Regular shadow">
                <thead>
                    <tr>
                        <th class="text-center ">Grado</th>
                        <th class="text-center ">Nivel eduacativo</th>
                        <th class="text-center " colspan="2">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><?php foreach ($grados as $grado) : ?>
                        <td class="text-center"><a class="text-reset" href="../../cursos/Curso.php?id_grado=<?php echo $grado->id_grado; ?>"><?php echo $grado->grado?></a></td>
                        <td class="text-center"><?php echo $grado->nivel_educativo?></td>

                        <td class="text-center">
                        <a class="text-primary" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#actualizar<?php echo $grado->id_grado ?>">Actualizar</a>
                        </td>
                        <td class="actions">
                        <a class="text-danger" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $grado->id_grado ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center mb-4">
            <a class="btn btn-dark Regular shadow" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Grado</a>
        </div>
        </section>
       <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title title-center" id="crearLabel">Crear Grado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form class="formulario" action="../controladores/grados_controlador.php" method="POST">
          <input type="hidden" name="accion" value="crear">

          <div class="mb-3">
            <label class="form-label d-block">Seleccione el nivel educativo</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="Primaria" value="Primaria" name="nivel_educativo">
              <label class="form-check-label" for="Primaria">Primaria</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="Bachillerato" value="Bachillerato" name="nivel_educativo">
              <label class="form-check-label" for="Bachillerato">Bachillerato</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Seleccione los grados que tiene en Primaria</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="cero" value="0°" name="grado[]">
              <label class="form-check-label" for="cero">0º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="primero" value="1°" name="grado[]">
              <label class="form-check-label" for="primero">1º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="segundo" value="2°" name="grado[]">
              <label class="form-check-label" for="segundo">2º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="tercero" value="3°" name="grado[]">
              <label class="form-check-label" for="tercero">3º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="cuarto" value="4°" name="grado[]">
              <label class="form-check-label" for="cuarto">4º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="quinto" value="5°" name="grado[]">
              <label class="form-check-label" for="quinto">5º</label>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Seleccione los grados que tiene en Bachillerato</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="sexto" value="6°" name="grado[]">
              <label class="form-check-label" for="sexto">6º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="septimo" value="7°" name="grado[]">
              <label class="form-check-label" for="septimo">7º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="octavo" value="8°" name="grado[]">
              <label class="form-check-label" for="octavo">8º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="noveno" value="9°" name="grado[]">
              <label class="form-check-label" for="noveno">9º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="decimo" value="10°" name="grado[]">
              <label class="form-check-label" for="decimo">10º</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="once" value="11°" name="grado[]">
              <label class="form-check-label" for="once">11º</label>
            </div>
          </div>

          <div class="text-center">
            <input type="submit" name="insertar" value="Enviar" class="btn btn-primary">
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


        <?php foreach($grados as $grado): ?>
<div class="modal fade" id="actualizar<?php echo $grado->id_grado ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formActualizar" method="POST" action="../funciones/Actualizar.php">
                <input type="hidden" name="id_grado" id="id_grado" value="<?php echo $grado->id_grado ?>">
              <select class="form-control" id="nivel_educativo" name="nivel_educativo">
                <option <?= $grado->nivel_educativo == 'Primaria' ? 'selected' : '' ?>>Primaria</option>
                <option <?= $grado->nivel_educativo == 'Bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
                </select>
                <section class="grado">
    <p>Seleccione los grados disponibles:</p>
    <select class="form-control" name="grado" id="grado" required>
    <option value="0°" <?= $grado->grado == '0°' ? 'selected' : '' ?>>0º</option>
    <option value="1°" <?= $grado->grado == '1°' ? 'selected' : '' ?>>1º</option>
    <option value="2°" <?= $grado->grado == '2°' ? 'selected' : '' ?>>2º</option>
    <option value="3°" <?= $grado->grado == '3°' ? 'selected' : '' ?>>3º</option>
    <option value="4°" <?= $grado->grado == '4°' ? 'selected' : '' ?>>4º</option>
    <option value="5°" <?= $grado->grado == '5°' ? 'selected' : '' ?>>5º</option>
    <option value="6°" <?= $grado->grado == '6°' ? 'selected' : '' ?>>6º</option>
    <option value="7°" <?= $grado->grado == '7°' ? 'selected' : '' ?>>7º</option>
    <option value="8°" <?= $grado->grado == '8°' ? 'selected' : '' ?>>8º</option>
    <option value="9°" <?= $grado->grado == '9°' ? 'selected' : '' ?>>9º</option>
    <option value="10°" <?= $grado->grado == '10°' ? 'selected' : '' ?>>10º</option>
    <option value="11°" <?= $grado->grado == '11°' ? 'selected' : '' ?>>11º</option>
    </select>
</section>
                    <div class="modal-footer mt-3 justify-content-center">
                    <button type="submit" class="btn btn-dark r">Actualizar</button>
        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


        <?php foreach($grados as $grado): ?>
    <div class="modal fade" id="confirmarModal<?php echo $grado->id_grado ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $grado->id_grado ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $grado->id_grado ?>">Confirmar Eliminación </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="../funciones/eliminar.php">
                        <input type="hidden" name="id_grado" value="<?php echo $grado->id_grado ?>">
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
