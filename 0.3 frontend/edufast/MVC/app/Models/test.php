<?php
// Función para simular el proceso
function verificarContrasena($password_ingresada, $hash_guardado) {
    if (password_verify($password_ingresada, $hash_guardado)) {
        echo "La contraseña es correcta.\n";
    } else {
        echo "La contraseña es incorrecta.\n";
    }
}

// Contraseña en texto claro (la que el usuario ingresa)
$password_ingresada = "123456";

// Hash de la contraseña (hash almacenado en la base de datos)
$hash_guardado = '$2y$12$xqMy.urnPFC0BPU8uO8HI.lT761BMKnSrhJV6o8UIWRZE/sGobUPi';  // Usando comillas simples

// Llamada a la función para verificar la contraseña
verificarContrasena($password_ingresada, $hash_guardado);
?>
