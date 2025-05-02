<?php
require_once "conexion.php";
try {
    $num_doc = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    if ($num_doc !== null) {
        $sql_matricula = "SELECT grado_id_grado FROM matricula WHERE estudiante_registro_num_doc = :num_doc";
        $stmt_matricula = $base_de_datos->prepare($sql_matricula);
        $stmt_matricula->bindParam(':num_doc', $num_doc, PDO::PARAM_INT);
        $stmt_matricula->execute();
        $matricula = $stmt_matricula->fetch(PDO::FETCH_ASSOC);

        if ($matricula && isset($matricula['grado_id_grado'])) {
            $grado_id_grado = $matricula['grado_id_grado'];

            $sql_logro = "SELECT logro.*, materia.*, grado.*  
                FROM logro
                INNER JOIN materia ON materia.id_materia = logro.materia_id_materia
                INNER JOIN grado ON grado.id_grado = logro.grado_id_grado
                WHERE logro.grado_id_grado = :grado_id_grado";
            
            $stmt_logro = $base_de_datos->prepare($sql_logro);
            $stmt_logro->bindParam(':grado_id_grado', $grado_id_grado, PDO::PARAM_INT);
            $stmt_logro->execute();
            $logros = $stmt_logro->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($logros)) {
                echo "No se encontraron logros para este grado.";
            }
        } else {
            echo "No se encontró un grado asociado al usuario.";
        }
    } else {
        echo "Número de documento no disponible en la sesión.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>