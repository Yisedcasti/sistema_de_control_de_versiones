<?php
// 1. Validar que vengan todos los datos necesarios
if (
    !isset($_POST['id_docente']) ||
    !isset($_POST['cursos_id_cursos']) ||
    !isset($_POST['materia_id_materia']) ||
    !isset($_POST['jornada_id_jornada'])
) {
    exit("Faltan datos");
}

require_once '../configuracion/conexion.php';  // define $base_de_datos (PDO)

$id_docente         = $_POST['id_docente'];
$cursos_id_cursos   = $_POST['cursos_id_cursos'];
$materia_id_materia = $_POST['materia_id_materia'];
$jornada_id_jornada = $_POST['jornada_id_jornada'];

try {
    // 2. Traer datos del docente para la FK compuesta
    $stmtDoc = $base_de_datos->prepare("
        SELECT registro_num_doc,
               registro_rol_id_rol,
               registro_jornada_id_jornada
        FROM docente
        WHERE id_docente = ?
    ");
    $stmtDoc->execute([$id_docente]);
    $doc = $stmtDoc->fetch(PDO::FETCH_ASSOC);
    if (!$doc) {
        exit("Docente no encontrado");
    }

    // 3. Obtener grado_id_grado del curso para la FK compuesta
    $stmtCur = $base_de_datos->prepare("
        SELECT grado_id_grado
        FROM cursos
        WHERE id_cursos = ?
    ");
    $stmtCur->execute([$cursos_id_cursos]);
    $cur = $stmtCur->fetch(PDO::FETCH_ASSOC);
    if (!$cur) {
        exit("Curso no encontrado");
    }
    $grado_id_grado = $cur['grado_id_grado'];

    // 4. Insertar en docente_has_cursos con todas las columnas de la FK compuesta
    $stmtInsCur = $base_de_datos->prepare("
        INSERT INTO docente_has_cursos (
            docente_id_docente,
            docente_registro_num_doc,
            docente_registro_rol_id_rol,
            docente_registro_jornada_id_jornada,
            cursos_id_cursos,
            cursos_grado_id_grado
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmtInsCur->execute([
        $id_docente,
        $doc['registro_num_doc'],
        $doc['registro_rol_id_rol'],
        $doc['registro_jornada_id_jornada'],
        $cursos_id_cursos,
        $grado_id_grado
    ]);

    // 5. Insertar en docente_has_materia (solo id_docente y materia_id)
    $stmtInsMat = $base_de_datos->prepare("
        INSERT INTO docente_has_materia (
            docente_id_docente,
            materia_id_materia
        ) VALUES (?, ?)
    ");
    $stmtInsMat->execute([
        $id_docente,
        $materia_id_materia
    ]);

    // 6. Actualizar la jornada en la tabla registro
    $stmtUpd = $base_de_datos->prepare("
        UPDATE registro
        SET jornada_id_jornada = ?
        WHERE num_doc = ?
    ");
    $stmtUpd->execute([
        $jornada_id_jornada,
        $doc['registro_num_doc']
    ]);

    // 7. Si todo sale bien, redirigir a la vista de profesores
    header('Location:../vistas/profesores.php');
    exit;

} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}
