<?php

include_once "conexion.php";
$id_materia = $_POST["id_materia"]; 
$materia = $_POST["materia"];
$area_id_area = $_POST["area_id_area"];

// Preparar la sentencia de actualización
$sentencia = $base_de_datos->prepare("UPDATE materia 
                                      SET materia = ?, 
                                      area_id_area = ?
                                      WHERE id_materia = ?");

$resultado = $sentencia->execute([
    $materia, 
    $area_id_area, 
    $id_materia
]);

if ($resultado) {
    header("Location: Materia.php?status=success");
    exit();
} else {
    header("Location: Materia.php?status=error");
exit();
}
?>
