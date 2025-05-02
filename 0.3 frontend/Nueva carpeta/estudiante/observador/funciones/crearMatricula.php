<?php
$missing_fields = [];

if (!isset($_POST["sexo"])) {
    $missing_fields[] = "Sexo";
}
if (!isset($_POST["fecha_nacimiento"])) {
    $missing_fields[] = "Fecha de Nacimiento";
}
if (!isset($_POST["Eps"])) {
    $missing_fields[] = "Eps";
}
if (!isset($_POST["RH"])) {
    $missing_fields[] = "RH";
}
if (!isset($_POST["Nivel_educativo"])) {
    $missing_fields[] = "Nivel educativo";
}
if (!isset($_POST["Estado"])) {
    $missing_fields[] = "Estado";
}
if (!isset($_POST["Registro_num_doc"])) {
    $missing_fields[] = "Número de Documento de Registro";
}

if (!empty($missing_fields)) {
    // Mostrar los campos que faltan
    echo "Faltan los siguientes datos: " . implode(", ", $missing_fields);
    exit();
}


include_once"../configuracion/conexion.php";

$sexo=$_POST["sexo"];
$fecha_nacimiento=$_POST["fecha_nacimiento"];
$Eps=$_POST["Eps"];
$RH=$_POST["RH"];
$Nivel_educativo=$_POST["Nivel_educativo"];
$Estado=$_POST["Estado"];
$Registro_num_doc=$_POST["Registro_num_doc"];


$consultar = $base_de_datos->prepare("SELECT 
     rol_id_rol, 
	 jornada_id_jornada
FROM registro WHERE num_doc = ?");
$consultar->execute([$Registro_num_doc]);
$resultado = $consultar->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    exit("No se encontró información para este estudiante.");
}

$registro_rol_id_rol = $resultado['rol_id_rol'];
$registro_jornada_id_jornada = $resultado['jornada_id_jornada'];

$sentencia = $base_de_datos->prepare("INSERT INTO estudiante (
sexo,	
fecha_nacimiento,	
Eps,	
RH,	
Nivel_educativo, 
Estado,		
registro_num_doc,
registro_rol_id_rol,	
registro_jornada_id_jornada) VALUES (?,?,?,?,?,?,?,?,?);");
$resultado =  $sentencia->execute([
$sexo,	
$fecha_nacimiento,	
$Eps,	
$RH,	
$Nivel_educativo, 
$Estado,		
$Registro_num_doc,
$registro_rol_id_rol,	
$registro_jornada_id_jornada ]);
if($resultado === TRUE){  header(header: "Location: ../vistas/observador.php?status=success");
	exit();
}
else {  header("Location: ../vistas/observador.php?status=error");
	exit();
}
?>