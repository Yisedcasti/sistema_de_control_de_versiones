<?php
try {
    include_once "configuracion/conexion.php";
    
    // Variables recibidas desde el formulario (POST)
    $id_nota = $_POST["id_nota"];
    $fecha_nota = $_POST["fecha_nota"];
    $nota = $_POST["nota"];
    $registro_num_doc = $_POST["registro_num_doc"];
    $actividades_id_actividades = $_POST["actividades_id_actividades"];

    // Consultar información del registro relacionado
    $consultaregristro = $base_de_datos->prepare("SELECT id_rol, id_jornada FROM registro WHERE num_doc = ?");
    $consultaregristro->execute([$registro_num_doc]);
    $resultadoregistro =  $consultaregristro->fetch(PDO::FETCH_ASSOC);

    if (!$resultadoregistro) {
        exit("No se encontró información para este registro.");
    }

    // Guardar 'id_rol y id_jornada'
    $registro_rol_id_rol = $resultadoregistro['id_rol'];
    $registro_jornada_id_jornada = $resultadoregistro['id_jornada'];

    // Consultar información de la actividad relacionada
    $consultaractividad = $base_de_datos->prepare("SELECT logro_Codigo_logro, logro_materia_id_materia FROM actividad WHERE id_actividad = ?");
    $consultaractividad->execute([$actividades_id_actividades]);
    $resultadoactividad = $consultaractividad->fetch(PDO::FETCH_ASSOC);

    if (!$resultadoactividad) {
        exit("No se encontró información para esta actividad.");
    }

    // Guardar 'logro_Codigo_logro y logro_materia_id_materia'
    $actividades_logro_Codigo_logro = $resultadoactividad['logro_Codigo_logro'];
    $actividades_logro_materia_id_materias = $resultadoactividad['logro_materia_id_materia'];

    // Sentencia SQL para actualizar el registro
    $sentencia = $base_de_datos->prepare("
        UPDATE nota 
        SET 
            fecha_nota = ?, 
            nota = ?, 
            registro_num_doc = ?, 
            registro_rol_id_rol = ?, 
            registro_jornada_id_jornada = ?, 
            actividades_id_actividades = ?, 
            actividades_logro_Codigo_logro = ?, 
            actividades_logro_materia_id_materias = ?
        WHERE id_nota = ?
    ");

    // Ejecutar la consulta con los nuevos valores y el id del registro a actualizar
    $resultado = $sentencia->execute([
        $fecha_nota, 
        $nota, 
        $registro_num_doc, 
        $registro_rol_id_rol, 
        $registro_jornada_id_jornada, 
        $actividades_id_actividades, 
        $actividades_logro_Codigo_logro, 
        $actividades_logro_materia_id_materias, 
        $id_nota  // Condición para actualizar
    ]);

    // Verificar si la actualización fue exitosa
    if ($resultado === TRUE) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Algo salió mal. Por favor, verifica que la tabla exista.";
    }
} catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error: " . $e->getMessage();
}
?>
