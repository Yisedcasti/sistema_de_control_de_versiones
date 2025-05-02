<?php
namespace edufast\Controllers;

use edufast\Models\Noticias;
use Config\Database;

class publicacionNoticiasController {
    private $noticiasModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        
        $this->noticiasModel = new Noticias($this->db);
    }

    private function jsonResponse($status, $message, $data = []) {
        echo json_encode(array_merge(['status' => $status, 'message' => $message], $data));
    }

    public function obtenerNoticias() {
        $noticias = $this->noticiasModel->obtenerNoticias();
        $this->jsonResponse('success', 'Noticias retrieved successfully', ['noticias' => $noticias]);
    }
}
