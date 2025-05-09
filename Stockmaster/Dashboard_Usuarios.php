<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuarios - Stockmaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="stockmaster_solo_blanco_cortado.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .inventory-section {
            margin-top: 80px;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-search {
            margin-left: 20px;
        }
        /* New CSS for keeping nav links horizontal after collapse */
        @media (max-width: 991.98px) {
            .navbar-collapse .navbar-nav {
                flex-direction: row;
            }
            .navbar-collapse .nav-item {
                margin-right: 10px;
            }
            .navbar-collapse .navbar-search {
                margin-left: auto;
            }
        }
        .user-image {
            margin-left: 20px;
        }
        .role-badge {
            font-size: 0.8rem;
        }
        .user-card {
            transition: transform 0.2s;
            cursor: pointer;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .action-icon {
            cursor: pointer;
            margin: 0 5px;
        }
        .status-active {
            color: #28a745;
        }
        .status-inactive {
            color: #dc3545;
        }
        .status-pending {
            color: #ffc107;
        }
        .modal-header {
            background-color: #343a40;
            color: white;
        }
        .user-profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .tab-content {
            padding: 20px 0;
        }
        .permission-group {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 15px;
            margin-bottom: 15px;
        }
        .permission-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .filter-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="stockmaster_solo_blanco_cortado.png" alt="Logo Stockmaster">
            Stockmaster
        </a>
        <!-- User Image on the right -->
        <div class="d-flex align-items-center order-lg-2">
            <img src="user-removebg.png" height="40" width="40" class="rounded-circle me-2 user-image">
            <!-- Toggler button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Screen_productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Movimiento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Dashboard_Usuarios.php">Usuarios</a>
                </li>
            </ul>
            
            <!-- Search bar -->
            <form class="d-flex navbar-search" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
            
        </div>
    </div>
</nav>
<!-- Navbar -->

<!-- Main Section -->
<div class="container inventory-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Panel de Usuarios</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-plus-circle me-2"></i>Añadir Usuario
        </button>
    </div>

    <!-- Filters and Stats -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card filter-card">
                <div class="card-body">
                    <h5 class="card-title">Filtros</h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <select class="form-select" id="roleFilter">
                                <option value="">Todos los roles</option>
                                <option value="admin">Administrador</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="operador">Operador</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">Todos los estados</option>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Buscar usuario..." id="userSearch">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary w-100" id="clearFilters">
                                <i class="fas fa-times me-1"></i>Limpiar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row g-2">
                <div class="col-6">
                    <div class="card text-white bg-primary">
                        <div class="card-body p-3">
                            <h5 class="card-title">Total</h5>
                            <p class="card-text h3">18</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-white bg-success">
                        <div class="card-body p-3">
                            <h5 class="card-title">Activos</h5>
                            <p class="card-text h3">15</p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card text-white bg-danger">
                        <div class="card-body p-3">
                            <h5 class="card-title">Inactivos</h5>
                            <p class="card-text h3">1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="true">
                        <i class="fas fa-th me-2"></i>Cuadrícula
                    </button>
                    <button class="nav-link" id="nav-table-tab" data-bs-toggle="tab" data-bs-target="#nav-table" type="button" role="tab" aria-controls="nav-table" aria-selected="false">
                        <i class="fas fa-list me-2"></i>Tabla
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- Grid View -->
                <div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                    <div class="row g-3">
                        <!-- User Card 1 -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card user-card h-100">
                                <div class="card-body text-center">
                                    <img src="user-removebg.png" class="rounded-circle mb-3" width="100" height="100">
                                    <h5 class="card-title mb-1">María González</h5>
                                    <p class="card-text text-muted">maria.gonzalez@stockmaster.com</p>
                                    <span class="badge bg-primary role-badge mb-2">Administrador</span>
                                    <p class="mb-0"><i class="fas fa-circle status-active me-1"></i> Activo</p>
                                </div>
                                <div class="card-footer bg-transparent d-flex justify-content-center">
                                    <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                    <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                    <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                </div>
                            </div>
                        </div>
                        <!-- User Card 2 -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card user-card h-100">
                                <div class="card-body text-center">
                                    <img src="user-removebg.png" class="rounded-circle mb-3" width="100" height="100">
                                    <h5 class="card-title mb-1">Juan Pérez</h5>
                                    <p class="card-text text-muted">juan.perez@stockmaster.com</p>
                                    <span class="badge bg-info role-badge mb-2">Supervisor</span>
                                    <p class="mb-0"><i class="fas fa-circle status-active me-1"></i> Activo</p>
                                </div>
                                <div class="card-footer bg-transparent d-flex justify-content-center">
                                    <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                    <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                    <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                </div>
                            </div>
                        </div>
                        <!-- User Card 3 -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card user-card h-100">
                                <div class="card-body text-center">
                                    <img src="user-removebg.png" class="rounded-circle mb-3" width="100" height="100">
                                    <h5 class="card-title mb-1">Ana López</h5>
                                    <p class="card-text text-muted">ana.lopez@stockmaster.com</p>
                                    <span class="badge bg-secondary role-badge mb-2">Operador</span>
                                    <p class="mb-0"><i class="fas fa-circle status-active me-1"></i> Activo</p>
                                </div>
                                <div class="card-footer bg-transparent d-flex justify-content-center">
                                    <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                    <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                    <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                </div>
                            </div>
                        </div>
                        <!-- User Card 4 -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card user-card h-100">
                                <div class="card-body text-center">
                                    <img src="user-removebg.png" class="rounded-circle mb-3" width="100" height="100">
                                    <h5 class="card-title mb-1">Carlos Ramírez</h5>
                                    <p class="card-text text-muted">carlos.ramirez@stockmaster.com</p>
                                    <span class="badge bg-secondary role-badge mb-2">Operador</span>
                                    <p class="mb-0"><i class="fas fa-circle status-inactive me-1"></i> Inactivo</p>
                                </div>
                                <div class="card-footer bg-transparent d-flex justify-content-center">
                                    <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                    <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                    <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                </div>
                            </div>
                        </div>
                        <!-- More user cards here -->
                    </div>
                </div>
                <!-- Table View -->
                <div class="tab-pane fade" id="nav-table" role="tabpanel" aria-labelledby="nav-table-tab">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Último acceso</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="user-removebg.png" class="rounded-circle me-2" width="40" height="40">
                                            <div>María González</div>
                                        </div>
                                    </td>
                                    <td>maria.gonzalez@stockmaster.com</td>
                                    <td><span class="badge bg-primary">Administrador</span></td>
                                    <td><i class="fas fa-circle status-active me-1"></i> Activo</td>
                                    <td>Hoy 10:34</td>
                                    <td>
                                        <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                        <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                        <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="user-removebg.png" class="rounded-circle me-2" width="40" height="40">
                                            <div>Juan Pérez</div>
                                        </div>
                                    </td>
                                    <td>juan.perez@stockmaster.com</td>
                                    <td><span class="badge bg-info">Supervisor</span></td>
                                    <td><i class="fas fa-circle status-active me-1"></i> Activo</td>
                                    <td>Ayer 15:22</td>
                                    <td>
                                        <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                        <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                        <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="user-removebg.png" class="rounded-circle me-2" width="40" height="40">
                                            <div>Ana López</div>
                                        </div>
                                    </td>
                                    <td>ana.lopez@stockmaster.com</td>
                                    <td><span class="badge bg-secondary">Operador</span></td>
                                    <td><i class="fas fa-circle status-active me-1"></i> Activo</td>
                                    <td>Nunca</td>
                                    <td>
                                        <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                        <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                        <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="user-removebg.png" class="rounded-circle me-2" width="40" height="40">
                                            <div>Carlos Ramírez</div>
                                        </div>
                                    </td>
                                    <td>carlos.ramirez@stockmaster.com</td>
                                    <td><span class="badge bg-secondary">Operador</span></td>
                                    <td><i class="fas fa-circle status-inactive me-1"></i> Inactivo</td>
                                    <td>28 Abr 2023</td>
                                    <td>
                                        <i class="fas fa-edit text-primary action-icon" data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
                                        <i class="fas fa-key text-warning action-icon" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"></i>
                                        <i class="fas fa-trash-alt text-danger action-icon" data-bs-toggle="modal" data-bs-target="#deleteUserModal"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Añadir Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUserForm" method="POST" enctype="multipart/form-data">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="firstName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6">
              <label for="phoneNumber" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="username" class="form-label">Nombre Usuario</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="col-md-6">
              <label for="userRole" class="form-label">Rol</label>
              <select class="form-select" id="userRole" name="userRole" required>
                <option value="" selected disabled>Seleccionar rol</option>
                <option value="admin">Administrador</option>
                <option value="supervisor">Supervisor</option>
                <option value="operador">Operador</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="profilePhoto" class="form-label">Foto de Perfil</label>
              <input class="form-control" type="file" id="profilePhoto" name="profilePhoto" accept="image/*">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="password" class="form-label">Contraseña</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
            <div class="col-md-6">
              <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
              <div class="input-group">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
          </div>

          <h5 class="mt-4 mb-3">Permisos</h5>

          <!-- Inventario -->
          <div class="permission-group">
            <div class="permission-title">Inventario</div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="ver_productos" id="viewProducts">
                  <label class="form-check-label" for="viewProducts">Ver productos</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="crear_productos" id="createProducts">
                  <label class="form-check-label" for="createProducts">Crear productos</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="editar_productos" id="editProducts">
                  <label class="form-check-label" for="editProducts">Editar productos</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar_productos" id="deleteProducts">
                  <label class="form-check-label" for="deleteProducts">Eliminar productos</label>
                </div>
              </div>
            </div>
          </div>

          <!-- Reportes -->
          <div class="permission-group">
            <div class="permission-title">Reportes</div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="ver_reportes" id="viewReports">
                  <label class="form-check-label" for="viewReports">Ver reportes</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="exportar_reportes" id="exportReports">
                  <label class="form-check-label" for="exportReports">Exportar reportes</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="acceso_analitica" id="analyticsAccess">
                  <label class="form-check-label" for="analyticsAccess">Acceso a analítica</label>
                </div>
              </div>
            </div>
          </div>

          <!-- Gestión de Usuarios -->
          <div class="permission-group">
            <div class="permission-title">Gestión de Usuarios</div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="ver_usuarios" id="viewUsers">
                  <label class="form-check-label" for="viewUsers">Ver usuarios</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="crear_usuarios" id="createUsers">
                  <label class="form-check-label" for="createUsers">Crear usuarios</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="editar_usuarios" id="editUsers">
                  <label class="form-check-label" for="editUsers">Editar usuarios</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar_usuarios" id="deleteUsers">
                  <label class="form-check-label" for="deleteUsers">Eliminar usuarios</label>
                </div>
              </div>
            </div>
          </div>

          <!-- Configuración del Sistema -->
          <div class="permission-group">
            <div class="permission-title">Configuración del Sistema</div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="ver_configuracion" id="viewSettings">
                  <label class="form-check-label" for="viewSettings">Ver configuración</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="editar_configuracion" id="editSettings">
                  <label class="form-check-label" for="editSettings">Editar configuración</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="permisos[]" value="backup_sistema" id="systemBackup">
                  <label class="form-check-label" for="systemBackup">Realizar copias de seguridad</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-check form-switch mt-4">
            <input class="form-check-input" type="checkbox" id="userStatus" name="userStatus" checked>
            <label class="form-check-label" for="userStatus">Usuario activo</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="addUserForm" class="btn btn-primary">Guardar Usuario</button>
      </div>
    </div>
  </div>
</div>


<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Restablecer Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Está a punto de restablecer la contraseña de <strong>María González</strong>.</p>
                <form>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nueva Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirmar Nueva Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmNewPassword" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmNewPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="forcePasswordChange">
                        <label class="form-check-label" for="forcePasswordChange">
                            Obligar a cambiar la contraseña en el próximo inicio de sesión
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning">Restablecer Contraseña</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">Eliminar Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                </div>
                <p class="text-center">¿Está seguro de que desea eliminar al usuario <strong>María González</strong>?</p>
                <p class="text-center text-danger">Esta acción no se puede deshacer.</p>
                
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="confirmDelete" required>
                    <label class="form-check-label" for="confirmDelete">
                        Entiendo que esta acción es permanente
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" disabled id="deleteUserBtn">Eliminar Usuario</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword')?.addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    document.getElementById('toggleConfirmPassword')?.addEventListener('click', function() {
        const confirmPasswordInput = document.getElementById('confirmPassword');
        confirmPasswordInput.type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    document.getElementById('toggleNewPassword')?.addEventListener('click', function() {
        const newPasswordInput = document.getElementById('newPassword');
        newPasswordInput.type = newPasswordInput.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    document.getElementById('toggleConfirmNewPassword')?.addEventListener('click', function() {
        const confirmNewPasswordInput = document.getElementById('confirmNewPassword');
        confirmNewPasswordInput.type = confirmNewPasswordInput.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    // Enable delete button only when checkbox is checked
    document.getElementById('confirmDelete')?.addEventListener('change', function() {
        document.getElementById('deleteUserBtn').disabled = !this.checked;
    });
    
    // Handle role selection to auto-select permissions
    document.getElementById('userRole')?.addEventListener('change', function() {
        const role = this.value;
        
        // Clear all permissions first
        document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Set permissions based on role
        if (role === 'admin') {
            // Give all permissions to admin
            document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = true;
            });
        } else if (role === 'supervisor') {
            // Give view and edit permissions, but not delete or system config
            document.querySelectorAll('.form-check-input[id$="View"]').forEach(checkbox => {
                checkbox.checked = true;
            });
            document.querySelectorAll('.form-check-input[id$="Edit"]').forEach(checkbox => {
                checkbox.checked = true;
            });
            document.getElementById('viewReports').checked = true;
            document.getElementById('exportReports').checked = true;
            document.getElementById('viewProducts').checked = true;
            document.getElementById('editProducts').checked = true;
            document.getElementById('createProducts').checked = true;
        } else if (role === 'operador') {
            // Give only basic view permissions
            document.getElementById('viewProducts').checked = true;
            document.getElementById('viewReports').checked = true;
        }
    });
    
    // Filter functionality
    document.getElementById('clearFilters')?.addEventListener('click', function() {
        document.getElementById('roleFilter').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('userSearch').value = '';
        // Reset the filtering (in a real app, would trigger refetching data)
    });
</script>
<script>
document.querySelector('.btn.btn-primary').addEventListener('click', function () {
    const form = document.getElementById('addUserForm');
    const formData = new FormData(form);

    // Captura permisos seleccionados
    const permisos = [];
    form.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
        permisos.push(checkbox.id); // ID del checkbox debe coincidir con el nombre en la tabla Permisos
    });
    formData.append('permisos', JSON.stringify(permisos));

    fetch('procesar_usuario.php', {
        method: 'POST',
        body: formData
    }).then(res => res.json())
      .then(data => {
          alert(data.message);
      });
});
</script>

</body>
</html>