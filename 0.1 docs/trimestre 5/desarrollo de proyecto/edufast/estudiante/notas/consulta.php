<?php
require_once "configuracion/conexion.php";
try {
    // Preparar y ejecutar la consulta para obtener grados y jornadas
    $sentencia = $base_de_datos->prepare(" SELECT nota.*, actividad.*, logro.*, materia.*, registro.*, matricula.*
FROM nota
INNER JOIN matricula ON matricula.id_matricula = nota.matricula_id_matricula
INNER JOIN estudiante ON matricula.estudiante_id_estudiante = estudiante.id_estudiante
INNER JOIN registro ON registro.num_doc = estudiante.registro_num_doc
INNER JOIN actividad ON actividad.id_actividad = nota.actividad_id_actividad
INNER JOIN logro ON logro.id_logro = actividad.logro_id_logro
INNER JOIN materia ON materia.id_materia = actividad.docente_has_materia_materia_id_materia
WHERE matricula_id_matricula = nota.matricula_id_matricula
    ");
    $sentencia->execute();
    $notas = $sentencia->fetchAll(PDO::FETCH_OBJ);

    // Obtener las jornadas
    $registros = $base_de_datos->query("SELECT * FROM registro")->fetchAll(PDO::FETCH_ASSOC);
    $actividades = $base_de_datos->query("SELECT * FROM actividad")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>