<?php
if(!isset($_POST['id_grado'] )|| !isset($_POST['id_curso']) || !isset($_POST['id_estudiante']) );
require_once '../configuracion/conexion.php';

$id_grado = $_POST['id_grado'];
$id_curso = $_POST['id_curso'];
$id_estudiante=$_POST["id_estudiante"];

try{
$consultar = $base_de_datos->prepare("SELECT 
registro_num_doc,
registro_rol_id_rol,
registro_jornada_id_jornada
 FROM estudiante
 WHERE id_estudiante = ? ");
 $consultar->execute([$id_estudiante]);
 $resultado= $consultar->fetch(PDO::FETCH_ASSOC);

 if (!$resultado) {
    exit("No se encontró información para este estudiante.");
}

$estudiante_registro_num_doc = $resultado['registro_num_doc'];
$estudiante_registro_rol_id_rol = $resultado['registro_rol_id_rol'];
$estudiante_registro_jornada_id_jornada = $resultado['registro_jornada_id_jornada'];

$sentencia = $base_de_datos->prepare("INSERT INTO matricula (
grado_id_grado,
cursos_id_cursos,
estudiante_id_estudiante,
estudiante_registro_num_doc,
estudiante_registro_rol_id_rol,
estudiante_registro_jornada_id_jornada
) VALUES (?,?,?,?,?,?) ");

$resultado = $sentencia->execute(
    [
        $id_grado,
        $id_curso,
        $id_estudiante,
        $estudiante_registro_num_doc,
        $estudiante_registro_rol_id_rol,
        $estudiante_registro_jornada_id_jornada]);
        if ($resultado === TRUE) {
            header("Location: ../vistas/observador.php?num_doc=" . urlencode($estudiante_registro_num_doc));
            exit;
        }
        
        else {
            echo ("Error al insertar datos");
            exit;
        }

}
catch (PDOException $e) {
    echo 'Los datos no fueron insertados correctamente: ' . $e->getMessage();
}
?>