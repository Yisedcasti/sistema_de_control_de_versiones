<?php
require_once '../modelos/Curso.php';
require_once '../configuracion/Conexion.php';

$cursoModel = new Curso($base_de_datos);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'crear':
            $curso = $_POST['curso'];
            $grado_id_grado = $_POST['grado_id_grado'];
            if ($cursoModel->crear($curso, $grado_id_grado)) {
                header("Location: ../vistas/Curso.php?id_grado=$grado_id_grado&status=success");
            }
            break;

        case 'actualizar':
            $curso = $_POST['curso'];
            $grado_id_grado = $_POST['grado_id_grado'];
            $id = $_POST['id_cursos'];
            if ($cursoModel->actualizar($id, $curso, $grado_id_grado)) {
                header("Location: ../vistas/Curso.php?id_grado=$grado_id_grado&status=success");
            }
            break;

        case 'eliminar':
            $id = $_POST['id_cursos'];
            $grado_id_grado = $_POST['grado_id_grado'];
            if ($cursoModel->eliminar($id)) {
                header("Location: ../vistas/Curso.php?id_grado=$grado_id_grado&status=success");
            }
            break;

        default:
            echo "Acción no reconocida.";
    }
}
