<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
include_once "../funciones/consultar.php";

$num_doc = isset($_GET['num_doc']) ? $_GET['num_doc'] : ''; 
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
    <link rel="stylesheet" href="../css/principal.css"/>
    <title>Pagina Principal</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">

                <a href="../../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../../../admin/pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>            
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Bienvenid@</h2>
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
                                <li><a class="dropdown-item" href="../../../admin/cerrar.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

			<div class="container mt-5">
                <div class="row">
                    <div class="col-md-12 text-center">

                    <div class="container">
    <h2 class="mb-4 text-center">Formulario de Selección</h2>
    <form action="../funciones/crear.php" method="POST" class="shadow p-4 rounded bg-white">

    <?php foreach ($docentes as $docente): ?>
    <div class="mb-3">
      <input type="hidden" name="id_docente" id="id_docente_<?= $docente['id_docente'] ?>" class="form-control" value="<?= $docente['id_docente'] ?>" readonly>
    </div>
  <?php endforeach; ?>
      
      <!-- Curso -->
      <div class="mb-3">
        <label for="curso" class="form-label">Curso</label>
        <select name="cursos_id_cursos" id="curso" class="form-select" required>
          <option value="">Seleccione un curso</option>
          <?php foreach ($cursos as $curso): ?>
            <option value="<?= $curso['id_cursos'] ?>"><?= $curso['curso'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Materia -->
      <div class="mb-3">
        <label for="materia" class="form-label">Materia</label>
        <select name="materia_id_materia" id="materia" class="form-select" required>
          <option value="">Seleccione una materia</option>
          <?php foreach ($materias as $materia): ?>
            <option value="<?= $materia['id_materia'] ?>"><?= $materia['materia'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Jornada -->
      <div class="mb-3">
        <label for="jornada" class="form-label">Jornada</label>
        <select name="jornada_id_jornada" id="jornada" class="form-select" required>
          <option value="">Seleccione una jornada</option>
          <?php foreach ($jornadas as $jornada): ?>
            <option value="<?= $jornada['id_jornada'] ?>"><?= $jornada['jornada'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Botón de envío -->
      <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
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