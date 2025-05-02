<?php
include_once "../configuracion/conexion.php";

// Realiza la consulta a la base de datos
try {
    $sentencia = $base_de_datos->prepare(" SELECT * FROM jornada WHERE id_jornada <> 1 ");
    $sentencia->execute();
    $jornadas = $sentencia->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
