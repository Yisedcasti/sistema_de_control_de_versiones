<?php
try {
    // Incluir la conexión a la base de datos
    include_once "../configuracion/conexion.php";
    
    $jornada = $_POST["jornada"];
    $hora_inicio = $_POST["hora_inicio"];
    $hora_final = $_POST["hora_final"];

    // Preparar la sentencia SQL
    $sentencia = $base_de_datos->prepare("INSERT INTO jornada ( jornada, hora_inicio, hora_final) 
        VALUES (?, ?, ?);");
    
    // Ejecutar la sentencia con los datos proporcionados
    $resultado = $sentencia->execute([ $jornada, $hora_inicio, $hora_final]);

    if ($resultado === TRUE) {
        header("Location: ../vistas/jornadas.php?status=success");
        exit();
    } else {
        header("Location: ../vistas/jornadas.php?status=error");
        exit();
    }
}
catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error: " . $e->getMessage();
}
?>
