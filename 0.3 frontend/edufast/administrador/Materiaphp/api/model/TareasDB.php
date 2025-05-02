<?php
require_once "../confi/conexion.php";

class TareasDB{
    private $db;

    public function __construct(){ 
        $this->db = new conexion();
    }

    //METODO PARA VERIFICAR SI EXISTE UNA PIBLICAION POR ID
    public function verificarExistenciaById($id){
        $stmt = $this->db->mysqli->prepare("SELECT * FROM materia where id_materia=?");
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
        $result = $this->db->mysqli->query('SELECT * FROM materia');
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $tareas;
      }


    //METODO PARA REGISTRAR NOTICIAS //

    public function registrarDatos($materia , $area_id_area){
        try{
        $stmt = $this->db->mysqli->prepare("INSERT INTO materia (materia, area_id_area) VALUES (?,?)");
        if($stmt === false){
          throw new Exception('Error al preperar la consulta' .$this->db->mysqli->error);
        }
        $stmt->bind_param("si",$materia, $area_id_area);
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

    public function actualizarNoticia($id_materia, $materia, $area_id_area)
    {
        if($this->verificarExistenciaById($id_materia))
        {
            $stmt= $this->db->mysqli->prepare("UPDATE materia SET materia = ?, area_id_area = ? WHERE id_materia = ? ");
            $stmt->bind_param("ssi",  $materia, $area_id_area, $id_materia);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }

    public function eliminarNoticia($id_materia)
    {
        if($this->verificarExistenciaById($id_materia))
        {
            $stmt= $this->db->mysqli->prepare("DELETE FROM materia WHERE id_materia = ? ");
            $stmt->bind_param('i', $id_materia);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }
}
?>