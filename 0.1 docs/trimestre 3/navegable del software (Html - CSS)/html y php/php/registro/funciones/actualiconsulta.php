<?php
if (!isset($_GET["id"])) {
    exit("¡ID no especificado!");
}

$id = $_GET["id"];
include_once "../configuracion/conexion.php";

try {
    // Consulta para obtener los datos del usuario
    $sentencia = $base_de_datos->prepare("
    SELECT registro.*, rol.*, jornada.*, asignacion.*, curso.*
    FROM registro
    INNER JOIN rol ON registro.id_rol = rol.id_rol
    INNER JOIN jornada ON registro.id_jornada = jornada.id_jornada
    LEFT JOIN asignacion ON registro.num_doc = asignacion.registro_num_doc
    LEFT JOIN curso ON asignacion.curso_id_curso = curso.id_curso
    WHERE registro.num_doc = ?
");
    $sentencia->execute([$id]);
    $persona = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($persona === FALSE) {
        exit("¡No existe ninguna persona con ese ID!");
    }

    // Obtener todas las opciones de roles
    $sentenciaRoles = $base_de_datos->query("SELECT * FROM rol");
    $roles = $sentenciaRoles->fetchAll(PDO::FETCH_OBJ);

    // Obtener todas las opciones de jornadas
    $sentenciaJornadas = $base_de_datos->query("SELECT * FROM jornada");
    $jornadas = $sentenciaJornadas->fetchAll(PDO::FETCH_OBJ);

    $sentenciagrados = $base_de_datos->query("SELECT * FROM grado");
    $grados =  $sentenciagrados->fetchAll(PDO::FETCH_OBJ);

    $sentenciacursos= $base_de_datos->query("SELECT * FROM curso");
    $cursos =  $sentenciacursos->fetchAll(PDO::FETCH_OBJ);
    

} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
