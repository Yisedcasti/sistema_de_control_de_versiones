<?php
include_once "../configuracion/Conexion.php";

$id_rol = 6;
$num_doc = null;
$registros = [];
$estudiantes = [];

try {
    // define la variable de busqueda 
    $busqueda = isset($_GET['num_doc']) ? trim($_GET['num_doc']) : ''; 

    //consulta para buscar los alumnos que no tenga un registro en matricula 
    $sql1 = "SELECT docente.*, registro.*, dc.*, dm.* 
       FROM docente 
       INNER JOIN registro ON docente.registro_num_doc = registro.num_doc
       LEFT JOIN docente_has_cursos AS dc ON dc.docente_id_docente = docente.id_docente
       LEFT JOIN docente_has_materia AS dm ON dm.docente_id_docente = docente.id_docente
       WHERE dc.docente_id_docente IS NULL AND dm.docente_id_docente IS NULL
";

    if (!empty($busqueda)) {
        $sql1 .= " AND registro.num_doc LIKE :busqueda";
    }

    $sentencia1 = $base_de_datos->prepare($sql1);

    if (!empty($busqueda)) {
        $busqueda_param = "%$busqueda%";
        $sentencia1->bindParam(':busqueda', $busqueda_param, PDO::PARAM_STR);
    }

    $sentencia1->execute();
    $registros = $sentencia1->fetchAll(PDO::FETCH_OBJ);

    // Consulta para los alumnos que tengan un registro en matricula 
    $sql2 = "SELECT docente.*, registro.*, dc.*, dm.*, cursos.*, grado.*, materia.*
    FROM docente 
    INNER JOIN registro ON docente.registro_num_doc = registro.num_doc
    INNER JOIN docente_has_cursos AS dc ON dc.docente_id_docente = docente.id_docente
    INNER JOIN docente_has_materia AS dm ON dm.docente_id_docente = docente.id_docente
    INNER JOIN cursos ON dc.cursos_id_cursos = cursos.id_cursos
    INNER JOIN grado ON cursos.grado_id_grado = grado.id_grado
    INNER JOIN materia ON dm.materia_id_materia = materia.id_materia
    ";

    if (!empty($busqueda)) {
        $sql2 .= " WHERE registro.num_doc LIKE :busqueda";
    }

    $sentencia2 = $base_de_datos->prepare($sql2);

    if (!empty($busqueda)) {
        $sentencia2->bindParam(':busqueda', $busqueda_param, PDO::PARAM_STR);
    }

    $sentencia2->execute(); 
    $maestros  = $sentencia2->fetchAll(PDO::FETCH_ASSOC);


if ($busqueda) {
    $stmt = $base_de_datos->prepare("SELECT * FROM docente 
        INNER JOIN registro ON docente.registro_num_doc = registro.num_doc 
        WHERE registro.num_doc = ?");
    $stmt->execute([$busqueda]);
    $docentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $docentes = [];
}

    $materias = $base_de_datos->query("SELECT * FROM materia")->fetchAll(PDO::FETCH_ASSOC);
    $cursos = $base_de_datos->query("SELECT * FROM cursos ORDER BY curso DESC")->fetchAll(PDO::FETCH_ASSOC);
    $jornadas = $base_de_datos->query("SELECT * FROM jornada WHERE id_jornada <> 1")->fetchAll(PDO::FETCH_ASSOC);




} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

?>
