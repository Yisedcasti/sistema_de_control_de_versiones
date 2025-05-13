<?php
try {
    include_once "../configuracion/conexion.php";

    $id_grado = $_POST["id_grado"];
    $nivel_educativo = $_POST["nivel_educativo"];
    $grado = $_POST["grado"];  

        $grados = $base_de_datos->prepare("
            UPDATE grado
            SET nivel_educativo = ?, grado = ?
            WHERE id_grado= ?");
        $resultadogrados = $grados->execute([ $nivel_educativo, $grado, $id_grado]);
        
        $base_de_datos->commit();
        header("Location: ../vistas/grados.php?status=success");
exit();
    
}
catch (PDOException $e) {
    // Capturar cualquier error y mostrar el mensaje correspondiente
    header("Location: ../vistas/grados.php?error=" . urlencode($e->getMessage()));
    exit(); 
}
?>
