<?php
try {
    include_once "configuracion/conexion.php";
    
    $fecha_nota = $_POST["fecha_nota"];
    $nota = $_POST["nota"];
    $registro_num_doc = $_POST["registro_num_doc"];
    $actividades_id_actividades = $_POST["actividades_id_actividades"];

    $consultaregristro = $base_de_datos->prepare("SELECT id_rol, id_jornada FROM registro WHERE num_doc = ?");
    $consultaregristro ->execute([$registro_num_doc]);
    $resultadoregistro =  $consultaregristro->fetch(PDO::FETCH_ASSOC);

    if (!$resultadoregistro) {
        exit("No se encontró información para este rigistro.");
    }

    // Guardamos el 'id_rol y id_jornada'
    $registro_rol_id_rol = $resultadoregistro['id_rol'];
    $registro_jornada_id_jornada =$resultadoregistro['id_jornada'];

    $consultaractividad = $base_de_datos->prepare("SELECT logro_Codigo_logro, logro_materia_id_materia FROM actividad WHERE id_actividad = ?");
    $consultaractividad ->execute([$actividades_id_actividades]);
    $resultadoactividad = $consultaractividad ->fetch(PDO::FETCH_ASSOC);

    if (!$resultadoactividad )  {
        exit("No se encontró información para esta actividad.");
    }

    // Guardamos el 'logro_Codigo_logro y logro_materia_id_materia'
    $actividades_logro_Codigo_logro = $resultadoactividad['logro_Codigo_logro'];
    $actividades_logro_materia_id_materias  = $resultadoactividad['logro_materia_id_materia'];



    $sentencia = $base_de_datos->prepare("INSERT INTO nota ( fecha_nota, nota, registro_num_doc,registro_rol_id_rol,registro_jornada_id_jornada,actividades_id_actividades,actividades_logro_Codigo_logro,actividades_logro_materia_id_materias) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    
    $resultado = $sentencia->execute([ $fecha_nota, $nota, $registro_num_doc,$registro_rol_id_rol,$registro_jornada_id_jornada,$actividades_id_actividades,$actividades_logro_Codigo_logro, $actividades_logro_materia_id_materias  ]);

    if ($resultado === TRUE) {
        echo "creado correctamente";
    } else {
        echo "Algo salió mal. Por favor, verifica que la tabla exista.";
    }
}
catch (PDOException $e) {
    // Capturar y mostrar cualquier error que ocurra
    echo "Error: " . $e->getMessage();
}
?>