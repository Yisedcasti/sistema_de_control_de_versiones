<?php
require_once "../funciones/consultar.php";
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
    <link rel="stylesheet" href="../../../css/stylsadm.css">
    <link rel="stylesheet" href="../../../ob.css"/>
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
                <a href="../../observador/vistas/alumnos.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Observador</a>
                <a href="../../materiaphp/materia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Materias</a>
                <a href="../../logrophp/logros.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Logros</a>
                <a href="../../actividad/actividad.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Actividades</a>
                <a href="../../admin/pag_principal.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Principal</a>            
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
                    <div class="col-md-12 text-center">
                    <main class="main-container ">
                        <?php
                        require_once "../configuracion/conexion.php";
                        
                        $num_doc = isset($_GET['num_doc']) ? $_GET['num_doc'] : null;
                        
                        if ($num_doc !== null) {
                            // Verificar en la tabla de estudiantes
                            $sqlEstudiante = "SELECT estudiante.*, registro.*
                            FROM estudiante 
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
            <div class='container'>
        <div class='text-center mb-4'>
            <h2><b>OBSERVADOR DEL ESTUDIANTE</b></h2>
        </div>

        <form action='../funciones/actualizar.php' method='post'>
        <input type='hidden' class='form-control text-center bg-white' id='director' name='num_doc' value='{$datosEstudiante['num_doc']}'>
            <!-- Información Básica -->
            <h3 class='text-center'>Información Básica</h3>
            <div class='mb-4 mt-4'>
                <div class='row g-3'>
                <div class='col-md-3'>
    <label for='estudiante' class='form-label'>Nivel educativo</label>
    <input type='text' class='form-control text-center bg-white' id='director' name='director' value='{$datosEstudiante['NIvel_educativo']}' disabled>
</div>
                    <div class='col-md-2'>
                        <label for='grado' class='form-label'>Grado</label>
                          <select class='form-select' id='frecuencia' name='id_grado'>";
                        foreach ($grados as $grado) {
                            $selected = ($matricula['grado_id_grado'] == $grado['id_grado']) ? 'selected' : '';
                            echo "<option class ='text-center'value='" . htmlspecialchars($grado['id_grado'], ENT_QUOTES) . "' $selected>"
                                . htmlspecialchars($grado['grado'], ENT_QUOTES) . "</option>";
                        }
                        

echo "
    </select>
                    </div>
                    <div class='col-md-2'>
                        <label for='curso' class='form-label'>Curso</label>
                          <select class='form-select' id='frecuencia' name='id_curso'>";
                        foreach ($cursos as $curso) {
                            $selected = ($matricula['cursos_id_cursos'] == $curso['id_cursos']) ? 'selected' : '';
                            echo "<option class='text-center' value='" . htmlspecialchars($curso['id_cursos'], ENT_QUOTES) . "' $selected>"
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
                            echo "<option class='text-center' value='" . htmlspecialchars($jornada['id_jornada'], ENT_QUOTES) . "' $selected>"
                                . htmlspecialchars($jornada['jornada'], ENT_QUOTES) . "</option>";
                        }
                        

echo "
    </select>
                    </div>
                   <div class='col-md-3'>
    <label for='estudiante' class='form-label'>Estado</label>
    <input type='text' class='form-control text-center bg-white' id='director' name='director' value='{$datosEstudiante['Estado']}' disabled>
</div>

 
                </div>
            </div>

            <!-- Información del Estudiante -->

            <h3 class='text-center'>Información del Estudiante</h3>
            <div class='mb-5  mt-4'>
                <div class='row g-3'>
                    <div class='col-md-3'>
                        <label for='apellido' class='form-label'>Apellidos</label>
                        <input type='text' class='form-control text-center bg-white' id='apellido' name='apellido' value='{$datosEstudiante['apellidos']}' disabled>
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>Nombres</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre' name='nombre' value='{$datosEstudiante['nombres']}' disabled> 
                    </div>
                    <div class='col-md-3'>
                        <label for='nacimiento' class='form-label'>Fecha de Nacimiento</label>
                        <input type='date' class='form-control text-center bg-white' id='nacimiento' name='nacimiento' value='{$datosEstudiante['fecha_nacimiento']}' disabled>
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>Genero</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre' name='nombre' value='{$datosEstudiante['sexo']}' disabled> 
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>RH</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre' name='nombre' value='{$datosEstudiante['RH']}' disabled> 
                    </div>
                    <div class='col-md-3'>
                        <label for='nombre' class='form-label'>Eps</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre' name='nombre' value='{$datosEstudiante['Eps']}' disabled> 
                    </div>";
                    foreach ($observadores as $observador) {
                    echo "<div class='col-md-3'>
                        <label for='nombre' class='form-label'>Telefono de emergencia</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre' name='Tel_emergencia' value='{$observador['Tel_emergencia']}'> 
                    </div>
                </div>
            </div>

            <!-- Información Familiar -->
            <h3 class='text-center'>Identificación Familiar</h3>
            <div class='mb-4 mt-4'>
             <h5 class='text-start mb-4'>DATOS DEL PADRE</h5>
                <div class='row g-3'>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Nombres del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre_padre' name='padre_nombre' value='{$observador['padre_nombre']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Apellidos del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='nombre_padre' name='padre_apellido' value='{$observador['padre_apellido']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='ocupacion_padre' class='form-label'>Ocupación del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='ocupacion_padre' name='padre_ocupacion' value='{$observador['padre_ocupacion']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Cedula del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='padre_cedula' value='{$observador['padre_cedula']}'  >
                    </div>

                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Direccion del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='padre_direccion' value='{$observador['padre_direccion']}'  >
                    </div>
                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Telefono del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='padre_telefono' value='{$observador['padre_telefono']}'  >
                    </div>
                    
                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Correo del Padre</label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='padre_correo' value='{$observador['padre_correo']}'  >
                    </div>

                </div>
                <h5 class='text-start mb-4 mt-5'>DATOS DE LA MADRE</h5>
                <div class='row g-3 mt-4'>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Nombres de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='nombre_padre' name='madre_nombre' value='{$observador['madre_nombre']}'  >
                    </div>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Apellidos de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='nombre_padre' name='madre_apellido' value='{$observador['madre_apellido']}'  >
                    </div>
                    <div class='col-md-4'>
                        <label for='ocupacion_padre' class='form-label'>Ocupación de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='ocupacion_padre' name='madre_ocupacion' value='{$observador['madre_ocupacion']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Cedula de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='madre_cedula' value='{$observador['madre_cedula']}'  >
                    </div>

                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Direccion de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='madre_direccion' value='{$observador['madre_direccion']}' >
                    </div>
                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Telefono de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='madre_telefono' value='{$observador['madre_telefono']}' >
                    </div>
                    
                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Correo de la madre </label>
                        <input type='text' class='form-control text-center bg-white' id='telefono_padre' name='madre_correo' value='{$observador['madre_correo']}' >
                    </div>

                </div>

                  <h5 class='text-start mb-4 mt-5'>DATOS DEL ACUDIENTE </h5>
                 <div class='row g-3 mt-4 mb-5'>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Nombres del acudiente </label>
                        <input type='text' class='form-control bg-white text-center' id='nombre_padre' name='acudiente_nombre' value='{$observador['acudiente_nombre']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='nombre_padre' class='form-label'>Apellidos del acudiente </label>
                        <input type='text' class='form-control bg-white text-center' id='nombre_padre' name='acudiente_apellido' value='{$observador['acudiente_apellido']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='ocupacion_padre' class='form-label'>Ocupación del acudiente </label>
                        <input type='text' class='form-control bg-white text-center' id='ocupacion_padre' name='acudiente_ocupacion' value='{$observador['acudiente_ocupacion']}' >
                    </div>
                    <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Cedula del acudiente </label>
                        <input type='text' class='form-control bg-white text-center' id='telefono_padre' name='acudiente_telefono' value='{$observador['acudiente_cedula']}' >
                    </div>

                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Direccion del acudiente </label>
                        <input type='text' class='form-control bg-white text-center' id='telefono_padre' name='direccion_acudiente' value='{$observador['acudiente_direccion']}' >
                    </div>
                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Telefono del acudiente </label>
                        <input type='text' class='form-control bg-white text-center' id='telefono_padre' name='acudiente_telefono' value='{$observador['acudiente_telefono']}' >
                    </div>
                    
                     <div class='col-md-4'>
                        <label for='telefono_padre' class='form-label'>Correo del acudiente </label>
                        <input type='text' class='form-control bg-white text-center ' id='telefono_padre' name='correo_acudiente' value='{$observador['acudiente_correo']}' >
                    </div>

                </div>";
                    }

       
            echo "<div class='mb-4'>
                 <!-- Compromisos -->
                <h5 class='text-center'>Compromisos Académicos y Convivenciales</h5>
                <table class='table table-bordered '>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Observación</th>
                            <th>Compromiso</th>
                            <th>Nombre Docente</th>
                            <th>firma estudiante</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($compromisos as $compromiso) {
    echo "<tr>
        <td>{$compromiso['fechaCompromiso']}</td>
        <td>{$compromiso['observacion']}</td>
        <td>{$compromiso['compromiso']}</td>
        <td>{$compromiso['nombre_docente']}</td>
        <td>{$compromiso['firma_alumno']}</td>
    </tr>";
}
                    echo"</tbody>
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
                                    mostrarFormularioMatricula($grados, $cursos, $datosEstudiante);
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
                            echo "Para poder asignar un curso y un grado, el estudiante primero debe completar el formulario con los datos restantes."; 
                        }
                        function mostrarFormularioMatricula($grados, $cursos, $datosEstudiante) 
                        {
                            echo "<div class='container mt-5'>
                                    <h1 class='text-center mb-4'>Formulario de Grados y Cursos</h1>
                                    <form action='../funciones/crearMatricula.php' method='POST' class='shadow p-4 rounded bg-light'>
                                   <input type='hidden' class='form-control' id='apellido' name='id_estudiante' value='{$datosEstudiante['id_estudiante']}'>
                                        <div class='mb-3'>
                                            <label for='grado' class='form-label'>Grado</label>
                                            <select name='id_grado' id='grado' class='form-select' required>
                                                <option value='' disabled selected>Seleccione un grado</option>";  

                                                foreach ($grados as $grado) {
                                                    echo '<option value="' . htmlspecialchars($grado['id_grado'], ENT_QUOTES) . '">'
                                                        . htmlspecialchars($grado['grado'], ENT_QUOTES) . '</option>';
                                                }

                            echo "  </select> </div>";
                            echo "<div class='mb-3'>
                                    <label for='curso' class='form-label'>Curso</label>
                                    <select name='id_curso' id='curso' class='form-select' required>
                                        <option value='' disabled selected>Seleccione un curso</option>";
                                        foreach ($cursos as $curso) {
                                            echo '<option value="' . htmlspecialchars($curso['id_cursos'], ENT_QUOTES) . '">'
                                                . htmlspecialchars($curso['curso'], ENT_QUOTES) . '</option>';
                                        }

                                    echo "</select>
                                </div>
                                <button type='submit' class='btn btn-primary'>Enviar</button>
                            </form>
                        </div>";
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
