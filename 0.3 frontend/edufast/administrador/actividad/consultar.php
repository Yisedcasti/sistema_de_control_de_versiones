<?php
include_once "conexion.php";

// Realiza la consulta a la base de datos
try {
    $sentencia = $base_de_datos->prepare("
       SELECT actividad.*, logro.*, materia.* 
           FROM actividad 
            INNER JOIN logro ON actividad.logro_id_logro = logro.id_logro 
            INNER JOIN materia ON actividad.logro_materia_id_materia  = materia.id_materia

    ");
    $sentencia->execute();
    $actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $logros = $base_de_datos->query("SELECT * FROM logro")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
