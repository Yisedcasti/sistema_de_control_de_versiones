<?php
namespace edufast\Models;

use PDO;
use PDOException;
use edufast\Config\Database;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Usuario {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function registrarse($data){
        try {
            $this->conn->beginTransaction();
    
            // Extraer datos desde $data
            $id_rol = $data['id_rol'];
            $tipo_doc = $data['tipo_doc'];
            $num_doc = $data['num_doc'];
            $nombre = $data['nombres'];
            $apellido = $data['apellidos'];
            $celular = $data['celular'];
            $telefono = $data['telefono'];
            $direccion = $data['direccion'];
            $correo = $data['correo'];
            $hashed_password = password_hash($data['pass'], PASSWORD_BCRYPT);
            $jornada_id_jornada = 1;
    
            
            $sql = $this->conn->prepare("
                INSERT INTO registro (
                    rol_id_rol, tipo_doc, num_doc, nombres, apellidos, celular,
                    telefono, direccion, correo, pass, jornada_id_jornada
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
    
            $stmt = $sql->execute([
                $id_rol, $tipo_doc, $num_doc, $nombre, $apellido,
                $celular, $telefono, $direccion, $correo, $hashed_password, $jornada_id_jornada
            ]);
    
            if ($stmt) {
                $this->conn->commit();
                return json_encode(['message' => 'Usuario registrado correctamente']);
            } else {
                // Ver si la ejecución falla
                return json_encode(['message' => 'Error al ejecutar el INSERT']);
            }
    
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return json_encode(['message' => 'Error al registrar: ' . $e->getMessage()]);
        }
    }
    public function inicioSesion($data){
        $stmt = $this->conn->prepare("SELECT * FROM registro WHERE num_doc = ?");
        $stmt->execute([$data['num_doc']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($usuario && password_verify($data['pass'], $usuario['pass'])) {
            $payload = [
                "num_doc" => $usuario['num_doc'],
                "rol" => $usuario['rol_id_rol'],
                "nombres" => $usuario['nombres'],
                "apellidos" => $usuario['apellidos'],
                "exp" => time() + 3600
            ];
            
            $jwt = JWT::encode($payload, Clave::SECRET_KEY, 'HS256');
            session_start();
            $_SESSION['jwt'] = $jwt;
            $_SESSION['user'] = $usuario['num_doc'];
            $_SESSION['rol'] = $usuario['rol_id_rol'];
            $_SESSION['nombres'] = $usuario['nombres'];
            $_SESSION['apellidos'] = $usuario['apellidos'];
            
            return $usuario;
        } else {
            return false;
        }
    }
}
?>
