<?php
try {
    include_once "conexion.php";
    
    // Obtener los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $idAsistencia = $_POST['idAsistencia'];
       date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');
       $asistencia = $_POST['asistencia'];
       $matricula_id_matricula =$_POST['matricula_id_matricula'];   


        // Preparar la consulta SQL para actualizar los datos
        $sentencia = $base_de_datos->prepare("
            UPDATE asistencia
            SET fecha_asistencia = ?,asistencia = ?
            WHERE idAsistencia = ? ");
        $resultado = $sentencia->execute([$fecha, $asistencia, $idAsistencia]);

        if ($resultado === TRUE) {
            header("Location: asistencia.php?id_matricula=$matricula_id_matricula&status=success");
            exit();
            
        } else {
            header("Location: asistencia.php?id_matricula=$matricula_id_matricula&status=error");
            exit();
        }
    }
} catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error: " . $e->getMessage();
}
?>