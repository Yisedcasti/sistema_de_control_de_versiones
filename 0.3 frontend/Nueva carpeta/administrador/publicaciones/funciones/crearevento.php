<?php
try {
    include_once "../configuracion/conexion.php";
    
    $evento = $_POST["evento"];
    $fecha_evento = $_POST["fecha_evento"];
    $registro_num_doc = $_POST["registro_num_doc"];
    
    if (isset($_FILES['imagen'])) {
        $imagen = $_FILES['imagen']['name'];
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $directorio = '../../imagenes/';
        
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        if (move_uploaded_file($tmp_name, $directorio . $imagen)) {
            $sentencia = $base_de_datos->prepare("INSERT INTO public_eventos (img, evento, fecha_evento, registro_num_doc) 
                VALUES (?, ?, ?, ?);");
                
            $resultado = $sentencia->execute([$imagen, $evento, $fecha_evento, $registro_num_doc]);
            
            if ($resultado === TRUE) {
                header("Location: ../vistas/publicaciones_crear.php?status=success");
                exit();
            } else {
                header("Location: ../vistas/publicaciones_crear.php?status=error");
                exit();
            }
        } else {
            echo "Error al mover el archivo. Verifica los permisos del directorio.";
        }
    } else {
        echo "No se ha subido ninguna imagen.";
    }
}
catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error: " . $e->getMessage();
}
?>
