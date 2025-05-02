<?php
try {
    if (
        !isset($_POST['id_observador']) || 
        !isset($_POST['Tel_emergencia']) || 
        !isset($_POST['padre_nombre']) || 
        !isset($_POST['padre_apellido']) ||
        !isset($_POST['padre_ocupacion']) ||
        !isset($_POST['padre_cedula']) ||
        !isset($_POST['padre_direccion']) ||
        !isset($_POST['padre_telefono']) ||
        !isset($_POST['padre_correo']) ||
        !isset($_POST['madre_nombre']) || 
        !isset($_POST['madre_apellido']) ||
        !isset($_POST['madre_ocupacion']) ||
        !isset($_POST['madre_cedula']) ||
        !isset($_POST['madre_direccion']) ||
        !isset($_POST['madre_telefono']) ||
        !isset($_POST['madre_correo']) ||
        !isset($_POST['acudiente_nombre']) || 
        !isset($_POST['acudiente_apellido']) ||
        !isset($_POST['acudiente_ocupacion']) ||
        !isset($_POST['acudiente_cedula']) ||
        !isset($_POST['acudiente_direccion']) ||
        !isset($_POST['acudiente_telefono']) ||
        !isset($_POST['acudiente_correo'])
    ) {
        header("Location: ../vistas/observador.php?status=error_datos");
        exit();
    }

    include_once '../configuracion/conexion.php';

    $id_observador = $_POST['id_observador'];
    $Tel_emergencia = $_POST['Tel_emergencia'];
    $padre_nombre = $_POST['padre_nombre'];
    $padre_apellido = $_POST['padre_apellido'];
    $padre_ocupacion = $_POST['padre_ocupacion'];
    $padre_cedula = $_POST['padre_cedula'];
    $padre_direccion = $_POST['padre_direccion'];
    $padre_telefono = $_POST['padre_telefono'];
    $padre_correo = $_POST['padre_correo'];
    $madre_nombre = $_POST['madre_nombre'];
    $madre_apellido = $_POST['madre_apellido'];
    $madre_ocupacion = $_POST['madre_ocupacion'];
    $madre_cedula = $_POST['madre_cedula'];
    $madre_direccion = $_POST['madre_direccion'];
    $madre_telefono = $_POST['madre_telefono'];
    $madre_correo = $_POST['madre_correo'];
    $acudiente_nombre = $_POST['acudiente_nombre'];
    $acudiente_apellido = $_POST['acudiente_apellido'];
    $acudiente_ocupacion = $_POST['acudiente_ocupacion'];
    $acudiente_cedula = $_POST['acudiente_cedula'];
    $acudiente_direccion = $_POST['acudiente_direccion'];
    $acudiente_telefono = $_POST['acudiente_telefono'];
    $acudiente_correo = $_POST['acudiente_correo'];

    $sentencia = $base_de_datos->prepare('UPDATE observador SET 
        Tel_emergencia = ?, 
        padre_nombre = ?, 
        padre_apellido = ?, 
        padre_ocupacion = ?, 
        padre_cedula = ?, 
        padre_direccion = ?, 
        padre_telefono = ?, 
        padre_correo = ?, 
        madre_nombre = ?, 
        madre_apellido = ?, 
        madre_ocupacion = ?, 
        madre_cedula = ?, 
        madre_direccion = ?, 
        madre_telefono = ?, 
        madre_correo = ?, 
        acudiente_nombre = ?, 
        acudiente_apellido = ?, 
        acudiente_ocupacion = ?, 
        acudiente_cedula = ?, 
        acudiente_direccion = ?, 
        acudiente_telefono = ?, 
        acudiente_correo = ? 
        WHERE id_observador = ?');

    $result = $sentencia->execute([
        $Tel_emergencia,
        $padre_nombre,
        $padre_apellido,
        $padre_ocupacion,
        $padre_cedula,
        $padre_direccion,
        $padre_telefono,
        $padre_correo,
        $madre_nombre,
        $madre_apellido,
        $madre_ocupacion,
        $madre_cedula,
        $madre_direccion,
        $madre_telefono,
        $madre_correo,
        $acudiente_nombre,
        $acudiente_apellido,
        $acudiente_ocupacion,
        $acudiente_cedula,
        $acudiente_direccion,
        $acudiente_telefono,
        $acudiente_correo,
        $id_observador
    ]);

    if ($result === TRUE) {
        header("Location: ../vistas/observador.php?status=success");
        exit();
    } else {
        header("Location: ../vistas/observador.php?status=error");
        exit();
    }

} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
    exit();
}
?>
