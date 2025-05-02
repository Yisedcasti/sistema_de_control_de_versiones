<?php
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
    <link rel="stylesheet" href="../../css/grados.css"/>
    <title>Grados</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
    <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">
                <a href="actividad.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>
                <a href="asistencia.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Registro</a>
                <a href="curso.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>
                <a href="grado.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>
                <a href="jornada.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Cursos</a>
                <a href="logro.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asisitencias</a>
                <a href="materia.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="nota.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="nota.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="nota.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
                <a href="../../../admin/pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Volver</a>
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
                <main class="main-container">
        <section class="container">
            <h2>Notas Existentes</h2>
            
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center ">nombre Alumno </th>
                        <th class="text-center ">Actividad</th>
                        <th class="text-center ">Logro</th>
                        <th class="text-center ">Materia</th>
                        <th class="text-center ">nota</th>
                        <th class="text-center ">fecha_nota</th>
                        <th class="text-center " colspan="2">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><?php foreach ($notas as $nota) : ?>
                        <td class="text-center"><?php echo $nota->nombre?>   <?php echo $nota->apellido?></td>
                        <td class="text-center"><?php echo $nota->nom_actividad?></td>
                        <td class="text-center"><?php echo $nota->nombre_logro ?></td>
                        <td class="text-center"><?php echo $nota->materia?></td>
                        <td class="text-center"><?php echo $nota->nota ?></td>
                        <td class="text-center"><?php echo $nota->fecha_nota?></td>
                        <td class="actions">
                        <a type="button" class="btn " data-bs-toggle="modal" data-bs-target="#actualizar<?php echo $nota->id_nota ?>">Actualizar</a>
                        </td>
                        <td class="actions">
                        <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmarModal<?php echo $nota->id_nota ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-center mb-4">
            <a class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#crear">Crear Grado</a>
        </div>
        </section>

                    <!--crear-->

        <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearLabel">Crear Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="formulario" action="crear.php" method="POST">
                    <section class="mb-3">
                  <label for="registro_num_doc">Alumno</label>
                        <select  class="form-control" name="registro_num_doc" id="registro_num_doc" required>
                            <option selected disabled>Seleccione Alumno</option>
                            <?php foreach ($registros as $registro): ?>
                                <option value="<?= $registro['num_doc'] ?>"><?= $registro['nombre'] ?>  <?= $registro['apellido'] ?></option>
                            <?php endforeach; ?>
        </select>
                            </section>
        <section class="mb-3">
        <label for="actividades_id_actividades" >Actividad</label>
                        <select  class="form-control" name="actividades_id_actividades"  id="actividades_id_actividades"  required>
                            <option selected disabled>Seleccionar Actvidad</option>
                            <?php foreach ($actividades as $actividad): ?>
                            <option value="<?= $actividad['id_actividad'] ?>"><?= $actividad['nom_actividad'] ?> </option>
                            <?php endforeach; ?>
        </select>
                            </section>
        <section class="mb-3">
                                <label for="curso">Ingrese nota</label>
                                <input type="number" name="nota" class="form-control" required>
                            </section>
                            <section class="mb-3">
                                <label for="curso">Ingrese fecha de la nota </label>
                                <input type="date" name="fecha_nota" class="form-control" required>
                            </section>
    </section>
    <section class="btn">
        <input type="submit"name="insertar"value="Enviar">
    </section>
    </form>
                    </div>
                </div>
            </div>
        </div>

                            <!--Actualizar-->
        <?php foreach($notas as $nota): ?>
<div class="modal fade" id="actualizar<?php echo $nota->id_nota ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formActualizar" method="POST" action="Actualizar.php">
                <input type="hidden" name="id_nota" id="id_nota" value="<?php echo $nota->id_nota ?>">
                <section class="mb-3">
                  <label for="registro_num_doc">Alumno</label>
                        <select  class="form-control" name="registro_num_doc" id="registro_num_doc" required>
                            <option selected disabled>Seleccione Alumno</option>
                            <?php foreach ($registros as $registro): ?>
                                <option value="<?= $registro['num_doc'] ?>"><?= $registro['nombre'] ?>  <?= $registro['apellido'] ?></option>
                                <option value="<?= $registro['num_doc'] ?>" <?= $nota->registro_num_doc == $registro['num_doc'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($registro['nombre']) ?>   <?= htmlspecialchars($registro['apellido']) ?>
                                        </option>
                            <?php endforeach; ?>
        </select>
                            </section>
        <section class="mb-3">
        <label for="actividades_id_actividades">Actividad</label>
                        <select  class="form-control" name="actividades_id_actividades" id="actividades_id_actividades" required>
                            <option selected disabled>Seleccionar Actvidad</option>
                            <?php foreach ($actividades as $actividad): ?>
                            <option value="<?= $actividad['id_actividad'] ?>" <?= $nota->actividades_id_actividades == $actividad['id_actividad'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($actividad['nom_actividad']) ?>
                                        </option>
                            <?php endforeach; ?>
        </select>
                            </section>
        <section class="mb-3">
                                <label for="curso">Ingrese nota</label>
                                <input type="number" name="nota" class="form-control" value="<?php echo htmlspecialchars($nota->nota); ?>" required>
                            </section>
                            <section class="mb-3">
                                <label for="curso">Ingrese fecha de la nota </label>
                                <input type="date" name="fecha_nota" class="form-control" value="<?php echo htmlspecialchars($nota->fecha_nota); ?>" required>
                            </section>
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

                                    <!--ELIMINAR-->
        <?php foreach($notas as $nota): ?>
    <div class="modal fade" id="confirmarModal<?php echo $nota->id_nota ?>" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel<?php echo $nota->id_nota ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarModalLabel<?php echo $nota->id_nota ?>">Confirmar Eliminación </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="eliminar.php">
                        <input type="hidden" name="id_nota" value="<?php echo $nota->id_nota?>">
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
