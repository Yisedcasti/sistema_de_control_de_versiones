<?php
namespace edufast\Models;
use PDO;
use PDOException;
use edufast\Config\Database;

class Noticias {
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function obtenerNoticias(){
        try {
            $sentencia = $this->conn->prepare("SELECT * FROM public_noticias as p
                                                INNER JOIN registro as r ON r.num_doc = p.registro_num_doc");
            $sentencia->execute();
            $publicacionesNoticias = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $publicacionesNoticias;  // Return the fetched data
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function actualizarNoticias($id_noticia){
        // Your implementation for updating news
    }
}
