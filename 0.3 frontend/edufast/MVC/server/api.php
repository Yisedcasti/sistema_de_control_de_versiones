<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

use edufast\Controllers\AuthController;
use edufast\Controllers\JornadaController;
use edufast\Controllers\publicacionEventosController;
use edufast\Controllers\publicacionNoticiasController;


$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

// ✅ Corregido: se usa $_GET correctamente
$action = $_GET['action'] ?? ($data['action'] ?? null);

if (!$action) {
    http_response_code(400);
    echo json_encode(['message' => 'No se recibió la acción']);
    exit;
}

// Instancia de los controladores disponibles
$controllers = [
    'auth' => new AuthController(),
    'jornada' => new JornadaController(),
    'noticias' => new publicacionNoticiasController(),
    'evento' => new publicacionEventosController(),
];

// Rutas disponibles
$routes = [
    'POST' => [
        'registrarse' => ['auth', 'registrarse'],
        'login' => ['auth', 'login'],
        'agregarRol' => ['auth', 'agregarRol'],
        'crearJornada' => ['jornada', 'crearJornada'],
        'eliminarjornada' => ['jornada', 'eliminarJornada'],
        'actualizarJornada' => ['jornada', 'actualizarJornada']
    ],
    'GET' => [
        'obtenerJornada' => ['jornada', 'obtenerJornada'],
        'obtenerRol' => ['auth', 'obtenerRol'],
        'obtenerNoticias' => ['noticias', 'obtenerNoticias'],
        'obtenerEvento' => ['evento', 'obtenerEvento']
    ],
    'PATCH' => [
        'actualizarPerfil' => ['auth', 'actualizarPerfil'],
    ]
];

// ✅ Ejecutar la acción si existe
if (isset($routes[$method][$action])) {
    [$controllerKey, $methodToCall] = $routes[$method][$action];
    $controllers[$controllerKey]->$methodToCall($data);
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Acción no encontrada']);
}
