<?php
if(!isset($_POST["id_logro"]) || !isset($_POST["nombre_logro"]) || !isset($_POST["descrip_logro"]) || !isset($_POST["id_materia"])) exit();
include_once"conexion.php";
$id_logro=$_POST["id_logro"];
$nombre_logro=$_POST["nombre_logro"];
$descrip_logro=$_POST["descrip_logro"];
$id_materia=$_POST["id_materia"];

$consultar = $base_de_datos->prepare("SELECT 
        grado_id_grado, 		
		area_id_area, 		
		docente_id_docente, 	
		docente_cursos_id_cursos, 	
		docente_cursos_grado_id_grado, 	
		docente_registro_num_doc, 	
		docente_registro_rol_id_rol, 
		docente_registro_jornada_id_jornada
FROM materia WHERE id_materia = ?");
$consultar->execute([$id_materia]);
$resultado = $consultar->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    exit("No se encontró información para este docente.");
}

$grado_id_grado  = $resultado['grado_id_grado'];
$area_id_area  = $resultado['area_id_area'];
$docente_id_docente  = $resultado['docente_id_docente'];
$docente_cursos_id_cursos  = $resultado['docente_cursos_id_cursos'];
$docente_cursos_grado_id_grado  = $resultado['docente_cursos_grado_id_grado'];
$docente_registro_num_doc  = $resultado['docente_registro_num_doc'];
$docente_registro_rol_id_rol  = $resultado['docente_registro_rol_id_rol'];
$docente_registro_jornada_id_jornada  = $resultado['docente_registro_jornada_id_jornada'];

$sentencia = $base_de_datos->prepare("INSERT INTO logro (id_logro,
        nombre_logro, 
        descripcion_logro, 
        materia_id_materia,
        materia_grado_id_grado, 		
		materia_area_id_area, 		
		materia_docente_id_docente, 	
		materia_docente_cursos_id_cursos, 	
		materia_docente_cursos_grado_id_grado, 	
		materia_docente_registro_num_doc, 	
		materia_docente_registro_rol_id_rol, 
		materia_docente_registro_jornada_id_jornada) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);");
$resultado =  $sentencia->execute([$id_logro ,
$nombre_logro,
$descrip_logro,
$id_materia,
$grado_id_grado,
$area_id_area,
$docente_id_docente,
$docente_cursos_id_cursos, 
$docente_cursos_grado_id_grado,
$docente_registro_num_doc, 
$docente_registro_rol_id_rol,
$docente_registro_jornada_id_jornada ]);
if($resultado === TRUE){  header("Location: logros.php?status=success");
	exit();
}
else {  header("Location: logros.php?status=success");
	exit();
}
?>