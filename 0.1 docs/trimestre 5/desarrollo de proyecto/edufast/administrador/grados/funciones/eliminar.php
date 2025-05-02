<?php 
require '../configuracion/conexion.php';

$id_grado = $_POST['id_grado'];

try {
    $base_de_datos->beginTransaction();


    // Eliminar  en "grado"
    $sqlRegistro = "DELETE FROM grado WHERE id_grado = :id_grado";
    $stmtRegistro = $base_de_datos->prepare($sqlRegistro);
    $stmtRegistro->execute([':id_grado' => $id_grado]);


    $base_de_datos->commit();
    header("Location: grados.php?status=success");
    exit();

} catch (Exception $e) {

    $base_de_datos->rollBack();

    header("Location: ../vistas/grados.php?error=" . urlencode($e->getMessage()));
    exit(); 
}
?>
