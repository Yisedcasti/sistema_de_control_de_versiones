<?php
include_once "conexion.php";


try {
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