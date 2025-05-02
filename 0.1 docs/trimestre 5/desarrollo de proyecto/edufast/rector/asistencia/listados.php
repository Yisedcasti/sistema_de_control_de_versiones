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
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../css/stylsrec.css"/>
    <link rel="stylesheet" href="../../css/listados.css">
    <title>Página Principal</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="../publicaciones/vistas/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="../jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="../grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observadores</a>
                <a href="../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../Boletin/view/boletin.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Boletin</a>
                <a href="../pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>            </div>
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
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
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
            <div class="container mt-5">
                <h1 class="text-center text-white mb-4">Listado de Asistencias por Curso</h1>

                <div class="mb-4">
                    <label for="cursoSelect" class="form-label text-white">Curso:</label>
                    <select id="cursoSelect" class="form-select" onchange="updateTable()">
                        <option value="" disabled selected>Elige un curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= htmlspecialchars($curso['id_cursos']) ?>">
                                <?= htmlspecialchars($curso['curso']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="asistenciaForm" method="POST" action="guardar.php">
                    <table id="dataTable" class="table table-bordered text-center align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Curso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las filas de la tabla se llenarán dinámicamente -->
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-bottom bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">©2024 codeOpacity. Designed by <span>EDUFAST</span></p>
        <div class="socials d-flex justify-content-center mt-2">
            <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/plumapaulista/" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
            <a href="https://x.com/Cedidsanpablo" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" class="text-white mx-2"><i class="fab fa-google"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        const datos = <?= json_encode($matriculas) ?>;

        function updateTable() {
    const cursoId = document.getElementById("cursoSelect").value;
    const tbody = document.querySelector("#dataTable tbody");
    tbody.innerHTML = "";

    const filteredData = datos.filter(item => item.cursos_id_cursos == cursoId);

    filteredData.forEach(item => {
        const row = document.createElement("tr");

        const cellNombres = document.createElement("td");
        const cellApellidos = document.createElement("td");
        const cellCurso = document.createElement("td");
        const cellAsistencia = document.createElement("td");
        const linkNombres = document.createElement("a");
        linkNombres.href = "asistencia.php?id_matricula=" + item.id_matricula;
        linkNombres.textContent = item.nombres;  

        cellNombres.appendChild(linkNombres);
        cellApellidos.textContent = item.apellidos;
        cellCurso.textContent = item.curso;

        row.appendChild(cellNombres);
        row.appendChild(cellApellidos);
        row.appendChild(cellCurso);

        tbody.appendChild(row);
    });
}


    </script>
</body>
</html>
