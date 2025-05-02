<?php
try {
    include_once '../configuracion/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibir datos del formulario
        $num_doc = $_POST['num_doc'];
        $id_jornada = $_POST['id_jornada'];
        $id_grado = $_POST['id_grado'];
        $id_curso = $_POST['id_curso'];

        // Iniciar una transacción
        $base_de_datos->beginTransaction();

        // Actualizar la jornada en la tabla 'registro'
        $sentencia = $base_de_datos->prepare("UPDATE registro SET jornada_id_jornada = ? WHERE num_doc = ?");
        $result = $sentencia->execute([$id_jornada, $num_doc]);

        // Actualizar grado y curso en la tabla 'matricula'
        $sentencia2 = $base_de_datos->prepare("UPDATE matricula SET grado_id_grado = ?, cursos_id_cursos = ? WHERE estudiante_registro_num_doc = ?");
        $result2 = $sentencia2->execute([$id_grado, $id_curso, $num_doc]);

        // Verificar si ambas consultas se ejecutaron correctamente
        if ($result && $result2) {
            $base_de_datos->commit(); // Confirmar los cambios
            header("Location: ../vistas/observador.php?num_doc=$num_doc");
            exit();
        } else {
            $base_de_datos->rollBack(); // Revertir cambios en caso de error
            header("Location: ../vistas/alumnos.php?error=actualizacion_fallida");
            exit();
        }
    }
} catch (PDOException $e) {
    // Manejo de errores
    if ($base_de_datos->inTransaction()) {
        $base_de_datos->rollBack();
    }
    echo "Error en la base de datos: " . $e->getMessage();
}
?>
