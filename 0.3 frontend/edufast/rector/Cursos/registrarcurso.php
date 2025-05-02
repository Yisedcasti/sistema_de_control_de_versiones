<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso= $_POST['curso'];
    $grado_id_grado = $_POST['grado_id_grado'];

    try {

        // Preparamos la sentencia SQL para insertar en la tabla 'curso'
        $sql = "INSERT INTO  cursos (curso, grado_id_grado) 
                VALUES (:curso, :grado_id_grado)";
        
        $stmt = $base_de_datos->prepare($sql);

        // Ejecutamos la inserción
        $stmt->execute([
            ':curso' => $curso,
            ':grado_id_grado' => $grado_id_grado
        ]);

        header("Location: curso.php?id_grado=$grado_id_grado&status=success");
    exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
