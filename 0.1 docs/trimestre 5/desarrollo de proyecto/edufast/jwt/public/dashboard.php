<?php
session_start();

if(!isset($_SESSION["token"])){
    header('location: index.php');
    exit;
}

echo "<h2>Bienvenido</h2>";
echo "<a href='logout.php'>Cerrar sesion</a>";
?>