<?php
require_once '../configuracion/conexion.php';
require_once '../modelos/Grado.php';

$gradoModel = new Grado($base_de_datos);

$accion = $_POST['accion'] ?? null;

switch ($accion) {
    case 'crear':
        $nivel_educativo = $_POST["nivel_educativo"] ?? null;
        $grados = $_POST["grado"] ?? [];

        if (empty($nivel_educativo) || empty($grados)) {
            header("Location: ../vistas/grados.php?error=Datos incompletos");
            exit();
        }

        if ($gradoModel->crear($nivel_educativo, $grados)) {
            header("Location: ../vistas/grados.php?status=success");
        } else {
            header("Location: ../vistas/grados.php?error=Error al insertar grados");
        }
        break;

    case 'actualizar':
        $id_grado = $_POST["id_grado"];
        $nivel_educativo = $_POST["nivel_educativo"];
        $grado = $_POST["grado"];

        if ($gradoModel->actualizar($id_grado, $nivel_educativo, $grado)) {
            header("Location: ../vistas/grados.php?status=success");
        } else {
            header("Location: ../vistas/grados.php?error=Error al actualizar");
        }
        break;

    case 'eliminar':
        $id_grado = $_POST["id_grado"];

        if ($gradoModel->eliminar($id_grado)) {
            header("Location: ../vistas/grados.php?status=success");
        } else {
            header("Location: ../vistas/grados.php?error=Error al eliminar");
        }
        break;

    default:
        header("Location: ../vistas/grados.php?error=Acción no válida");
        break;
}
?>
