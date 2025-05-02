<?php
include_once "../configuracion/Conexion.php";

// Realiza la consulta a la base de datos
try {
    $sentencia = $base_de_datos->prepare(" SELECT * FROM public_eventos 
    INNER JOIN registro ON registro.num_doc = Public_eventos.registro_num_doc");
    $sentencia->execute();
    $publicacionesEventos = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $sentencia = $base_de_datos->prepare(" SELECT * FROM public_noticias 
    INNER JOIN registro ON registro.num_doc = Public_noticias.registro_num_doc");
    $sentencia->execute();
    $publicacionesNoticias = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $registros = $base_de_datos->query("SELECT * FROM registro")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
