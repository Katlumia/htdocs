<?php
header('Content-Type: application/json');
$response = ['success' => false, 'message' => 'Error desconocido'];

try {
    require_once 'connection.php'; // debe definir $conn

    // Validar campos obligatorios
    $camposObligatorios = ['firstName', 'email', 'username', 'password', 'userRole'];
    foreach ($camposObligatorios as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            throw new Exception("El campo '$campo' es obligatorio.");
        }
    }

    $nombre     = $_POST['firstName'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $rol        = $_POST['userRole'];
    $activo     = isset($_POST['userStatus']) ? 1 : 0;
    $permisos   = json_decode($_POST['permisos'] ?? '[]');

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $rol_id = getRolId($rol, $conn);

    // Subida de foto (opcional)
    $fotoNombre = null;
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmp = $_FILES['profilePhoto']['tmp_name'];
        $fotoNombre = uniqid('foto_') . "_" . basename($_FILES['profilePhoto']['name']);
        $rutaDestino = "uploads/" . $fotoNombre;
        if (!move_uploaded_file($fotoTmp, $rutaDestino)) {
            throw new Exception("No se pudo guardar la foto de perfil.");
        }
    }

    // Insertar usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, nombre_usuario, password, rol_id, estado, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiis", $nombre, $email, $username, $hash, $rol_id, $activo, $fotoNombre);
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar usuario: " . $stmt->error);
    }

    $user_id = $conn->insert_id;

    // Insertar permisos
    if (is_array($permisos) && count($permisos) > 0) {
        $stmt_perm = $conn->prepare("INSERT INTO usuariopermisos (usuario_id, permiso_nombre) VALUES (?, ?)");
        foreach ($permisos as $permiso) {
            $stmt_perm->bind_param("is", $user_id, $permiso);
            if (!$stmt_perm->execute()) {
                throw new Exception("Error al asignar permisos: " . $stmt_perm->error);
            }
        }
    }

    $response['success'] = true;
    $response['message'] = "Usuario guardado correctamente.";
} catch (Exception $e) {
    $response['message'] = "Hubo un error al guardar el usuario: " . $e->getMessage();
}

echo json_encode($response);

if (isset($conn)) {
    $conn->close();
}

function getRolId($rolNombre, $conn) {
    $stmt = $conn->prepare("SELECT id FROM roles WHERE nombre = ?");
    $stmt->bind_param("s", $rolNombre);
    $stmt->execute();
    $stmt->bind_result($rolId);
    if ($stmt->fetch()) {
        return $rolId;
    } else {
        throw new Exception("Rol no encontrado: $rolNombre");
    }
}
?>



