<?php
include_once "conexion.php";


try {

    $num_doc = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if ($num_doc !== null) {

    $sql_matricula = "SELECT id_matricula FROM matricula WHERE estudiante_registro_num_doc = :num_doc";
    $stmt_matricula = $base_de_datos->prepare($sql_matricula);
    $stmt_matricula->bindParam(':num_doc', $num_doc, PDO::PARAM_STR);
    $stmt_matricula->execute();
    $matricula = $stmt_matricula->fetch(PDO::FETCH_ASSOC);

    if ($matricula) {
        $id_matricula = $matricula['id_matricula'];

        $sql_asistencia = "SELECT * FROM asistencia
            INNER JOIN matricula ON asistencia.matricula_id_matricula = matricula.id_matricula 
            INNER JOIN registro ON asistencia.matricula_estudiante_registro_num_doc = registro.num_doc
            WHERE matricula_id_matricula = :id_matricula";
        
        $stmt_asistencia = $base_de_datos->prepare($sql_asistencia);
        $stmt_asistencia->bindParam(':id_matricula', $id_matricula, PDO::PARAM_INT);
        $stmt_asistencia->execute();
        $resultado = $stmt_asistencia->fetchAll(PDO::FETCH_ASSOC);

    } else {
        echo "No se encontró una matrícula asociada al usuario.";
    }
} else {
    echo "Número de documento no disponible en la sesión.";
}

    $sentencia = $base_de_datos->prepare("
       SELECT Asistencia.*, matricula.*, cursos.*, registro.*
           FROM Asistencia 
        INNER JOIN matricula ON asistencia.matricula_id_matricula = matricula.id_matricula
        INNER JOIN cursos ON asistencia.matricula_cursos_id_cursos = cursos.id_cursos
        INNER JOIN registro ON asistencia.matricula_estudiante_registro_num_doc  = registro.num_doc
    ");
    $sentencia->execute();
    $asistencias = $sentencia->fetchAll(PDO::FETCH_OBJ);
    
    $matriculas = $base_de_datos->query("SELECT * FROM matricula
    INNER JOIN registro ON matricula.estudiante_registro_num_doc = registro.num_doc
    INNER JOIN cursos ON matricula.cursos_id_cursos = cursos.id_cursos")->fetchAll(PDO::FETCH_ASSOC);

    $cursos = $base_de_datos->query("SELECT * FROM cursos")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>