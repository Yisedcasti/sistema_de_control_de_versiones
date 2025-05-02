<?php
include "Conexion.php"; 
$sentencia = $base_de_datos->query(" SELECT materia.*, grado.*, docente.*, area.*, registro.*
FROM materia
INNER JOIN grado ON materia.grado_id_grado = grado.id_grado
INNER JOIN docente ON materia.docente_id_docente = docente.id_docente
INNER JOIN cursos ON docente.cursos_id_cursos = cursos.id_cursos
INNER JOIN area ON materia.area_id_area = area.id_area
INNER JOIN registro ON docente.registro_num_doc = registro.num_doc
ORDER BY area.nombre_area ASC;  
;");

$materias = $sentencia->fetchAll(PDO::FETCH_OBJ);


$registros = $base_de_datos->query("SELECT * FROM registro where rol_id_rol = 5")->fetchAll(PDO::FETCH_ASSOC);
$grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);
$docentes = $base_de_datos->query("SELECT * FROM docente")->fetchAll(PDO::FETCH_ASSOC);
$areas = $base_de_datos->query("SELECT * FROM area")->fetchAll(PDO::FETCH_ASSOC);

?>