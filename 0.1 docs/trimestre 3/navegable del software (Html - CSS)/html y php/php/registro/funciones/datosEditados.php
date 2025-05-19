<?php
// Verificar si todos los datos necesarios están presentes
if (!isset($_POST["id_rol"]) || !isset($_POST["id_jornada"]) || !isset($_POST["nombre"]) || 
    !isset($_POST["apellido"]) || !isset($_POST["tipo_doc"]) || !isset($_POST["num_doc"]) || 
    !isset($_POST["celular"]) || !isset($_POST["correo"]) || !isset($_POST["usuario"]) || 
    !isset($_POST["contraseña"]) || !isset($_POST["id_grado"]) || !isset($_POST["id_curso"])) {
    exit("Datos incompletos");
}

try {
    // Incluir la conexión a la base de datos
    include_once "../configuracion/conexion.php";
    
    // Obtener los datos del formulario
    $id_rol = $_POST["id_rol"];
    $id_jornada = $_POST["id_jornada"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipo_doc = $_POST["tipo_doc"];
    $num_doc = $_POST["num_doc"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $id_grado = $_POST["id_grado"];
    $id_curso = $_POST["id_curso"];

    // Encriptar la contraseña
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_BCRYPT);
    
    // Actualizar la tabla 'asignacion'
    $sentenciasignar = $base_de_datos->prepare("
        UPDATE asignacion
        SET registro_rol_id_rol = ?, registo_jornada_id_jornada = ?, grado_id_grado = ?, curso_id_curso = ?  
        WHERE registro_num_doc = ?;
    ");
    $resultadoasignar = $sentenciasignar->execute([$id_rol, $id_jornada, $id_grado, $id_curso, $num_doc]);

    // Verificar si la actualización de 'asignacion' fue exitosa
    if (!$resultadoasignar) {
        exit("Error al actualizar la tabla 'asignacion'.");
    }
    
    // Preparar la consulta SQL para actualizar la tabla 'registro'
    $sentencia = $base_de_datos->prepare("
        UPDATE registro 
        SET id_rol = ?, id_jornada = ?, nombre = ?, apellido = ?, tipo_doc = ?, celular = ?, correo = ?, usuario = ?, contraseña = ? 
        WHERE num_doc = ?;
    ");
    $resultado = $sentencia->execute([$id_rol, $id_jornada, $nombre, $apellido, $tipo_doc, $celular, $correo, $usuario, $contraseña, $num_doc]);

    // Verificar si la actualización de 'registro' fue exitosa
    if ($resultado) {
        echo "Cambios guardados correctamente.";
    } else {
        echo "Error al actualizar los datos en la tabla 'registro'.";
    }

} catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error en la conexión o en la consulta: " . $e->getMessage();
}
?>
