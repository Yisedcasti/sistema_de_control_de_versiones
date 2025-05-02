<?php
include_once "../configuracion/Conexion.php";

$id_rol = 6; 
$num_doc = null;
$registros = [];
$perfiles = [];

try {
   
    $sentencia = $base_de_datos->prepare("
        SELECT registro.* 
        FROM registro
        LEFT JOIN matricula ON registro.num_doc = matricula.estudiante_registro_num_doc
        WHERE registro.rol_id_rol = :id_rol AND matricula.estudiante_registro_num_doc IS NULL
    ");
    $sentencia->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
    $sentencia->execute();
    $registros = $sentencia->fetchAll(PDO::FETCH_OBJ);

    if (isset($_GET['num_doc']) && is_numeric($_GET['num_doc'])) {
        $num_doc = (int) $_GET['num_doc']; 
        $sentencia = $base_de_datos->prepare("
            SELECT * FROM registro 
            INNER JOIN jornada ON registro.jornada_id_jornada = jornada.id_jornada
            WHERE registro.num_doc = :num_doc  
        ");
        $sentencia->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
        $sentencia->execute();
        $perfiles = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    

    $grados = $base_de_datos->query("SELECT * FROM grado ")->fetchAll(PDO::FETCH_ASSOC);
    $cursos = $base_de_datos->query("SELECT * FROM cursos ORDER BY curso ASC")->fetchAll(PDO::FETCH_ASSOC);
    $jornadas = $base_de_datos->query("SELECT * FROM jornada")->fetchAll(PDO::FETCH_ASSOC);
    $estudiantes = $base_de_datos->query("SELECT 
    registro.*, 
    estudiante.*, 
    matricula.*, 
    grado.grado AS nombre_grado, 
    cursos.curso AS nombre_curso
FROM registro
INNER JOIN estudiante ON registro.num_doc = estudiante.registro_num_doc
INNER JOIN matricula ON matricula.estudiante_registro_num_doc = registro.num_doc
INNER JOIN grado ON matricula.grado_id_grado = grado.id_grado
INNER JOIN cursos ON matricula.cursos_id_cursos = cursos.id_cursos;

")->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
