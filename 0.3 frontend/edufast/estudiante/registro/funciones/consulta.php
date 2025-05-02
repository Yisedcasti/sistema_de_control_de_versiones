<?php
include_once "../configuracion/Conexion.php";

if (!isset($_SESSION["user"])) {
    exit("¡ID no especificado en la sesión!");
}

$num_doc = $_SESSION["user"]; // Obtener el número de documento de la sesión

try {

    // Consulta para obtener el perfil del usuario según su num_doc
    $sentencia = $base_de_datos->prepare("
        SELECT * FROM registro 
        INNER JOIN jornada ON registro.jornada_id_jornada = jornada.id_jornada
        WHERE registro.num_doc = :num_doc
    ");
    $sentencia->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
    $sentencia->execute();
    $perfiles = $sentencia->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
