<?php
include_once "conexion.php";

if (!isset($_POST["idAsistencia"])) {
    exit();
}

$idAsistencia = $_POST["idAsistencia"];
$matricula_id_matricula =$_POST['matricula_id_matricula'];  


$sentencia = $base_de_datos->prepare("DELETE FROM asistencia WHERE idAsistencia = ?;");
$resultado = $sentencia->execute([$idAsistencia]);

if ($resultado) {
    header("Location: asistencia.php?id_matricula=$matricula_id_matricula&status=success");
    exit();
} else {
    header("Location: asistencia.php?id_matricula=$matricula_id_matricula&status=error");
    exit();
}
?>
