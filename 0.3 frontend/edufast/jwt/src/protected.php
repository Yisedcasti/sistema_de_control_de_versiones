<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\key;

$config = require '../config/clave.php';
$SECRET_KEY = $config['SECRET_KEY'];

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

if(!$authHeader || !preg_match('/Bearner\s(\s+)/', $authHeader, $matches))
{
    echo json_encode(['error' => 'Token no proporcionado']);
    exit;
}
$jwt = $matches[1];

try{
    $decode = JWT::decode($jwt, new Key($SECRET_KEY, 'HS256'));
    echo json_encode(["message " => "Accesos concedido", "user" => $decode]);

}
catch(Exception $e){
    echo json_encode(['error' => 'Token invalido']);
}
?>
