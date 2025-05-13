<?php
include_once "../modelo/Materia.php";

$materiaModel = new Materia();

$accion = $_POST["accion"] ?? null;

switch ($accion) {
    case "crear":
        $materia = $_POST["materia"];
        $area_id_area = $_POST["area_id_area"];
        $resultado = $materiaModel->crear($materia, $area_id_area);
        break;

    case "actualizar":
        $id = $_POST["id_materia"];
        $materia = $_POST["materia"];
        $area_id_area = $_POST["area_id_area"];
        $resultado = $materiaModel->actualizar($id, $materia, $area_id_area);
        break;

    case "eliminar":
        $id = $_POST["id_materia"];
        $resultado = $materiaModel->eliminar($id);
        break;

    default:
        header("Location: ../vistas/Materia.php?status=error");
        exit();
}

if ($resultado) {
    header("Location: ../vistas/Materia.php?status=success");
} else {
    header("Location: ../vistas/Materia.php?status=error");
}
exit();
?>
