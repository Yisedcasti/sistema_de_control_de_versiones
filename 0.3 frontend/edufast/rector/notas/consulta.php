<?php
require_once "configuracion/conexion.php";
try {
    // Preparar y ejecutar la consulta para obtener grados y jornadas
    $sentencia = $base_de_datos->prepare(" SELECT nota.*, actividad.*, logro.*, materia.*, registro.*
FROM nota
INNER JOIN registro ON registro.num_doc = nota.registro_num_doc
INNER JOIN actividad ON actividad.id_actividad = nota.actividades_id_actividades
INNER JOIN logro ON logro.Codigo_logro = actividad.logro_Codigo_logro
INNER JOIN materia ON materia.id_materia = logro.id_materia
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