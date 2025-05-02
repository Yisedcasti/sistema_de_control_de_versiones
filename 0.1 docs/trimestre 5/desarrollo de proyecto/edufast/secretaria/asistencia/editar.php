<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edufast";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_asistencia = $_GET['id_asistencia'];

$sql = "SELECT * FROM asistencia WHERE id_asistencia=$id_asistencia";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

} else {
    echo "No se encontró la asistencia.";
}

$conn->close();
?>
