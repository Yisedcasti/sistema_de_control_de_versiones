<?php
if (
    !isset($_POST["nombre_logro"]) || 
    !isset($_POST["descrip_logro"]) || 
    !isset($_POST["id_materia"]) || 
    !isset($_POST["grado_id_grado"]) || 
    !isset($_POST["id_logro"])
) {
    echo "Faltan los siguientes datos:<br>";
    if (!isset($_POST["nombre_logro"])) echo "Falta el nombre del logro.<br>";
    if (!isset($_POST["descrip_logro"])) echo "Falta la descripción del logro.<br>";
    if (!isset($_POST["id_materia"])) echo "Falta la materia.<br>";
    if (!isset($_POST["grado_id_grado"])) echo "Falta el grado .<br>";
    if (!isset($_POST["id_logro"])) echo "Falta el código del logro.<br>";
    exit();
}

try {
    include_once "conexion.php"; 

    $id_logro = $_POST["id_logro"];
    $nombre_logro = $_POST["nombre_logro"];
    $descrip_logro = $_POST["descrip_logro"];
    $grado_id_grado = $_POST["grado_id_grado"];
    $id_materia = $_POST["id_materia"];

    $sentencia = $base_de_datos->prepare("UPDATE logro SET 
        nombre_logro = ?, 
        descripcion_logro = ?, 
        materia_id_materia = ?, 
        grado_id_grado = ?
        WHERE id_logro = ?");

    $resultado = $sentencia->execute([$nombre_logro, $descrip_logro, $id_materia, $grado_id_grado, $id_logro]);

    if ($resultado) {
        header("Location: logros.php?status=success");
        exit();
    } else {
        header("Location: logros.php?status=error");
        exit();
    }

} catch (PDOException $e) {
    echo "Error en la actualización de datos: " . $e->getMessage();
}

?>
