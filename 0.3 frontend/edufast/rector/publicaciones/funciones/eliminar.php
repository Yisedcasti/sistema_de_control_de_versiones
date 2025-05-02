<?php
if (!isset($_POST["id_evento"])) {
    exit();
}

$id_evento = $_POST["id_evento"];
include_once "../configuracion/conexion.php";

// Primero, obtener el nombre de la imagen asociada al evento
$consulta = $base_de_datos->prepare("SELECT img FROM public_eventos WHERE id_evento = ?");
$consulta->execute([$id_evento]);
$evento = $consulta->fetch(PDO::FETCH_ASSOC);

if ($evento) {
    $img = $evento['img'];  // Nombre de la imagen asociada

    // Verificar si existe la imagen y eliminarla
    $directorio = '../../../imagenes/';
    if ($img && file_exists($directorio . $img)) {
        unlink($directorio . $img);  // Eliminar la imagen del servidor
    }
}

// Eliminar el evento de la base de datos
$sentencia = $base_de_datos->prepare("DELETE FROM public_eventos WHERE id_evento = ?");
$resultado = $sentencia->execute([$id_evento]);

if ($resultado) {
    header("Location: ../vistas/actualizar_evento.php?status=success");
    exit();
} else {
    header("Location: ../vistas/actualizar_evento.php?status=error");
    exit();
}
?>
