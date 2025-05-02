<?php
require_once "../confi/conexion.php";

class TareasDB{
    private $db;

    public function __construct(){ 
        $this->db = new conexion();
    }

    //METODO PARA VERIFICAR SI EXISTE UNA PIBLICAION POR ID
    public function verificarExistenciaById($id){
        $stmt = $this->db->mysqli->prepare("SELECT * FROM grado where id_grado=?");
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
        $result = $this->db->mysqli->query('SELECT * FROM grado');
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $tareas;
      }


    //METODO PARA REGISTRAR NOTICIAS //

    public function registrarDatos($nivel_educativo , $grado){
        try{
        $stmt = $this->db->mysqli->prepare("INSERT INTO grado(nivel_educativo, grado) VALUES (?,?)");
        if($stmt === false){
          throw new Exception('Error al preperar la consulta' .$this->db->mysqli->error);
        }
        $stmt->bind_param("ss",$nivel_educativo, $grado);
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

    public function actualizarNoticia($id_grado, $nivel_educativo, $grado)
    {
        if($this->verificarExistenciaById($id_grado))
        {
            $stmt= $this->db->mysqli->prepare("UPDATE grado SET nivel_educativo = ?, grado = ? WHERE id_grado = ? ");
            $stmt->bind_param("ssi",  $nivel_educativo, $grado , $id_grado);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }

    public function eliminarNoticia($id_grado)
    {
        if($this->verificarExistenciaById($id_grado))
        {
            $stmt= $this->db->mysqli->prepare("DELETE FROM grado WHERE id_grado = ? ");
            $stmt->bind_param('i', $id_grado);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }
}
?>