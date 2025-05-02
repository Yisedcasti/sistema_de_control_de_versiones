<?php
include_once '../configuracion/conexion.php';

try {
    $num_doc = $_POST['num_doc'];
    $foto_perfil = $_POST["foto_perfil"]; 
    $celular = $_POST["celular"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];

    $foto = $foto_perfil; // Mantiene la imagen anterior por defecto

    if (isset($_FILES['nueva_img']) && $_FILES['nueva_img']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['nueva_img']['name'];
        $tmp_name = $_FILES['nueva_img']['tmp_name'];
        $directorio = '../../../imagenes/'; // Asegurar que termina con '/'

        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $directorio . $foto)) {
            if ($foto_perfil && $foto_perfil != $foto) {
                $imagen_anterior = $directorio . $foto_perfil;
                if (file_exists($imagen_anterior)) {
                    unlink($imagen_anterior);
                }
            }
        } else {
            echo "Error al mover el archivo. Verifica los permisos del directorio.";
            exit();
        }
    }

    $sentencia = $base_de_datos->prepare("UPDATE registro SET foto_perfil = ?, celular = ?, telefono = ?, direccion = ?, correo = ? WHERE num_doc = ?");
    $resultado = $sentencia->execute([$foto, $celular, $telefono, $direccion, $correo, $num_doc]);

    if ($resultado) {
        header("Location:../view/perfil.php?status=success");
        exit();
    } else {
        header("Location: pagina a la que se va a dirigir.php?status=error");
        exit();
    }

} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
    exit();
}
?>
