<?php
if(!isset($_POST["id_materia"])) exit();
$id_materia = $_POST["id_materia"];
include_once "conexion.php";

$sentencia = $base_de_datos->prepare("DELETE FROM materia WHERE id_materia = ?;");
$resultado = $sentencia->execute([$id_materia]);
if ($resultado) {
    header("Location: Materia.php?status=success");
    exit();
} else {
    header("Location: Materia.php?status=error");
    exit();
}
