<?php
require_once "../confi/conexion.php";

class TareasDB{
    private $db;

    public function __construct(){
        $this->db = new conexion();
    }

    //METODO PARA VERIFICAR SI EXISTE UNA PIBLICAION POR ID
    public function verificarExistenciaById($id){
        $stmt = $this->db->mysqli->prepare("SELECT * FROM public_noticias where id_noticia=?");
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
         $stmt->store_result();
         if($stmt->num_rows == 1){
            return true;
         }
        }
        return false;
    }

    
    public function obtenerListadoRegistros()
    {
        $result = $this->db->mysqli->query('SELECT * FROM public_noticias');
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $tareas;
      }


    //METODO PARA REGISTRAR NOTICIAS //

    public function registrarDatos($titulo, $info, $registro_num_doc){
        try{
        $stmt = $this->db->mysqli->prepare("INSERT INTO public_noticias(titulo , info , registro_num_doc) VALUES (?,?,?)");
        if($stmt === false){
          throw new Exception('Error al preperar la consulta' .$this->db->mysqli->error);
        }
        $stmt->bind_param("ssi",$titulo,$info, $registro_num_doc);
        $resultado = $stmt->execute();
        if($resultado === false){
          throw new Exception("Error al ejecutar la consulta" .$stmt->error);
        }
        $stmt->close();
        return $resultado;
        }
        catch(Exception $e){
        echo "Error al registrar datos " . $e->getMessage();
        }
      }

    //METODO PARA ACTUALIZAR  DATOS

    public function actualizarNoticia($id_noticia, $titulo, $info)
    {
        if($this->verificarExistenciaById($id_noticia))
        {
            $stmt= $this->db->mysqli->prepare("UPDATE public_noticias SET titulo = ?, info = ? WHERE id_noticia = ? ");
            $stmt->bind_param("ssi",  $titulo, $info , $id_noticia);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }

    public function eliminarNoticia($id_noticia)
    {
        if($this->verificarExistenciaById($id_noticia))
        {
            $stmt= $this->db->mysqli->prepare("DELETE FROM public_noticias WHERE id_noticia = ? ");
            $stmt->bind_param('i', $id_noticia);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }
}
?>