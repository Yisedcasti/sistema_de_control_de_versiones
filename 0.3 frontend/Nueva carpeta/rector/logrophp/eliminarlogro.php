<?php
if(!isset($_POST["id_logro"])) exit();
$id_logro= $_POST["id_logro"];


include_once "conexion.php";

$sentencia = $base_de_datos->prepare("DELETE FROM logro WHERE id_logro = ?;");
$resultado = $sentencia->execute([$id_logro]);

if ($resultado) {
    header("Location: logros.php?status=success");
    exit();
} else {
    header("Location: logros.php?status=success");
    exit();
}
