<?php
require_once "conexion.php";
try {
    // Preparar y ejecutar la consulta para obtener grados y jornadas
    $sentencia = $base_de_datos->prepare(" SELECT logro.*, materia.*, grado.*
FROM logro
INNER JOIN materia ON materia.id_materia = logro.materia_id_materia
INNER JOIN grado ON grado.id_grado = logro.grado_id_grado
    ");
    $sentencia->execute();
    $logros = $sentencia->fetchAll(PDO::FETCH_OBJ);

    // Obtener las materias
    $materias = $base_de_datos->query("SELECT * FROM materia")->fetchAll(PDO::FETCH_ASSOC);
    // Obtener los grados
    $grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>