<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_actividad = $_POST['nom_actividad'];
    $descrip_actividad = $_POST['descrip_actividad'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $codigo_logro = $_POST['codigo_logro'];

    try {
        $consultar = $base_de_datos->prepare("SELECT  
	    materia_id_materia,
	    materia_grado_id_grado, 
	    materia_area_id_area, 
	    materia_docente_id_docente, 
		materia_docente_cursos_id_cursos, 
		materia_docente_cursos_grado_id_grado, 
		materia_docente_registro_num_doc, 
		materia_docente_registro_rol_id_rol, 
		materia_docente_registro_jornada_id_jornada
        FROM logro WHERE id_logro = ?");
        $consultar->execute([$codigo_logro]);
        $resultado = $consultar->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            exit("No se encontró información para este logro.");
        }

        $materia_id_materia= $resultado['materia_id_materia'];
        $materia_grado_id_grado= $resultado['materia_grado_id_grado'];
        $materia_area_id_area= $resultado['materia_area_id_area'];
        $materia_docente_id_docente= $resultado['materia_docente_id_docente'];
        $materia_docente_cursos_id_cursos= $resultado['materia_docente_cursos_id_cursos'];
        $materia_docente_cursos_grado_id_grado= $resultado['materia_docente_cursos_grado_id_grado'];
        $materia_docente_registro_num_doc= $resultado['materia_docente_registro_num_doc'];
        $materia_docente_registro_rol_id_rol= $resultado['materia_docente_registro_rol_id_rol'];
        $materia_docente_registro_jornada_id_jornada= $resultado['materia_docente_registro_jornada_id_jornada'];

        $sql = "INSERT INTO actividad (
        nombre_act,
        descripcion, 
        fecha_entrega, 
        logro_id_logro,
        logro_materia_id_materia,
	    logro_materia_grado_id_grado, 
	    logro_materia_area_id_area, 
	    logro_materia_docente_id_docente, 
		logro_materia_docente_cursos_id_cursos, 
		logro_materia_docente_cursos_grado_id_grado, 
		logro_materia_docente_registro_num_doc, 
		logro_materia_docente_registro_rol_id_rol, 
		logro_materia_docente_registro_jornada_id_jornada) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $stmt = $base_de_datos->prepare($sql);

        // Ejecutamos la inserción
        $stmt->execute([
            $nom_actividad,
            $descrip_actividad,
            $fecha_entrega,
            $codigo_logro,
            $materia_id_materia,
            $materia_grado_id_grado,
            $materia_area_id_area,
            $materia_docente_id_docente,
            $materia_docente_cursos_id_cursos,
            $materia_docente_cursos_grado_id_grado,
            $materia_docente_registro_num_doc,
            $materia_docente_registro_rol_id_rol,
            $materia_docente_registro_jornada_id_jornada 
        ]);

        header("Location: actividad.php?status=success");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
