<?php
if (!isset($_POST["id_jornada"])) {
    exit();
}

$id_jornada = $_POST["id_jornada"];
include_once "../configuracion/conexion.php";

// Eliminar registro en la tabla 'jornada'
$eliminarJornada = $base_de_datos->prepare("DELETE FROM jornada WHERE id_jornada = ?;");
$resultado = $eliminarJornada->execute([$id_jornada]);

if ($resultado) {
    header("Location: ../vistas/jornadas.php?status=success");
    exit();

} else {
   header("Location: ../vistas/jornadas.php?status=error");
   exit();
}
?>
