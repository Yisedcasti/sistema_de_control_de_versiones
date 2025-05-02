<?php
namespace edufast\Controllers;
use edufast\Models\Jornada;
use Config\Database;

class JornadaController {
    private $jornadaModel;

    public function __construct(){
        $database = new Database();  
        $conn = $database->getConnection();  
        $this->jornadaModel = new Jornada($conn);  
    }

    public function jsonResponse($status, $message , $data = []){
        echo json_encode(array_merge(['status' => $status, 'message' => $message], $data));
    }

    // Obtener jornadas
    public function obtenerJornada() {
        $data = $this->jornadaModel->obtenerJornada();
    
        if (!is_array($data) || isset($data['error'])) {
            $this->jsonResponse('error', 'No se pudieron obtener las jornadas', [
                'error' => $data['error'] ?? 'Error desconocido'
            ]);
        } else {
            $this->jsonResponse('success', 'Jornadas obtenidas correctamente', [
                'data' => $data
            ]);
        }
    }
    
    // Crear jornada
    public function crearJornada($data){
        $requeridos = ['jornada', 'hora_inicio', 'hora_final']; // Arreglo corregido en 'hora_inicio'
        foreach ($requeridos as $campo){
            if(empty($data[$campo])){
                http_response_code(400);
                $this->jsonResponse('error' , "El campo '$campo' es obligatorio");
                return; // Para evitar continuar después de la respuesta
            }
        }
        $registro = $this->jornadaModel->crearJornada($data);
        if($registro){
            http_response_code(201);
            $this->jsonResponse('success', 'Jornada registrada correctamente');
        } else {
            http_response_code(500);
            $this->jsonResponse('error' , 'No se pudo registrar la jornada');
        }
    }

    // Actualizar jornada
    public function actualizarJornada($data){
        $requeridos = ['id_jornada', 'jornada', 'hora_inicio', 'hora_final'];
        foreach ($requeridos as $campo){
            if(empty($data[$campo])){
                http_response_code(400);
                $this->jsonResponse('error', "El campo '$campo' es obligatorio");
                return;
            }
        }

        $registro = $this->jornadaModel->actualizarJornada($data);
        if($registro){
            http_response_code(200);
            $this->jsonResponse('success', 'Jornada actualizada correctamente');
        } else {
            http_response_code(500);
            $this->jsonResponse('error', 'No se pudo actualizar la jornada');
        }
    }

    // Eliminar jornada
    public function eliminarJornada($data){
        if (empty($data['id_jornada'])) {
            http_response_code(400);
            $this->jsonResponse('error', "El campo 'id_jornada' es obligatorio");
            return;
        }

        $registro = $this->jornadaModel->eliminarJornada($data);
        if ($registro) {
            http_response_code(200);
            $this->jsonResponse('success', 'Jornada eliminada correctamente');
        } else {
            http_response_code(500);
            $this->jsonResponse('error', 'No se pudo eliminar la jornada');
        }
    }
}
?>
