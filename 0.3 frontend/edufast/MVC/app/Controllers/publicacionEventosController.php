<?php
namespace edufast\Controllers;

use edufast\Models\Eventos;
use Config\Database;

class publicacionEventosController {
    private $eventosModel;

    public function __construct() {
        $database = new Database();
        $conexion = $database->getConnection();
        $this->eventosModel = new Eventos($conexion);
    }

    private function jsonResponse($status, $message, $data = []) {
        echo json_encode(array_merge(['status' => $status, 'message' => $message], $data));
    }

    public function obtenerEvento() {
        $data = $this->eventosModel->obtenerEvento();
        if (isset($data['error'])) {
            $this->jsonResponse('error', 'No se pudieron obtener los eventos', ['error' => $data['error']]);
        } else {
            $this->jsonResponse('success', 'Eventos obtenidos correctamente', ['data' => $data]);
        }
    }

}
