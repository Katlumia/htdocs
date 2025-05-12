<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sistema_inventario";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$conn = new mysqli('localhost', 'usuario', 'contraseña', 'sistema_inventario');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
