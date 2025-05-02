<?php
include_once "consultar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../css/actividad.css">
    <link rel="stylesheet" href="../../css/nav.css"/>
    <title>Pagina Principal</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">

                <a href="../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</>
                <a href="../registro/view/index_registros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Registro</a>
                <a href="../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../asistencia/listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>
                <a href="../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../Observador/view/vista_o.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observador</a>
                <a href="../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../../admin/pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Volver</a>            </div>
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
                                <i class="fas fa-user me-2"></i>Maria Camila Torres Jaramillo
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Salir</a></li>
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
                    <div class="col-md-12 text-center">
                    <main class="main-container ">
      <h1 class="title text-center mt-3">Actividades</h1>
    <section class="row p-3">
    <?php foreach ($actividades as $actividad) : ?>
        <section class="col -lg- 4 col-md-3 col-sm-6 col-12 mb-4">
          <section class="card">
            <section class="card-body">
              <h3 class="card-title text-center"><b><?php echo htmlspecialchars($actividad->nombre_act); ?></b></h3>
              <p class="card-text"><?php echo htmlspecialchars($actividad->nombre_logro); ?></p>
              <p class="card-text"><?php echo htmlspecialchars($actividad->descripcion); ?></p>
              <p class="crad-text"><?php echo htmlspecialchars($actividad->fecha_entrega); ?></p>
              <div class="d-flex justify-content-between">

                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $actividad->id_actividad ?>">
                <i class="fas fa-trash-alt"></i></button>
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#actualizarModal<?php echo $actividad->id_actividad ?>">
    <i class="fas fa-edit"></i>
</button>

            </div>
            </section>
            </section>
            </section>
            <?php endforeach; ?>
             <!-- Botón Crear  -->
        <div class="d-flex justify-content-center mb-4">
            <a class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Curso</a>
        </div>
          </section>


<!-- actualizar -->
<?php foreach($actividades as $actividad): ?>
<div class="modal fade" id="actualizarModal<?php echo $actividad->id_actividad ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formActualizar" method="POST" action="Actualizar.php">
                    <input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $actividad->id_actividad ?>">
                    <div class="mb-3">
                        <label for="nom_actividad" class="form-label">Nombre de la Actividad</label>
                        <input type="text" class="form-control" id="nom_actividad" name="nom_actividad" value="<?php echo $actividad->nombre_act ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="descrip_actividad" class="form-label">Descripción de la Actividad</label>
                        <input type="text" class="form-control" id="descrip_actividad" name="descrip_actividad" value="<?php echo $actividad->descripcion ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?php echo $actividad -> fecha_entrega ?>" required>
                    </div>
                    <div class="form-group">
    <label for="codigo_logro">Logro</label>
    <select class="form-control" name="codigo_logro" id="codigo_logro" required>
        <?php foreach ($logros as $logro): ?>
            <option value="<?= $logro['id_logro'] ?>" 
                <?= isset($_POST['id_logro']) && $_POST['id_logro'] == $logro['id_logro'] ? 'selected' : '' ?>>
                <?= $logro['nombre_logro'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
                    <div class="modal-footer mt-3 justify-content-center">
                    <button type="submit" class="btn btn-dark r">Actualizar</button>
        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

          <!-- FORMULARIO CREAR -->
<div class="modal fade" id="crear" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloformulario" aria-hidden="true">
<?php if (!empty($mensaje)): ?>
        <div class="alert <?= $claseAlerta; ?> alert-dismissible fade show" role="alert">
            <?= $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloformulario">Crear Logro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="mt-5">Crear Actividad</h2>
                <form action="guardar.php" method="POST">
                    <div class="form-group">
                        <label for="actividad">Actividad</label>
                        <input type="text" class="form-control" id="actividad" name="nom_actividad" required>
                    </div>
                    <div class="form-group">
                        <label for="descrip_actividad">Descripción</label>
                        <textarea class="form-control" id="descripcion_actividad" name="descrip_actividad" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_logro">Logro</label>
                        <select class="form-control" name="codigo_logro" id="codigo_logro" required>
                            <?php foreach ($logros as $logro): ?>
                                <option value="<?= $logro['id_logro'] ?>"><?= $logro['nombre_logro'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer m-3 justify-content-cente">
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach($actividades as $actividad): ?>
    <div class="modal fade" id="confirmarModal<?php echo $actividad->id_actividad ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $actividad->id_actividad ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $actividad->id_actividad ?>">Confirmar Eliminación <?php echo $actividad->nombre_act ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="eliminar.php">
                        <input type="hidden" name="id_actividad" value="<?php echo $actividad->id_actividad ?>">
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
