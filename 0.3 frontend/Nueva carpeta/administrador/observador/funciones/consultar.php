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
    $sql1 = "SELECT estudiante.*, registro.*  
             FROM estudiante
             INNER JOIN registro ON estudiante.registro_num_doc = registro.num_doc
             LEFT JOIN matricula ON registro.num_doc = matricula.estudiante_registro_num_doc 
             WHERE matricula.estudiante_registro_num_doc IS NULL";

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
    $sql2 = "SELECT registro.num_doc, registro.nombres, registro.apellidos, 
                    grado.grado AS nombre_grado, cursos.curso AS nombre_curso 
             FROM matricula
             INNER JOIN registro ON matricula.estudiante_registro_num_doc = registro.num_doc
             INNER JOIN grado ON matricula.grado_id_grado = grado.id_grado
             INNER JOIN cursos ON matricula.cursos_id_cursos = cursos.id_cursos";

    if (!empty($busqueda)) {
        $sql2 .= " WHERE registro.num_doc LIKE :busqueda";
    }

    $sentencia2 = $base_de_datos->prepare($sql2);

    if (!empty($busqueda)) {
        $sentencia2->bindParam(':busqueda', $busqueda_param, PDO::PARAM_STR);
    }

    $sentencia2->execute();
    $estudiantes = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

    $consulta = $base_de_datos->prepare("
    SELECT observacion.*, estudiante.*, observador.*, registro.*
    FROM observacion 
    INNER JOIN observador ON observacion.observador_id_observador = observador.id_observador
    INNER JOIN estudiante ON observacion.estudiante_id_estudiante = estudiante.id_estudiante
    INNER JOIN registro ON estudiante.registro_num_doc = registro.num_doc
    WHERE registro.num_doc = :num_doc
");

$consulta->bindParam(':num_doc', $busqueda, PDO::PARAM_STR);
$consulta->execute();
$compromisos = $consulta->fetchAll(PDO::FETCH_ASSOC);


$consulta = $base_de_datos->prepare("SELECT *
FROM observador 
INNER JOIN registro ON observador.num_doc = registro.num_doc
WHERE registro.num_doc = :num_doc
");

$consulta->bindParam(':num_doc', $busqueda, PDO::PARAM_STR);
$consulta->execute();
$observadores = $consulta->fetchAll(PDO::FETCH_ASSOC);

    
    $grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);
    $cursos = $base_de_datos->query("SELECT * FROM cursos ORDER BY curso ASC")->fetchAll(PDO::FETCH_ASSOC);
    $jornadas = $base_de_datos->query("SELECT * FROM jornada")->fetchAll(PDO::FETCH_ASSOC);




} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

?>
