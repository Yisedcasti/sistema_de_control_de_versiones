<?php
include_once "actualiconsulta.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/nav.css"/>
  
    <title>Pagina Principal</title>
</head>
<body>
<style>
        .card-body{
            background-color: #ebdef0;
        }
    </style>
    <div class="d-flex" id="wrapper">

        <div class="listado" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">EDUFAST</div>
            <div class="list-group list-group-flush my-3">

                <a href="../php/publicaciones/funciones/publicaciones_crear.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publicaciones</a>

                <a href="../php/registro/funciones/registro.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Registro</a>

                <a href="../php/jornadas/vistas/jornadas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Jornadas</a>

                <a href="../php/grados/vistas/grados.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Grados</a>

                <a href="../php/cursos/curso.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Cursos</a>

                <a href="../php/asistencia/asistencia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Asistencias</a>

                <a href="../php/materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>

                <a href="../php/logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../php/actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../php/notas/notas.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Notas</a>
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

			<div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-md-12 text-center">
                    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4 text-center">
           Perfil 
        </h4>
        <div class="card overflow-hidden">
                            <div class="card-body media align-items-left">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                    class="d-block ui-w-80">
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                        Foto de perfil
                                        <input type="file" class="account-settings-fileinput">
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat">Reset</button>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <form  method="post" action="datosEditados.php" >
                                <div class="form-group">
                                    <label class="form-label">rol</label>
                                    <select name="id_rol" id="rol" class="form-control" required>
                    <?php foreach ($roles as $rol) : ?>
                        <option value="<?= $rol->id_rol ?>" <?= $rol->id_rol == $persona->id_rol ? 'selected' : '' ?>>
                            <?= htmlspecialchars($rol->rol) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Jornada</label>
                                    <select name="id_jornada" id="jornada" class="form-control" required>
                    <?php foreach ($jornadas as $jornada) : ?>
                        <option value="<?= $jornada->id_jornada ?>" <?= $jornada->id_jornada == $persona->id_jornada ? 'selected' : '' ?>>
                            <?= htmlspecialchars($jornada->jornada) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Grado</label>
                                    <input type="text" class="form-control" value="Company Ltd.">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Curso</label>
                                    <select class="form-control" name="id_curso" id="id_curso" required>
        <?php foreach ($cursos as $curso): ?>
            <option value="<?= $curso->id_curso ?>" <?= $curso->id_curso == $persona->id_curso ? 'selected' : '' ?>>
                <?= $curso->curso ?>
            </option>
        <?php endforeach; ?>
    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nombres</label>
                                    <input class="form-control" type="text" id="nombres" name="nombre" value="<?= htmlspecialchars($persona->nombre) ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Apellidos</label>
                                    <input class="form-control" type="text" id="apellidos" name="apellido" value="<?= htmlspecialchars($persona->apellido) ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Numero de documento</label>
                                    <input class="form-control" type="text" class="form-control" value="Company Ltd.">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipo de documento</label>
                                    <select id="tipo_doc" name="tipo_doc" class="form-control">
                    <option <?= $persona->tipo_doc == 'TI' ? 'selected' : '' ?>>TI</option>
                    <option <?= $persona->tipo_doc == 'CC' ? 'selected' : '' ?>>CC</option>
                    <option <?= $persona->tipo_doc == 'RC' ? 'selected' : '' ?>>RC</option>
                    <option <?= $persona->tipo_doc == 'CE' ? 'selected' : '' ?>>CE</option>
                </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Celular</label>
                                    <input class="form-control" type="number" id="celular" name="celular" value="<?= htmlspecialchars($persona->celular) ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Correo electronico</label>
                                    <input class="form-control" type="email" id="correo" name="correo" value="<?= htmlspecialchars($persona->correo) ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Usuario</label>
                                    <input class="form-control" type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($persona->usuario) ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Contraseña</label>
                                    <input class="form-control" type="password" id="contraseña" name="contraseña" value="<?= htmlspecialchars($persona->contraseña) ?>">
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-dark">Guardar cambios</button>&nbsp;
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
        </form>
                            </div>
                        </div>
                    </div>
    </div>
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
