<?php
include_once "../configuracion/conexion.php";

try {
    // Preparar y ejecutar la consulta para obtener grados y jornadas
    $sentencia = $base_de_datos->prepare("
        SELECT *  FROM grado 
       ORDER BY CAST( grado AS UNSIGNED) ASC;");
    $sentencia->execute();
    $grados = $sentencia->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>