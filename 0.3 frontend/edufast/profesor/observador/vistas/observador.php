<?php
require_once "../funciones/consultar.php"
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
    <link rel="stylesheet" href="../../../ob.css"/>
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
                        <?php
                        require_once "../configuracion/conexion.php";
                        $num_doc = isset($_GET['num_doc']) ? $_GET['num_doc'] : null;
                        
                        if ($num_doc !== null) {
                            // Verificar en la tabla de estudiantes
                            $sqlEstudiante = "SELECT * FROM estudiante
                            INNER JOIN registro ON estudiante.registro_num_doc = registro.num_doc
                             WHERE registro_num_doc = :num_doc";
                            $stmtEstudiante = $base_de_datos->prepare($sqlEstudiante);
                            $stmtEstudiante->bindParam(':num_doc', $num_doc, PDO::PARAM_STR);
                            $stmtEstudiante->execute();
                            $datosEstudiante = $stmtEstudiante->fetch(PDO::FETCH_ASSOC);
                        
                            // Si hay datos del estudiante
                            if ($datosEstudiante) {
                                // Verificar en la tabla de matrículas
                                $sqlMatricula = "SELECT * FROM matricula 
                                INNER JOIN grado ON matricula.grado_id_grado = grado.id_grado
                                INNER JOIN cursos ON  matricula.cursos_id_cursos = cursos.id_cursos
                                 WHERE estudiante_registro_num_doc = :num_doc";
                                $stmtMatricula = $base_de_datos->prepare($sqlMatricula);
                                $stmtMatricula->bindParam(':num_doc', $num_doc, PDO::PARAM_STR);
                                $stmtMatricula->execute();
                                $datosMatricula = $stmtMatricula->fetchAll(PDO::FETCH_ASSOC);
                        
                                // Si hay matrículas, mostrar los datos
                                if (count($datosMatricula) > 0) {
                                    foreach ($datosMatricula as $matricula) {
                                        echo "		<div class='container mt-5'>
            <div class='container my-5'>
        <div class='text-center mb-4'>
            <h4><b>OBSERVADOR DEL ESTUDIANTE</b></h4>
        </div>

        <form action='gracias.html' method='post'>
            <!-- Información Básica -->
            <div class='mb-4'>
                <h5 class='text-center'>Información Básica</h5>
                <div class='row g-3'>
                    <div class='col-md-2'>
                        <label for='grado' class='form-label'>Grado</label>
                          <select class='form-select' id='frecuencia' name='id_jornada'>";
                        foreach ($grados as $grado) {
                            $selected = ($matricula['grado_id_grado'] == $grado['id_grado']) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($grado['id_grado'], ENT_QUOTES) . "' $selected>"
                                . htmlspecialchars($grado['grado'], ENT_QUOTES) . "</option>";
                        }
                        

echo "
    </select>
                    </div>
                    <div class='col-md-2'>
                        <label for='curso' class='form-label'>Curso</label>
                          <select class='form-select' id='frecuencia' name='id_jornada'>";
                        foreach ($cursos as $curso) {
                            $selected = ($matricula['cursos_id_cursos'] == $curso['id_cursos']) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($curso['id_cursos'], ENT_QUOTES) . "' $selected>"
                                . htmlspecialchars($curso['curso'], ENT_QUOTES) . "</option>";
                        }
                        

echo "
    </select>
                    </div>
                    <div class='col-md-3'>
                        <label for='frecuencia' class='form-label'>Jornada</label>
                        <select class='form-select' id='frecuencia' name='id_jornada'>";
                        foreach ($jornadas as $jornada) {
                            $selected = ($datosEstudiante['registro_jornada_id_jornada'] == $jornada['id_jornada']) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($jornada['id_jornada'], ENT_QUOTES) . "' $selected>"
                                . htmlspecialchars($jornada['jornada'], ENT_QUOTES) . "</option>";
                        }
                        

echo "
    </select>
                    </div>
                   <div class='col-md-3'>
    <label for='estudiante' class='form-label'>Estado</label>
    <input type='text' class='form-control' id='director' name='director' value='{$datosEstudiante['Estado']}'>
</div>

                </div>
            </div>

            <!-- Información del Estudiante -->
            <div class='mb-4'>
                <h5 class='text-center'>Información del Estudiante</h5>
                <div class='row g-3'>
                    <div class='col-md-3'>
                        <label for='apellido' class='form-label'>Apellidos</label>
                        <input type='text' class='form-control' id='apellido' name='apellido' value='{$datosEstudiante['apellidos']}'>
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>Nombres</label>
                        <input type='text' class='form-control' id='nombre' name='nombre' value='{$datosEstudiante['nombres']}'> 
                    </div>
                    <div class='col-md-3'>
                        <label for='nacimiento' class='form-label'>Fecha de Nacimiento</label>
                        <input type='date' class='form-control' id='nacimiento' name='nacimiento' value='{$datosEstudiante['fecha_nacimiento']}'>
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>Genero</label>
                        <input type='text' class='form-control' id='nombre' name='nombre' value='{$datosEstudiante['sexo']}'> 
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>RH</label>
                        <input type='text' class='form-control' id='nombre' name='nombre' value='{$datosEstudiante['RH']}'> 
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>Eps</label>
                        <input type='text' class='form-control' id='nombre' name='nombre' value='{$datosEstudiante['Eps']}'> 
                    </div>
                </div>
            </div>

            <!-- Información Familiar -->
            <div class='mb-4'>
                <h5 class='text-center'>Identificación Familiar</h5>
                <div class='row g-3'>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Nombre del Padre</label>
                        <input type='text' class='form-control' id='nombre_padre' name='nombre_padre'>
                    </div>
                    <div class='col-md-4'>
                        <label for='ocupacion_padre' class='form-label'>Ocupación del Padre</label>
                        <input type='text' class='form-control' id='ocupacion_padre' name='ocupacion_padre'>
                    </div>
                    <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Teléfono del Padre</label>
                        <input type='text' class='form-control' id='telefono_padre' name='telefono_padre'>
                    </div>
                </div>
                <div class='row g-3 mt-3'>
                    <div class='col-md-4'>
                        <label for='nombre_madre' class='form-label'>Nombre de la Madre</label>
                        <input type='text' class='form-control' id='nombre_madre' name='nombre_madre'>
                    </div>
                    <div class='col-md-4'>
                        <label for='ocupacion_madre' class='form-label'>Ocupación de la Madre</label>
                        <input type='text' class='form-control' id='ocupacion_madre' name='ocupacion_madre'>
                    </div>
                    <div class='col-md-4'>
                        <label for='telefono_madre' class='form-label'>Teléfono de la Madre</label>
                        <input type='text' class='form-control' id='telefono_madre' name='telefono_madre'>
                    </div>
                </div>
                <div class='row g-3 mt-3'>
                    <div class='col-md-4'>
                        <label for='nombre_acudiente' class='form-label'>Nombre del Acudiente</label>
                        <input type='text' class='form-control' id='nombre_acudiente' name='nombre_acudiente'>
                    </div>
                    <div class='col-md-4'>
                        <label for='ocupacion_acudiente' class='form-label'>Ocupación del Acudiente</label>
                        <input type='text' class='form-control' id='ocupacion_acudiente' name='ocupacion_acudiente'>
                    </div>
                    <div class='col-md-4'>
                        <label for='telefono_acudiente' class='form-label'>Teléfono del Acudiente</label>
                        <input type='text' class='form-control' id='telefono_acudiente' name='telefono_acudiente'>
                    </div>
                </div>
            </div>

            <!-- Compromisos -->
            <div class='mb-4'>
                <h5 class='text-center'>Compromisos Académicos y Convivenciales</h5>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Trimestre</th>
                            <th>Fecha</th>
                            <th>Observación</th>
                            <th>Compromiso</th>
                            <th>Firma del Docente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='number' class='form-control' name='trimestre'></td>
                            <td><input type='date' class='form-control' name='fecha_obser'></td>
                            <td><textarea class='form-control' name='observacion' rows='3'></textarea></td>
                            <td><textarea class='form-control' name='compromiso' rows='3'></textarea></td>
                            <td><textarea class='form-control' name='firma' rows='3'></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Botones -->
            <div class='text-center'>
                <button type='submit' class='btn btn-primary'>Enviar</button>
                <button type='reset' class='btn btn-danger'>Borrar</button>
            </div>
        </form>
    </div>
    
        </div>";
                                    }
                                } else {
                                    // Si no hay matrículas, mostrar el formulario de matrícula
                                    mostrarFormularioMatricula($num_doc);
                                }
                            } else {
                                // Si no hay estudiante, mostrar formulario de registro de estudiante
                                mostrarFormularioEstudiante($num_doc);
                            }
                        } else {
                            echo "Número de documento no proporcionado.";
                        }
                        
                        function mostrarFormularioEstudiante($num_doc)
                
                        {
                            echo "<div class='container mb-5'>
                            <h1 class='text-center mb-4'>Formulario Datos adicionales</h1>
                            <form action='../funciones/crearEstudiante.php' method='POST' class='shadow p-4 rounded bg-light'>
                            <input type='hidden' name='Registro_num_doc' value='$num_doc'>
                                <!-- Campo Sexo -->
                                <div class='mb-3'>
                                    <label for='sexo' class='form-label'>Sexo</label>
                                    <select name='sexo' id='sexo' class='form-select' required>
                                        <option value=' disabled selected>Seleccione el sexo</option>
                                        <option value='M'>Masculino</option>
                                        <option value='F'>Femenino</option>
                                        <option value='O'>Otro</option>
                                    </select>
                                </div>
                                <!-- Campo Fecha de Nacimiento -->
                                <div class='mb-3'>
                                    <label for='fecha_nacimiento' class='form-label'>Fecha de Nacimiento</label>
                                    <input type='date' name='fecha_nacimiento' id='fecha_nacimiento' class='form-control' required 
                                           oninput='validarFechaNacimiento()'>
                                    <div id='error_fecha_nacimiento' class='text-danger mt-1'></div>
                                </div>
                                <!-- Campo EPS -->
                                <div class='mb-3'>
                                    <label for='eps' class='form-label'>EPS</label>
                                    <input type='text' class='form-control' id='Eps' name='Eps'>
                                </div>
                                <!-- Campo RH -->
                                <div class='mb-3'>
                                    <label for='rh' class='form-label'>RH</label>
                                    <select name='RH' id='rh' class='form-select' required>
                                        <option value=' disabled selected>Seleccione el RH</option>
                                        <option value='O+'>O+</option>
                                        <option value='O-'>O-</option>
                                        <option value='A+'>A+</option>
                                        <option value='A-'>A-</option>
                                        <option value='B+'>B+</option>
                                        <option value='B-'>B-</option>
                                        <option value='AB+'>AB+</option>
                                        <option value='AB-'>AB-</option>
                                    </select>
                                </div>
                                <!-- Campo Nivel Educativo -->
                                <div class='mb-3'>
                                    <label for='nivel_educativo' class='form-label'>Nivel Educativo</label>
                                    <select name='Nivel_educativo' id='nivel_educativo' class='form-select' required>
                                        <option value=' disabled selected>Seleccione el nivel educativo</option>
                                        <option value='Primaria'>Primaria</option>
                                        <option value='Secundaria'>Secundaria</option>
                                    </select>
                                </div>
                                <!-- Campo Estado -->
                                <div class='mb-3'>
                                    <label for='estado' class='form-label'>Estado</label>
                                    <select name='Estado' id='estado' class='form-select' required>
                                        <option value=' disabled selected>Seleccione el estado</option>
                                        <option value='Nuevo'>Nuevo</option>
                                        <option value='Antiguo'>Antiguo</option>
                                        <option value='Repitente'>Repitente</option>
                                    </select>
                                </div>
                                <!-- Botón Enviar -->
                                <button type='submit' class='btn btn-primary'>Enviar</button>
                            </form>
                            </div>
                        ";
                        }
                        function mostrarFormularioMatricula($num_doc)
                        {
                            echo "<div class='container mt-5'>
                            <h1 class='text-center mb-4'>Formulario de Grados y Cursos</h1>
                            <form action='procesar_formulario.php' method='POST' class='shadow p-4 rounded bg-light'>
                                <div class='mb-3'>
                                    <label for='grado' class='form-label'>Grado</label>
                                    <select name='grado' id='grado' class='form-select' required>
                                        <option value=' disabled selected>Seleccionew un grado</option>
                                        <option value='1'>Grado 1</option>
                                        <option value='2'>Grado 2</option>
                                    </select>
                                </div>
                                <div class='mb-3'>
                                    <label for='curso' class='form-label'>Curso</label>
                                    <select name='curso' id='curso' class='form-select' required>
                                        <option value=' disabled selected>Seleccione un curso</option>
                                        <option value='A'>Curso A</option>
                                        <option value='B'>Curso B</option>
                                    </select>
                                </div>
                                <button type='submit' class='btn btn-primary'>Enviar</button>
                            </form>
                        </div>
                        ";
                        }
                        ?>
                        
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

        // Validar fecha de naAcimiento
    function validarFechaNacimiento() {
        const fechaInput = document.getElementById("fecha_nacimiento");
        const mensajeError = document.getElementById("error_fecha_nacimiento");
        const fechaSeleccionada = new Date(fechaInput.value);
        const hoy = new Date();
        const edadMinima = new Date(hoy.getFullYear() - 4, hoy.getMonth(), hoy.getDate());
        
        if (fechaSeleccionada >= hoy || fechaSeleccionada > edadMinima) {
            mensajeError.textContent = "La fecha de nacimiento no es válida. Debe ser al menos 4 años menor que hoy.";
            fechaInput.classList.add("is-invalid");
        } else {
            mensajeError.textContent = "";
            fechaInput.classList.remove("is-invalid");
        }
    }

    </script>
</body>

</html>
