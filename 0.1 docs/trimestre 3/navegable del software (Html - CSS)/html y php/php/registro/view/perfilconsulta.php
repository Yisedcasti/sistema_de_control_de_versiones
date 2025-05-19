<?php
if (!isset($_GET["id"])) {
    exit("¡ID no especificado!");
}

$id = $_GET["id"];
include_once "../configuracion/conexion.php";

try {
    // Consulta para obtener los datos del usuario
    $sentencia = $base_de_datos->prepare("
    SELECT registro.*, rol.*, jornada.*, asignacion.*, grado.*, curso.*
    FROM registro
    INNER JOIN rol ON registro.id_rol = rol.id_rol
    INNER JOIN jornada ON registro.id_jornada = jornada.id_jornada
    LEFT JOIN asignacion ON registro.num_doc = asignacion.registro_num_doc
    LEFT JOIN grado ON asignacion.grado_id_grado = grado.id_grado
    LEFT JOIN curso ON asignacion.curso_id_curso = curso.id_curso
    WHERE registro.num_doc = ?
");
    $sentencia->execute([$id]);
    $persona = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($persona === FALSE) {
        exit("¡No existe ninguna persona con ese ID!");
    }
    

} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
