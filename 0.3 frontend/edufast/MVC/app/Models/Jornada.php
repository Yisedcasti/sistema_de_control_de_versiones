<?php
namespace edufast\Models;
use PDO;
use PDOException;
use edufast\Config\Database;

class Jornada {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function obtenerJornada(){
        try{
            $sql = $this->conn->prepare("SELECT * FROM jornada WHERE id_jornada <> 1");
            $sql->execute();
            $jornadas = $sql->fetchAll(PDO::FETCH_OBJ); 
            return $jornadas;     
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    public function crearJornada($data){
        try{
            $sql = $this->conn->prepare("INSERT INTO jornada (jornada, hora_inicio, hora_final) 
                                        VALUES (:jornada, :hora_inicio, :hora_final)");
            $sql->bindParam(':jornada', $data['jornada']);
            $sql->bindParam(':hora_inicio', $data['hora_inicio']);
            $sql->bindParam(':hora_final', $data['hora_final']);
            $sql->execute();
            return true; 
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarJornada($data){
        try{
            $sql = $this->conn->prepare("UPDATE jornada 
                                        SET jornada = :jornada, hora_inicio = :hora_inicio, hora_final = :hora_final 
                                        WHERE id_jornada = :id_jornada");
            $sql->bindParam(':jornada', $data['jornada']);
            $sql->bindParam(':hora_inicio', $data['hora_inicio']);
            $sql->bindParam(':hora_final', $data['hora_final']);
            $sql->bindParam(':id_jornada', $data['id_jornada']);
            $sql->execute();
            return true; 
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarJornada($data){
        try{
            $sql = $this->conn->prepare("DELETE FROM jornada WHERE id_jornada = :id_jornada");
            $sql->bindParam(':id_jornada', $data['id_jornada']);
            $sql->execute();
            return true; 
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
