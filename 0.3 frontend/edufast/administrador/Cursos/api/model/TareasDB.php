<?php
require_once "../confi/conexion.php";

class TareasDB{
    private $db;

    public function __construct(){ 
        $this->db = new conexion();
    }

    //METODO PARA VERIFICAR SI EXISTE UNA PIBLICAION POR ID 
    public function verificarExistenciaById($id){
        $stmt = $this->db->mysqli->prepare("SELECT * FROM cursos where id_cursos=?");
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
        $result = $this->db->mysqli->query('SELECT * FROM cursos');
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $tareas;
      }


    //METODO PARA REGISTRAR NOTICIAS //

    public function registrarDatos($curso, $grado_id_grado){
        try{
        $stmt = $this->db->mysqli->prepare("INSERT INTO cursos (curso, grado_id_grado) VALUES (?,?)");
        if($stmt === false){
          throw new Exception('Error al preperar la consulta' .$this->db->mysqli->error);
        }
        $stmt->bind_param("si",$curso, $grado_id_grado);
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

    public function actualizarNoticia($id_cursos, $curso, $grado_id_grado)
    {
        if($this->verificarExistenciaById($id_cursos))
        {
            $stmt= $this->db->mysqli->prepare("UPDATE cursos SET curso = ?, grado_id_grado = ? WHERE id_cursos = ? ");
            $stmt->bind_param("ssi",  $curso, $grado_id_grado , $id_cursos);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }

    public function eliminarNoticia($id_cursos)
    {
        if($this->verificarExistenciaById($id_cursos))
        {
            $stmt= $this->db->mysqli->prepare("DELETE FROM cursos WHERE id_cursos = ? ");
            $stmt->bind_param('i', $id_cursos);
            $resultado = $stmt->execute();
            $stmt -> close();
            return $resultado;
        }
        return false;
    }
}
?>