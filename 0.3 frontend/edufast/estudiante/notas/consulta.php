<?php
require_once "configuracion/conexion.php";
try {
$num_doc = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if ($num_doc !== null) {

    if ($matricula && isset($matricula['num_doc'])) {
        $num_doc = $matricula['num_doc'];

        // Consulta de notas filtrada por el grado del estudiante
        $sentencia = $base_de_datos->prepare("
            SELECT nota.*, actividad.*, logro.*, materia.*, registro.*, matricula.*
            FROM nota
            INNER JOIN matricula ON matricula.id_matricula = nota.matricula_id_matricula
            INNER JOIN estudiante ON matricula.estudiante_id_estudiante = estudiante.id_estudiante
            INNER JOIN registro ON registro.num_doc = estudiante.registro_num_doc
            INNER JOIN actividad ON actividad.id_actividad = nota.actividad_id_actividad
            INNER JOIN logro ON logro.id_logro = actividad.logro_id_logro
            INNER JOIN materia ON materia.id_materia = actividad.docente_has_materia_materia_id_materia
            WHERE estudiante.registro_num_doc = :num_doc
        ");
        $sentencia->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
        $sentencia->execute();
        $notas = $sentencia->fetchAll(PDO::FETCH_OBJ);

        if (empty($notas)) {
            echo "No se encontraron notas para este grado.";
        }
    } else {
        echo "No se encontró un grado asociado al usuario.";
    }
} else {
    echo "Número de documento no disponible en la sesión.";
}


    // Obtener las jornadas
    $registros = $base_de_datos->query("SELECT * FROM registro")->fetchAll(PDO::FETCH_ASSOC);
    $actividades = $base_de_datos->query("SELECT * FROM actividad")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>