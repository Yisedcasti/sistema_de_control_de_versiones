<?php
try {
    // Incluir la conexión a la base de datos
    include_once "conexion.php";
    
    // Verificar si los datos fueron enviados por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir los datos del formulario
        $id_actividad = $_POST['id_actividad'];
        $nom_actividad = $_POST['nom_actividad'];
        $descrip_actividad = $_POST['descrip_actividad'];
        $fecha_entrega = $_POST['fecha_entrega'];
        $codigo_logro = $_POST['codigo_logro'];

        // Segunda consulta: actualizar la tabla actividad
        $sentencia = $base_de_datos->prepare("
            UPDATE actividad
            SET nombre_act = ?, descripcion = ?, fecha_entrega = ?, logro_id_logro = ?
            WHERE id_actividad = ?");
        $resultado = $sentencia->execute([$nom_actividad, $descrip_actividad, $fecha_entrega, $codigo_logro, $id_actividad]);

        if ($resultado) {
            header("Location: actividad.php?status=success");
        } else {
            // Si algo salió mal, mostrar mensaje de error
            header("Location: actividad.php?status=error");
        }
    }
} catch (PDOException $e) {
    // Capturar y mostrar cualquier error de la base de datos
    echo "Error en la base de datos: " . $e->getMessage();
}
?>
