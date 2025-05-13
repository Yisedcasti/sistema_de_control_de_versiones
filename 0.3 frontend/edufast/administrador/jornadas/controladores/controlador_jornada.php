<?php
try {
    include_once "../configuracion/conexion.php";
    include_once "../modelo/Jornadas.php"; // Incluimos el modelo

    $jornadaModelo = new Jornada($base_de_datos); // Instanciamos el modelo con la conexión

    // Verificamos si es una solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibimos los valores del formulario
        $accion = $_POST["accion"] ?? '';
        $id_jornada = $_POST["id_jornada"] ?? null;
        $jornada = $_POST["jornada"] ?? '';
        $hora_inicio = $_POST["hora_inicio"] ?? '';
        $hora_final = $_POST["hora_final"] ?? '';

        // Validación: 

        // Procesamos la acción según el tipo de solicitud (crear, actualizar, eliminar)
        switch ($accion) {
            case 'crear':
                if (empty($jornada) || empty($hora_inicio) || empty($hora_final)) {
                    // Si algún campo está vacío, redirigimos al usuario con un mensaje de error
                    header("Location: ../vistas/jornadas.php?status=error&message=" . urlencode("Todos los campos son obligatorios."));
                    exit();
                }
                // Intentamos crear la jornada
                $resultado = $jornadaModelo->crear($jornada, $hora_inicio, $hora_final);
                break;

            case 'actualizar':
                // Intentamos actualizar la jornada
                if (empty($jornada) || empty($hora_inicio) || empty($hora_final)) {
                    // Si algún campo está vacío, redirigimos al usuario con un mensaje de error
                    header("Location: ../vistas/jornadas.php?status=error&message=" . urlencode("Todos los campos son obligatorios."));
                    exit();
                }
                $resultado = $jornadaModelo->actualizar($id_jornada, $jornada, $hora_inicio, $hora_final);
                break;

            case 'eliminar':
                // Intentamos eliminar la jornada
                $resultado = $jornadaModelo->eliminar($id_jornada);
                break;

            default:
                // Si la acción no es válida, redirigimos con mensaje de error
                header("Location: ../vistas/jornadas.php?status=error&message=" . urlencode("Acción no válida."));
                exit();
        }

        // Verificamos el resultado de la operación
        if ($resultado === true) {
            // Si la operación fue exitosa, redirigimos a la vista con mensaje de éxito
            header("Location: ../vistas/jornadas.php?status=success");
        } else {
            // Si hubo un error, redirigimos con mensaje de error y el detalle del error
            header("Location: ../vistas/jornadas.php?status=error&message=" . urlencode($resultado));
        }
        exit();
    }

} catch (PDOException $e) {
    // Capturamos cualquier error de base de datos y lo mostramos en la vista
    header("Location: ../vistas/jornadas.php?status=error&message=" . urlencode("Error en la base de datos: " . $e->getMessage()));
    exit();
} catch (Exception $e) {
    // Capturamos cualquier otro error que no sea de base de datos
    header("Location: ../vistas/jornadas.php?status=error&message=" . urlencode("Error inesperado: " . $e->getMessage()));
    exit();
}
?>
