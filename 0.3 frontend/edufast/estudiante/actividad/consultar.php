<?php
include_once "conexion.php";
try {
    $num_doc = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    if ($num_doc !== null) {
        // Obtener el grado del estudiante
        $sql_matricula = "SELECT grado_id_grado FROM matricula WHERE estudiante_registro_num_doc = :num_doc";
        $stmt_matricula = $base_de_datos->prepare($sql_matricula);
        $stmt_matricula->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
        $stmt_matricula->execute();
        $matricula = $stmt_matricula->fetch(PDO::FETCH_ASSOC);

        if ($matricula && isset($matricula['grado_id_grado'])) {
            $grado_id_grado = $matricula['grado_id_grado'];

            // Consulta de actividades filtrada por el grado del estudiante
            $sentencia = $base_de_datos->prepare("
                SELECT actividad.*, logro.*, materia.*
                FROM actividad
                INNER JOIN logro ON actividad.logro_id_logro = logro.id_logro
                INNER JOIN materia ON actividad.logro_materia_id_materia = materia.id_materia
                WHERE logro.grado_id_grado = :grado_id_grado
            ");
            $sentencia->bindParam(':grado_id_grado', $grado_id_grado, PDO::PARAM_INT);
            $sentencia->execute();
            $actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);

            if (empty($actividades)) {
                echo "No se encontraron actividades para este grado.";
            }
        } else {
            echo "No se encontró un grado asociado al usuario.";
        }
    } else {
        echo "Número de documento no disponible en la sesión.";
    }



    $logros = $base_de_datos->query("SELECT * FROM logro ")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
