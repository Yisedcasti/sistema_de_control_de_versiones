<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["id_rol"])) exit("Falta el rol.");
    if (!isset($_POST["tipo_doc"])) exit("Falta el tipo de documento.");
    if (!isset($_POST["num_doc"])) exit("Falta el número de documento.");
    if (!isset($_POST["nombre"])) exit("Falta el nombre.");
    if (!isset($_POST["apellido"])) exit("Falta el apellido.");
    if (!isset($_POST["celular"])) exit("Falta el celular.");
    if (!isset($_POST["telefono"])) exit("Falta el teléfono.");
    if (!isset($_POST["direccion"])) exit("Falta la dirección.");
    if (!isset($_POST["correo"])) exit("Falta el correo.");
    if (!isset($_POST["contraseña"])) exit("Falta la contraseña.");

    require('conexion.php');

    $id_rol = $_POST["id_rol"];
    $jornada_id_jornada = $_POST["jornada_id_jornada"];
    $tipo_doc = $_POST["tipo_doc"];
    $num_doc = $_POST["num_doc"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $celular = $_POST["celular"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    $foto_perfil_new_name = null;

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $foto_perfil = $_FILES['foto_perfil']['name'];
        $tmp_name = $_FILES['foto_perfil']['tmp_name'];
        $directorio = 'imagenes/';

        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $foto_perfil_new_name = uniqid() . "_" . $foto_perfil;

        if (!move_uploaded_file($tmp_name, $directorio . $foto_perfil_new_name)) {
            exit("Error al cargar la imagen.");
        }
    }

    try {
        $sentencia = $base_de_datos->prepare("INSERT INTO registro 
            (rol_id_rol, tipo_doc, num_doc, nombres, apellidos, celular, telefono, direccion, correo, foto_perfil, pass, jornada_id_jornada) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

        $resultado = $sentencia->execute([
            $id_rol, $tipo_doc, $num_doc, $nombre, $apellido, $celular, $telefono,
            $direccion, $correo, $foto_perfil_new_name, $hashed_password, $jornada_id_jornada
        ]);

        if ($resultado) {
            header("Location: registro.php?status=success");
            exit();
        } else {
            header("Location: registro.php?status=error");
            exit();
        }
    } catch (PDOException $e) {
        echo "El error es " . $e->getMessage();
    }
}
?>
