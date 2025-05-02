<?php
include "Conexion.php"; 
$id_grado = null;
$cursos = []; // Array para almacenar los resultados

try {
    // Verificar si el parámetro id_grado es válido antes de la consulta
    if (isset($_GET['id_grado']) && is_numeric($_GET['id_grado'])) {
        $id_grado = $_GET['id_grado'];
    } else {
        echo "Parámetro id_grado no válido o ausente.";
        exit();
    }

    // Preparar y ejecutar la consulta si id_grado es válido
    $sentencia = $base_de_datos->prepare(" 
        SELECT cursos.*, grado.*
        FROM cursos 
        INNER JOIN grado ON cursos.grado_id_grado = grado.id_grado
        WHERE cursos.grado_id_grado = :id_grado 
        ORDER BY cursos.curso ASC
    ");
    $sentencia->bindParam(':id_grado', $id_grado, PDO::PARAM_INT);
    $sentencia->execute();
    $cursos = $sentencia->fetchAll(PDO::FETCH_OBJ); // Almacenar todos los resultados en un array
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>