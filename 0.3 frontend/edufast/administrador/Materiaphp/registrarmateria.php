<?php

include_once "conexion.php";

$materia = $_POST["materia"];
$area_id_area = $_POST["area_id_area"];

$sentencia = $base_de_datos->prepare("INSERT INTO materia (
    materia,
    area_id_area
) VALUES (?, ?);");

$resultado = $sentencia->execute([$materia, $area_id_area]);

if ($resultado) {
    header("Location: Materia.php?status=success");
exit();
} else {
    header("Location: Materia.php?status=error");
    exit();
}
?>
