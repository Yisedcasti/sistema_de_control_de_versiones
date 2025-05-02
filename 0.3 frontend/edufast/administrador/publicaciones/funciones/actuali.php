<?php
try {
    include_once "../configuracion/conexion.php";
    
    $id_evento = $_POST["id_evento"];
    $evento = $_POST["evento"];
    $fecha_evento = $_POST["fecha_evento"];
    $img_actual = $_POST["img_actual"]; 
    
    // Inicializar la variable para la nueva imagen
    $img = $img_actual; // Si no se sube una nueva imagen, mantendremos la anterior

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['nueva_img']) && $_FILES['nueva_img']['error'] === UPLOAD_ERR_OK) {
        // Obtenemos el nombre del archivo y la ruta temporal
        $img = $_FILES['nueva_img']['name'];
        $tmp_name = $_FILES['nueva_img']['tmp_name'];
        $directorio = '../../../imagenes/';  // Ruta de destino de la imagen
        
        // Crear el directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Mover la imagen subida al directorio
        if (move_uploaded_file($tmp_name, $directorio . $img)) {
            // Si se ha subido una nueva imagen, eliminamos la anterior (si existe)
            if ($img_actual && $img_actual != $img) {
                $imagen_anterior = $directorio . $img_actual;
                if (file_exists($imagen_anterior)) {
                    unlink($imagen_anterior);  // Eliminamos la imagen antigua
                }
            }
        } else {
            echo "Error al mover el archivo. Verifica los permisos del directorio.";
            exit();
        }
    }

    // Preparar la sentencia SQL para actualizar los datos
    $sentencia = $base_de_datos->prepare("UPDATE public_eventos SET img = ?, evento = ?, fecha_evento = ? WHERE id_evento = ?");
    $resultado = $sentencia->execute([$img, $evento, $fecha_evento, $id_evento]);

    // Verificar si la actualización fue exitosa
    if ($resultado) {
        header("Location: pagina ala que se va a dirigir?status=success");
        exit();
    } else {
        header("Location: pagina ala que se va a dirigir?status=error");
   exit();
    }

} catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error: " . $e->getMessage();
}
?>
