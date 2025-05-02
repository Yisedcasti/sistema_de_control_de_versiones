<?php
$missing_fields = [];

// Validación de campos obligatorios
$required_fields = [
    "sexo" => "Sexo",
    "fecha_nacimiento" => "Fecha de Nacimiento",
    "Eps" => "EPS",
    "RH" => "RH",
    "Nivel_educativo" => "Nivel educativo",
    "grado_cursado" => "Grado cursado",
    "Estado" => "Estado",
    "Registro_num_doc" => "Número de Documento de Registro",
    "Tel_emergencia" => "Teléfono de Emergencia",
    "padre_nombre" => "Nombre del padre",
    "padre_apellido" => "Apellido del padre",
    "padre_ocupacion" => "Ocupación del padre",
    "padre_cedula" => "Cédula del padre",
    "padre_direccion" => "Dirección del padre",
    "padre_telefono" => "Teléfono del padre",
    "padre_correo" => "Correo del padre",
    "madre_nombre" => "Nombre de la madre",
    "madre_apellido" => "Apellido de la madre",
    "madre_ocupacion" => "Ocupación de la madre",
    "madre_cedula" => "Cédula de la madre",
    "madre_direccion" => "Dirección de la madre",
    "madre_telefono" => "Teléfono de la madre",
    "madre_correo" => "Correo de la madre",
    "acudiente_nombre" => "Nombre del acudiente",
    "acudiente_apellido" => "Apellido del acudiente",
    "acudiente_ocupacion" => "Ocupación del acudiente",
    "acudiente_cedula" => "Cédula del acudiente",
    "acudiente_direccion" => "Dirección del acudiente",
    "acudiente_telefono" => "Teléfono del acudiente",
    "acudiente_correo" => "Correo del acudiente"
];

foreach ($required_fields as $field => $label) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        $missing_fields[] = $label;
    }
}

if (!empty($missing_fields)) {
    echo "Faltan los siguientes datos: " . implode(", ", $missing_fields);
    exit();
}

include_once "../configuracion/conexion.php";

session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Debes iniciar sesión para acceder a esta página.";
    header('Location: ../src/protected.php');
    exit;
}

$Registro_num_doc = $_SESSION["user"];

extract($_POST);

$consulta = $base_de_datos->prepare("SELECT rol_id_rol, jornada_id_jornada FROM registro WHERE num_doc = ?");
$consulta->execute([$Registro_num_doc]);
$datosRegistro = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$datosRegistro) {
    exit("No se encontró información para este estudiante.");
}

$rol_id = $datosRegistro['rol_id_rol'];
$jornada_id = $datosRegistro['jornada_id_jornada'];

$sentenciaEstudiante = $base_de_datos->prepare("INSERT INTO estudiante (
    sexo, fecha_nacimiento, Eps, RH, Nivel_educativo, grado_cursado,
    Estado, registro_num_doc, registro_rol_id_rol, registro_jornada_id_jornada
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$resultadoEstudiante = $sentenciaEstudiante->execute([
    $sexo, $fecha_nacimiento, $Eps, $RH, $Nivel_educativo,
    $grado_cursado, $Estado, $Registro_num_doc, $rol_id, $jornada_id
]);

// Insertar en tabla observador
$sentenciaObservador = $base_de_datos->prepare("INSERT INTO observador (
    num_doc,Tel_emergencia, padre_nombre, padre_apellido, padre_ocupacion, padre_cedula, 
    padre_direccion, padre_telefono, padre_correo, madre_nombre, madre_apellido, 
    madre_ocupacion, madre_cedula, madre_direccion, madre_telefono, madre_correo, 
    acudiente_nombre, acudiente_apellido, acudiente_ocupacion, acudiente_cedula, 
    acudiente_direccion, acudiente_telefono, acudiente_correo
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

$resultadoObservador = $sentenciaObservador->execute([
    $Registro_num_doc,$Tel_emergencia, $padre_nombre, $padre_apellido, $padre_ocupacion, $padre_cedula,
    $padre_direccion, $padre_telefono, $padre_correo, $madre_nombre, $madre_apellido,
    $madre_ocupacion, $madre_cedula, $madre_direccion, $madre_telefono, $madre_correo,
    $acudiente_nombre, $acudiente_apellido, $acudiente_ocupacion, $acudiente_cedula,
    $acudiente_direccion, $acudiente_telefono, $acudiente_correo
]);

// Redirección con estado
if ($resultadoEstudiante && $resultadoObservador) {
    header("Location: ../vistas/observador.php?status=success");
    exit();
} else {
    header("Location: ../vistas/observador.php?status=error");
    exit();
}
?>
