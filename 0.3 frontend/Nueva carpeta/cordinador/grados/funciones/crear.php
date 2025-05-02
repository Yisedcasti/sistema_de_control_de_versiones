<?php
try {
    include_once "../configuracion/conexion.php";

    // Validar los datos recibidos
    $nivel_educativo = isset($_POST["nivel_educativo"]) ? $_POST["nivel_educativo"] : null;
    $grados = isset($_POST['grado']) ? $_POST['grado'] : []; // Corregido el nombre de la clave

    if (empty($nivel_educativo)) {
        echo "El nivel educativo es obligatorio.";
        exit;
    }

    if (empty($grados)) {
        echo "Por favor selecciona al menos un grado.";
        exit;
    }

    // Iniciar transacción
    $base_de_datos->beginTransaction();

    
    // Preparar la sentencia SQL
    $sentencia = $base_de_datos->prepare("INSERT INTO grado (nivel_educativo, grado) VALUES (?, ?)");

    foreach ($grados as $grado) {
        // Ejecutar la consulta para cada grado
        $resultado = $sentencia->execute([$nivel_educativo, $grado]);

        if (!$resultado) {
            // Si algo falla, revertir la transacción
            $base_de_datos->rollBack();
            echo "Algo salió mal al insertar el grado $grado. La transacción ha sido cancelada.";
            exit;
        }
    }

    // Confirmar la transacción
    $base_de_datos->commit();

    header("Location: ../vistas/grados.php?status=success");
    exit();
} catch (PDOException $e) {
    // Revertir la transacción si ocurrió un error
    if ($base_de_datos->inTransaction()) {
        $base_de_datos->rollBack();
    }

    // Redirigir con el mensaje de error
    header("Location: ../vistas/grados.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>
