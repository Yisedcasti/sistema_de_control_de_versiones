<?php
include_once "../configuracion/conexion.php";

// Realiza la consulta a la base de datos
try {

    $grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);
    $cursos = $base_de_datos->query("SELECT * FROM cursos")->fetchAll(PDO::FETCH_ASSOC);
    $jornadas = $base_de_datos->query("SELECT * FROM jornada")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
