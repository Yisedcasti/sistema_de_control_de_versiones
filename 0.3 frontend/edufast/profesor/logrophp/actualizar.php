<?php
# Verifica que todos los datos necesarios estén presentes
if(
    !isset($_POST["nombre_logro"]) || 
    !isset($_POST["descrip_logro"]) || 
    !isset($_POST["id_materia"]) || 
    !isset($_POST["codigo_logro"])
) {
    echo "Faltan los siguientes datos:<br>";
    if(!isset($_POST["nombre_logro"])) echo "Falta el nombre del logro.<br>";
    if(!isset($_POST["descrip_logro"])) echo "Falta la descripción del logro.<br>";
    if(!isset($_POST["id_materia"])) echo "Falta la materia.<br>";
    if(!isset($_POST["codigo_logro"])) echo "Falta el código del logro.<br>";
    exit();
}

try {
    # Incluye la conexión a la baxcddse de datos
    include_once "conexion.php";

    # Recoge los datos del formulario
    $codigo_logro = $_POST["codigo_logro"];
    $nombre_logro = $_POST["nombre_logro"];
    $descrip_logro = $_POST["descrip_logro"];
    $id_materia = $_POST["id_materia"];

    # Prepara la sentencia SQL
    $sentencia = $base_de_datos->prepare("UPDATE logro SET nombre_logro = ?, descrip_logro = ?, id_materia = ? WHERE id_logro = ?;");
    
    # Ejecuta la sentencia pasando los valores correspondientes
    $resultado = $sentencia->execute([$nombre_logro, $descrip_logro, $id_materia, $codigo_logro]);

    # Verifica el resultado
    if($resultado === TRUE) {
        header("Location: logros.php?status=success");
        exit();
    } else {
        header("Location: logros.php?status=error");
        exit();
    }

} catch (PDOException $e) {
    # Captura cualquier error de la base de datos
    error_log("Error de actualización: " . $e->getMessage());
}
?>
