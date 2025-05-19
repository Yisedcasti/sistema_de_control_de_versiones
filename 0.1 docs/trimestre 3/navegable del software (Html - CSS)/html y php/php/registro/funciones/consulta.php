<?php
include_once "../configuracion/Conexion.php";

// Inicializa las variables
$id_rol = null;
$num_doc = null;
$registros = [];
$perfiles = [];

try {
    if (isset($_GET['id_rol']) && is_numeric($_GET['id_rol'])) {
        $id_rol = $_GET['id_rol'];
        $sentencia = $base_de_datos->prepare(" 
            SELECT * FROM registro WHERE registro.rol_id_rol = :id_rol
        ");
        $sentencia->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } 

    //  matricula - gardo- curso -estudiante - registro - rol -jornada 
    if (isset($_GET['num_doc']) && is_numeric($_GET['num_doc'])) {
        $num_doc = $_GET['num_doc'];
        $sentencia = $base_de_datos->prepare(" 
            SELECT * FROM registro 
            INNER JOIN jornada ON registro.jornada_id_jornada = jornada.id_jornada
            WHERE registro.num_doc = :num_doc  
        ");
        $sentencia->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
        $sentencia->execute();
        $perfiles = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } 

    if (!$id_rol && !$num_doc) {
        echo "Parámetros 'id_rol' o 'num_doc' no válidos o ausentes.";
        exit();
    }

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
