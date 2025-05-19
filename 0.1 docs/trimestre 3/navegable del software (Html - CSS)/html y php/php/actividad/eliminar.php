<?php
if (!isset($_POST["id_actividad"])) {
    exit();
}

$id_actividad = $_POST["id_actividad"];
include_once "conexion.php";

$sentencia = $base_de_datos->prepare("DELETE FROM actividad WHERE id_actividad = ?;");
$resultado = $sentencia->execute([$id_actividad]);

if ($resultado) {
    header("Location: actividad.php?status=success");
} else {
    header("Location: actividad.php?status=success");
}
?>
