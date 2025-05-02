<?php
require_once "../model/TareasDB.php";

class TareasAPI
 {
    public function API()
     {
        header('CONTENT-TYPE: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method){
            case 'GET':
                $this->ProcesarListarNoticias();
                break;

                case 'POST':
                    $this->ProcesarCrearNoticia();
                    break;

                    case 'PUT':
                        $this->ProcesarActualizarNoticia();
                        break;

                        case 'DELETE':
                            $this->ProcesarEliminarNoticia();
                            break;

                            default;
                            echo 'METODO NO SOPORTADO';
                            break;
        }
     }
//METODO RESPONSE // 

function response($code = 200, $status = "", $message = ""){
    http_response_code($code);
    if(!empty($status) && !empty($message)){
        $response = array(
            "status" => $status,
            "message" => $message
        );
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
    }
    
    //METODO PARA PROCESAR EL LISTADO DE DATOS
    function ProcesarListarNoticias()
    {
    $tareasDB =  new TareasDB();
        if (isset($_GET['id_grado'])){
            $response = $tareasDB->verificarExistenciaById($_GET['id_grado']);
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else{
            $response = $tareasDB->obtenerListadoRegistros();
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
    
    //Metodo para guardar los datos
    function ProcesarCrearNoticia()
    {
        try{
            $obj = json_decode(file_get_contents('php://input'));
            $objArr = (array) $obj;
            if(empty($objArr)){
                $this->response(422, "error","Nada que guardar, comprobar json");
            }
            else if(isset($obj->grado)){
                print "el dato es $obj->grado";
                $tareasDB = new TareasDB();
                $tareasDB->registrarDatos($obj->nivel_educativo,$obj->grado);
                $this->response(200,"sucess","Registro Guardado Correctamente");
            }
            else{
                $this->response(422,"error","La prioridad no esta definida");
            }
        }
        catch(\Throwable $th)
        {
        print "error" .$th->getMessage();
        }
    }
    
    // Metodo para aCTUALIZAR Los datos
    
    function ProcesarActualizarNoticia(){
        $obj = json_decode(file_get_contents('php://input'));
        
        if (isset($_GET['action']) && isset($_GET['id'])) {
            if ($_GET['action'] == 'update') {
                $objArr = (array) $obj;
                if (empty($objArr)) {
                    $this->response(422, "error", "Nada que guardar, comprobar JSON");
                }
                else if (isset($obj->grado)) {
                    // Crear una instancia de TareasDB y llamar a la función actualizar
                    $tareasDB = new TareasDB();
                    $tareasDB->actualizarNoticia(
                        $_GET['id'],
                        $obj->nivel_educativo,
                        $obj->grado
                    );
                    // Responder con éxito si la actualización fue exitosa
                    $this->response(200, "success", "Registro Actualizado Correctamente");
                } else {
                    // Error si falta el campo 'tareas_titulo'
                    $this->response(422, "error", "El título de la tarea no está definido");
                }
                exit();
            }
        }
        // Responder con un error 400 si no se cumple ninguna condición
        $this->response(400, "error", "Solicitud incorrecta");
    }
    
    // PROCESO ELIMINAR DATOS 
    function ProcesarEliminarNoticia()
    {
        if (isset($_GET['action']) && isset($_GET['id'])) {
            if ($_GET['action'] == 'delete') {
                $id_grado = intval($_GET['id']);
                $tareasDB = new TareasDB();
                
                if ($tareasDB->verificarExistenciaById($id_grado)) {
                    $respuesta = $tareasDB->eliminarNoticia($id_grado);
                    if ($respuesta) {
                        $this->response(200, "success", "Registro Eliminado Correctamente");
                        return $respuesta;
                    } else {
                        $this->response(500, "error", "Error al eliminar la noticia");
                        return false;
                    }
                } else {
                    $this->response(400, "error", "ID no existe");
                    return false;
                }
            } else {
                $this->response(400, "error", "Acción no válida");
                return false;
            }
        } else {
            $this->response(400, "error", "La propiedad no está definida");
            return false;
        }
    }
    
     
 }
?>