<?php
if(!isset($_POST["id_cursos"])) exit();
$id_cursos = $_POST["id_cursos"];
$grado_id_grado =$_POST['grado_id_grado'];  
include_once "conexion.php";
try{
$sentencia = $base_de_datos->prepare("DELETE FROM cursos WHERE id_cursos = ?;");
$resultado = $sentencia->execute([$id_cursos]);

if ($resultado ) {
    header("Location: curso.php?id_grado=$grado_id_grado&status=success");
    exit();
} else {
    header("Location: curso.php?id_grado=$grado_id_grado&status=error");
    exit();
}
}
catch (PDOException $e) {
    error_log("Error de actualización: " . $e->getMessage());
}

?>