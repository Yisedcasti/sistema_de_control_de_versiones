<?php
include_once "conexion.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');
    $asistencias = $_POST['asistencia'];

    try {
        $base_de_datos->beginTransaction();

        foreach ($asistencias as $id_matricula => $estado_asistencia) {
            $consultar = $base_de_datos->prepare("SELECT
                grado_id_grado,
                cursos_id_cursos,
                estudiante_id_estudiante,
                estudiante_registro_num_doc,
                estudiante_registro_rol_id_rol,
                estudiante_registro_jornada_id_jornada
            FROM matricula 
            WHERE id_matricula = ?");
            $consultar->execute([$id_matricula]);
            $resultado = $consultar->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $sql = "INSERT INTO asistencia (
                    fecha_asistencia,
                    asistencia, 
                    matricula_id_matricula,
                    matricula_grado_id_grado,
                    matricula_cursos_id_cursos,
                    matricula_estudiante_id_estudiante,
                    matricula_estudiante_registro_num_doc,
                    matricula_estudiante_registro_rol_id_rol,
                    matricula_estudiante_registro_jornada_id_jornada
                ) VALUES (?,?,?,?,?,?,?,?,?)";

                $stmt = $base_de_datos->prepare($sql);
                $stmt->execute([
                    $fecha,
                    $estado_asistencia,
                    $id_matricula,
                    $resultado['grado_id_grado'],
                    $resultado['cursos_id_cursos'],
                    $resultado['estudiante_id_estudiante'],
                    $resultado['estudiante_registro_num_doc'],
                    $resultado['estudiante_registro_rol_id_rol'],
                    $resultado['estudiante_registro_jornada_id_jornada']
                ]);
            }
        }

        $base_de_datos->commit();
        header("Location:listados.php?status=success");
            exit();
    } catch (PDOException $e) {
        $base_de_datos->rollBack();
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
