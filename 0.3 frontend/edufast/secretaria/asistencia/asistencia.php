<?php
include_once "consultar.php";
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}

 $id_matricula = isset($_GET['id_matricula']) ? $_GET['id_matricula'] : null;
    
 if ($id_matricula !== null) {
     $sql = "SELECT * FROM asistencia
     INNER JOIN matricula ON asistencia.matricula_id_matricula = matricula.id_matricula 
     INNER JOIN registro ON asistencia.matricula_estudiante_registro_num_doc  = registro.num_doc
     WHERE matricula_id_matricula = :id_matricula";
     $stmt = $base_de_datos->prepare($sql);
     $stmt->bindParam(':id_matricula', $id_matricula, PDO::PARAM_INT);
     $stmt->execute();
     $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
 } else {
     echo "ID de matrícula no proporcionado.";
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
    <link rel="stylesheet" href="../../css/stylsecre.css"/>
    <title>Pagina Principal</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="listados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Listado asistencia</a>
                <a href="../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>
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
  </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['nombres']; ?> <?php echo $_SESSION['apellidos']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../../admin/cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            
			<div class="container mt-5">

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
                <div class="row">
                    <div class="col-md-12 text-center">
                    <main class="main-container ">
                    <h1 class=" m-4">Asistencias</h1>
        <section class="container">
      
            <table class="table mb-5">
                <tr>
                    <th  class="text-center">Asistencia</th>
                    <th  class="text-center">Fecha_asistencia</th>
                    <th  class="text-center">Alumno</th>
                    <th  class="text-center">Acciones</th>
                </tr>
                <?php foreach ($resultado as $fila) { ?>
    <tr>
        <td class="cursos text-center mt-3"><?php echo htmlspecialchars($fila['asistencia']); ?></td>
        <td class="cursos text-center mt-3"><?php echo htmlspecialchars($fila['fecha_asistencia']); ?></td>
        <td class="cursos text-center mt-3"><?php echo htmlspecialchars($fila['nombres']); ?> <?php echo htmlspecialchars($fila['apellidos']); ?></td>
        <td class="text-center">
            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#actualizarModal<?php echo $fila['idAsistencia']; ?>"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $fila['idAsistencia']; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
<?php } ?>
            </table>
        </section>
        

<!-- actualizar -->
<?php foreach($asistencias as $asistencia): ?>
<div class="modal fade" id="actualizarModal<?php echo $asistencia->idAsistencia ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formActualizar" method="POST" action="Actualizar.php">
                    <input type="hidden" name="idAsistencia" id="idAsistencia" value="<?php echo $asistencia->idAsistencia ?>">
                    <div class="form-group mt-3">
    <label for="registro_num_doc" class="form-label">Estudiante</label>
    <input type="text" class="form-control border-dark bg-transparent text-center" id="nombre" name="nombre" value="<?php echo $asistencia->nombres ?> <?php echo $asistencia->apellidos ?>" readonly>
    <input type="hidden" class="form-control border-dark bg-transparent text-center" id="matricula_id_matricula" name="matricula_id_matricula" value="<?php echo $asistencia->matricula_id_matricula ?> " readonly>
      </div>
                    <div class="mb-3 mt-3">
                        <label for="fecha_asistencia" class="form-label">Fecha Asistencia</label>
                        <input type="text" class="form-control border-dark bg-transparent text-center" id="fecha_asistencia" name="fecha_asistencia" value="<?php echo $asistencia->fecha_asistencia?>" readonly>
                    </div>
                    <div class="mb-3 mt-3">
    <label for="asistencia" class="form-label">Asistencia</label>
    <div class="form-check">
        <input class="form-check-input border-dark" type="radio" name="asistencia" id="Presente" value="Presente" <?php echo ($asistencia->asistencia == 'Presente') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="Presente">
            Presente
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input border-dark" type="radio" name="asistencia" id="Ausente" value="Ausente" <?php echo ($asistencia->asistencia == 'Ausente') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="Ausente">
            Ausente
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input border-dark" type="radio" name="asistencia" id="justificado" value="Justificado" <?php echo ($asistencia->asistencia == 'Justificado') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="Justificado">
            Justificado
        </label>
    </div>
</div>

            
                    <div class="modal-footer mt-3 justify-content-center">
                    <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


                            <!--Eliminar-->
<?php foreach($asistencias as $asistencia): ?>
    <div class="modal fade" id="confirmarModal<?php echo $asistencia->idAsistencia ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $asistencia->idAsistencia ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $asistencia->idAsistencia?>">Confirmar Eliminación <?php echo $asistencia->asistencia ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="eliminar.php">
                        <input type="hidden" name="idAsistencia" value="<?php echo $asistencia->idAsistencia ?>">
                        <input type="hidden" class="form-control border-dark bg-transparent text-center" id="matricula_id_matricula" name="matricula_id_matricula" value="<?php echo $asistencia->matricula_id_matricula ?> " readonly>
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
