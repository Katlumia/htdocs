<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sistema_inventario";

// Intentar conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar error
if ($conn->connect_error) {
    // Lanza excepción en vez de usar die()
    throw new Exception("Conexión fallida: " . $conn->connect_error);
}
?>
