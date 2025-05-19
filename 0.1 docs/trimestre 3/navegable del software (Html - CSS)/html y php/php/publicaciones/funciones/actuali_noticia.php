<?php
try{
    include_once "../configuracion/conexion.php";

    $id_noticia = $_POST['id_noticia'];
    $titulo = $_POST['titulo'];
    $info = $_POST['info'];

    $sentencia = $base_de_datos->prepare("UPDATE public_noticias SET titulo = ?, info = ? Where id_noticia = ?");
    $resultado = $sentencia->execute([$titulo,$info,$id_noticia]);
    if ($resultado) {
       header("Location: ../vistas/actualizar_noticia.php?status=success");
                    exit();
    }
    else {
        header("Location: ../vistas/actualizar_noticia.php?status=error");
   exit();
    }
}
catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}


?>