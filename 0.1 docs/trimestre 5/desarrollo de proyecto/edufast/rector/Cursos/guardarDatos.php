<?php
try {
    # Incluye la conexión a la base de datos
    include_once "conexion.php";

    # Recoge los datos del formulario
    $curso = $_POST["curso"];
    $grado_id_grado = $_POST["grado_id_grado"];
    $id_cursos = $_POST["id_cursos"];
    # Prepara la sentencia SQL
    $sentencia = $base_de_datos->prepare("UPDATE cursos SET curso = ?, grado_id_grado= ?  WHERE id_cursos = ?;");
    # Ejecuta la sentencia pasando los valores correspondientes
    $resultado = $sentencia->execute([$curso, $grado_id_grado, $id_cursos]);

    # Verifica el resultado
    if($resultado === TRUE) {
        header("Location: curso.php?id_grado=$grado_id_grado&status=success");
        exit();
    } 
} catch (PDOException $e) {
    # Captura cualquier error de la base de datos
    error_log("Error de actualización: " . $e->getMessage()); // Registro en el log
    echo '<script>
        alert("Hubo un error al intentar actualizar la curso.");
        window.history.back(); 
    </script>';
}
?>
