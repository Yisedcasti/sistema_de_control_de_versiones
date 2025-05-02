<?php
if (!isset($_POST["id_noticia"])) {
    exit();
}

$id_noticia = $_POST["id_noticia"];
include_once "../configuracion/conexion.php";
// Eliminar el evento de la base de datos
$sentencia = $base_de_datos->prepare("DELETE FROM public_noticias WHERE id_noticia = ?");
$resultado = $sentencia->execute([$id_noticia]);

if ($resultado) {
    header("Location: ../vistas/actualizar_noticia.php?status=success");
    exit();
} else {
    header("Location: ../vistas/actualizar_noticia.php?status=error");
    exit();
}
?>
