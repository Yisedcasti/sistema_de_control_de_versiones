<?php

include_once "conexion.php";
$id_materia = $_POST["id_materia"]; 
$materia = $_POST["materia"];
$grado_id_grado = $_POST["grado_id_grado"];
$area_id_area = $_POST["area_id_area"];
$docente_registro_num_doc = $_POST["docente_registro_num_doc"];
$docente_id_docente = $_POST["docente_id_docente"];

// Consultar la información del docente
$consultar = $base_de_datos->prepare("SELECT cursos_id_cursos,
                                        cursos_grado_id_grado,
                                        registro_rol_id_rol,
                                        registro_jornada_id_jornada   
                                    FROM docente  
                                    WHERE id_docente = ?");

$consultar->execute([$docente_id_docente]);
$resultado = $consultar->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    exit("No se encontró información para este docente.");
}

$docente_cursos_id_cursos = $resultado['cursos_id_cursos'];
$docente_cursos_grado_id_grado = $resultado['cursos_grado_id_grado'];
$docente_registro_rol_id_rol = $resultado['registro_rol_id_rol'];
$docente_registro_jornada_id_jornada = $resultado['registro_jornada_id_jornada'];

// Preparar la sentencia de actualización
$sentencia = $base_de_datos->prepare("UPDATE materia 
                                      SET materia = ?, 
                                          grado_id_grado = ?, 
                                          area_id_area = ?, 
                                          docente_id_docente = ?, 
                                          docente_cursos_id_cursos = ?, 
                                          docente_cursos_grado_id_grado = ?, 
                                          docente_registro_num_doc = ?, 
                                          docente_registro_rol_id_rol = ?, 
                                          docente_registro_jornada_id_jornada = ?
                                      WHERE id_materia = ?");

$resultado = $sentencia->execute([
    $materia, 
    $grado_id_grado, 
    $area_id_area, 
    $docente_id_docente, 
    $docente_cursos_id_cursos, 
    $docente_cursos_grado_id_grado, 
    $docente_registro_num_doc, 
    $docente_registro_rol_id_rol, 
    $docente_registro_jornada_id_jornada, 
    $id_materia
]);

if ($resultado) {
    header("Location: Materia.php?status=success");
    exit();
} else {
    header("Location: Materia.php?status=error");
exit();
}
?>
