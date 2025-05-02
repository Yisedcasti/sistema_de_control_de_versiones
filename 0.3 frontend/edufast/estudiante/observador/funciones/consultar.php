<?php
include_once "../configuracion/conexion.php";

// Realiza la consulta a la base de datos
try {
    $num_doc = isset($_GET['user']) ? $_GET['user'] : $_SESSION["user"];

    $consulta = $base_de_datos->prepare("
    SELECT observacion.*, estudiante.*, observador.*, registro.*
    FROM observacion 
    INNER JOIN observador ON observacion.observador_id_observador = observador.id_observador
    INNER JOIN estudiante ON observacion.estudiante_id_estudiante = estudiante.id_estudiante
    INNER JOIN registro ON estudiante.registro_num_doc = registro.num_doc
    WHERE registro.num_doc = :num_doc
");

$consulta->bindParam(':num_doc', $num_doc, PDO::PARAM_STR);
$consulta->execute();
$compromisos = $consulta->fetchAll(PDO::FETCH_ASSOC);

$consulta = $base_de_datos->prepare("SELECT *
FROM observador
INNER JOIN registro ON observador.num_doc = registro.num_doc
WHERE registro.num_doc = :num_doc
");

$consulta->bindParam(':num_doc', $num_doc, PDO::PARAM_STR);
$consulta->execute();
$observadores = $consulta->fetchAll(PDO::FETCH_ASSOC);



    $grados = $base_de_datos->query("SELECT * FROM grado")->fetchAll(PDO::FETCH_ASSOC);
    $cursos = $base_de_datos->query("SELECT * FROM cursos")->fetchAll(PDO::FETCH_ASSOC);
    $jornadas = $base_de_datos->query("SELECT * FROM jornada")->fetchAll(PDO::FETCH_ASSOC);
    // Verificar que los grados se han obtenido correctamente

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
