<?php
namespace edufast\Models;

use PDO;

class Eventos {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerEvento() {
        try {
            $stmt = $this->conn->query("SELECT * FROM public_eventos");
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function actualizarEventos($id_evento) {
        try {
            $stmt = $this->conn->prepare("UPDATE public_eventos SET campo1 = :valor WHERE id_evento = :id_evento");
            $stmt->bindParam(':valor', $valor); // debes pasar este parámetro desde el controlador
            $stmt->bindParam(':id_evento', $id_evento);
            $stmt->execute();
            return ['success' => true];
        } catch (\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function eliminarEventos($id_evento) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM public_eventos WHERE id_evento = :id_evento");
            $stmt->bindParam(':id_evento', $id_evento);
            $stmt->execute();
            return ['success' => true];
        } catch (\PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
