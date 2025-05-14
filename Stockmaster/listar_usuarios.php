<?php
require 'connection.php'; // tu archivo de conexión a MySQL
header('Content-Type: application/json');


$sql = "SELECT u.id, u.nombre, u.email, u.estado, u.foto, r.nombre AS rol
        FROM usuarios u
        LEFT JOIN roles r ON u.rol_id = r.id";
$result = $conn->query($sql);

$usuarios = [];

while ($row = $result->fetch_assoc()) {
    $usuarios[] = [
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'email' => $row['email'],
        'rol' => $row['rol'],
        'estado' => $row['estado'] == 1 ? 'Activo' : 'Inactivo',
        'foto' => $row['foto'] ? 'data:image/jpeg;base64,' . base64_encode($row['foto']) : 'user-removebg.png'
    ];
}
if (!$result) {
    echo json_encode(['error' => $conn->error]);
    exit;
}

echo json_encode($usuarios);
?>
