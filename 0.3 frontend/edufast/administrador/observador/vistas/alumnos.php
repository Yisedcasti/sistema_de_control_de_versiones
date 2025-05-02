<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}
include_once "../funciones/consultar.php";

$busqueda = isset($_GET['num_doc']) ? $_GET['num_doc'] : ''; 
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
                    <div class="d-flex justify-content-end mb-5">
    <form method="GET" class="d-flex">
        <input type="text" name="num_doc" class="form-control w-50" placeholder="Ingrese número de documento" 
            value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit" class="btn btn-primary ms-2">Buscar</button>
    </form>
</div>


    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="mb-3">Alumnos sin curso y grado</h3>
            <div class="table-responsive">
                <table class="table table-hover rounded shadow table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nivel educativo</th>
                            <th>Grado cursado</th>
                            <th>Número de Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $registro) : ?>
                            <tr>
                                <td class="text-center"><?php echo $registro->NIvel_educativo; ?></td>
                                <td class="text-center"><?php echo $registro->grado_cursado; ?></td>
                                <td class="text-center">
                                    <a class="text-reset" href="observador.php?num_doc=<?php echo $registro->num_doc; ?>">
                                        <?php echo $registro->num_doc; ?>
                                    </a>
                                </td>
                                <td class="text-center"><?php echo $registro->nombres; ?></td>
                                <td class="text-center"><?php echo $registro->apellidos; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($registros)) echo "<p class='text-muted'>No se encontraron resultados.</p>"; ?>
            </div>
        </div>

        <!-- Tabla de Alumnos con curso y grado -->
        <div class="col-md-12 text-center mt-5">
            <h3 class="mb-3">Alumnos con curso y grado</h3>
            <div class="table-responsive">
                <table class="table table-hover rounded shadow table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Número de Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Grado</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estudiantes as $estudiante) : ?>
                            <tr>
                                <td class="text-center">
                                    <a class="text-reset" href="observador.php?num_doc=<?php echo $estudiante['num_doc']; ?>">
                                        <?php echo $estudiante['num_doc']; ?>
                                    </a>
                                </td>
                                <td class="text-center"><?php echo $estudiante['nombres']; ?></td>
                                <td class="text-center"><?php echo $estudiante['apellidos']; ?></td>
                                <td class="text-center"><?php echo $estudiante['nombre_grado']; ?></td>
                                <td class="text-center"><?php echo $estudiante['nombre_curso']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($estudiantes)) echo "<p class='text-muted'>No se encontraron resultados.</p>"; ?>
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