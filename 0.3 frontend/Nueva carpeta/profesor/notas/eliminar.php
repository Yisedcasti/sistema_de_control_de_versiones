<?php
if(!isset($_POST["id_nota"])) exit("faltan datos");
$id_nota = $_POST["id_nota"];
include_once "configuracion/conexion.php";

$sentencia = $base_de_datos->prepare("DELETE FROM nota WHERE id_nota = ?;");
$resultado = $sentencia->execute([$id_nota]);

if ($resultado) {
    echo '<script>
        alert("Eliminado correctamente.");
        window.location.href = "notas.php";
    </script>';
} else {
    echo '<script>
        alert("NO pudo ser eliminado.");
        window.location.href = "notas.php";
    </script>';
}
