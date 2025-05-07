<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Panel de Categorías - Stockmaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="stockmaster_solo_blanco_cortado.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 2rem;
        }
        .category-section {
            margin-top: 80px;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-search {
            margin-left: 20px;
        }
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
        .actions-column {
            min-width: 140px;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #343a40;
            color: white;
            font-weight: bold;
        }
        .filters-card {
            margin-bottom: 1.5rem;
        }
        .table-container {
            overflow-x: auto;
        }
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .category-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
        }
        .pagination {
            justify-content: center;
            margin-top: 1rem;
        }
        .modal-header {
            background-color: #343a40;
            color: white;
        }
        .modal-footer {
            justify-content: space-between;
        }
        .stats-cards {
            margin-bottom: 1.5rem;
        }
        .stats-card {
            transition: transform 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .color-preview {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-block;
            margin-left: 10px;
            border: 1px solid #ced4da;
        }
        .category-status {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .status-active {
            background-color: #28a745;
        }
        .status-inactive {
            background-color: #dc3545;
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
                    <a class="nav-link" href="dashboard.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Screen_productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Usuarios</a>
                </li>
            </ul>

            <!-- Search bar -->
            <form class="d-flex navbar-search" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar categoría..." aria-label="Buscar">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Section -->
<div class="container category-section">
    <div class="page-title">
        <h2>Gestión de Categorías</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Nueva Categoría
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row stats-cards">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Categorías</h6>
                            <h3 class="mb-0">12</h3>
                        </div>
                        <div>
                            <i class="fas fa-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Categorías Activas</h6>
                            <h3 class="mb-0">10</h3>
                        </div>
                        <div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Categorías Inactivas</h6>
                            <h3 class="mb-0">2</h3>
                        </div>
                        <div>
                            <i class="fas fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Productos Categorizados</h6>
                            <h3 class="mb-0">135</h3>
                        </div>
                        <div>
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card filters-card">
        <div class="card-header">
            <i class="fas fa-filter"></i> Filtros
        </div>
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-4">
                    <label for="filterStatus" class="form-label">Estado</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">Todos los estados</option>
                        <option value="active">Activas</option>
                        <option value="inactive">Inactivas</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filterProducts" class="form-label">Productos</label>
                    <select class="form-select" id="filterProducts">
                        <option value="">Todos</option>
                        <option value="with">Con productos</option>
                        <option value="without">Sin productos</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Aplicar filtros</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Table Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-tags"></i> Categorías Registradas</span>
            <div class="btn-group">
                <button class="btn btn-sm btn-outline-light" title="Exportar a Excel">
                    <i class="fas fa-file-excel"></i>
                </button>
                <button class="btn btn-sm btn-outline-light" title="Exportar a PDF">
                    <i class="fas fa-file-pdf"></i>
                </button>
                <button class="btn btn-sm btn-outline-light" title="Imprimir">
                    <i class="fas fa-print"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Color</th>
                            <th>Estado</th>
                            <th>Productos</th>
                            <th>Fecha Creación</th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Electrónicos</td>
                            <td>Productos electrónicos y tecnológicos</td>
                            <td><span class="category-color" style="background-color: #4287f5;"></span></td>
                            <td><span class="category-status status-active"></span> Activa</td>
                            <td>23</td>
                            <td>15/02/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles" data-bs-toggle="modal" data-bs-target="#viewCategoryModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Accesorios</td>
                            <td>Accesorios variados para dispositivos</td>
                            <td><span class="category-color" style="background-color: #6c757d;"></span></td>
                            <td><span class="category-status status-active"></span> Activa</td>
                            <td>15</td>
                            <td>15/02/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Herramientas</td>
                            <td>Herramientas manuales y eléctricas</td>
                            <td><span class="category-color" style="background-color: #ffc107;"></span></td>
                            <td><span class="category-status status-active"></span> Activa</td>
                            <td>32</td>
                            <td>22/02/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Muebles</td>
                            <td>Muebles para oficina y hogar</td>
                            <td><span class="category-color" style="background-color: #28a745;"></span></td>
                            <td><span class="category-status status-active"></span> Activa</td>
                            <td>18</td>
                            <td>01/03/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Limpieza</td>
                            <td>Productos de limpieza y mantenimiento</td>
                            <td><span class="category-color" style="background-color: #20c997;"></span></td>
                            <td><span class="category-status status-active"></span> Activa</td>
                            <td>12</td>
                            <td>10/03/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Decoración</td>
                            <td>Artículos decorativos</td>
                            <td><span class="category-color" style="background-color: #e83e8c;"></span></td>
                            <td><span class="category-status status-inactive"></span> Inactiva</td>
                            <td>0</td>
                            <td>15/03/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Cocina</td>
                            <td>Utensilios y electrodomésticos de cocina</td>
                            <td><span class="category-color" style="background-color: #fd7e14;"></span></td>
                            <td><span class="category-status status-active"></span> Activa</td>
                            <td>8</td>
                            <td>20/03/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Navegación de páginas">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel"><i class="fas fa-plus-circle"></i> Agregar Nueva Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Nombre de Categoría</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Nombre de la categoría" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="categoryDescription" rows="3" placeholder="Descripción detallada de la categoría"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoryColor" class="form-label">Color</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="categoryColor" value="#4287f5" title="Elige un color para la categoría">
                            <span id="colorPreview" class="color-preview" style="background-color: #4287f5;"></span>
                        </div>
                        <small class="form-text text-muted">Este color se usará para identificar visualmente la categoría.</small>
                    </div>
                    <div class="mb-3">
                        <label for="categoryStatus" class="form-label">Estado</label>
                        <select class="form-select" id="categoryStatus" required>
                            <option value="active" selected>Activa</option>
                            <option value="inactive">Inactiva</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Categoría</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel"><i class="fas fa-edit"></i> Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Nombre de Categoría</label>
                        <input type="text" class="form-control" id="editCategoryName" value="Electrónicos" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editCategoryDescription" rows="3">Productos electrónicos y tecnológicos</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryColor" class="form-label">Color</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="editCategoryColor" value="#4287f5" title="Elige un color para la categoría">
                            <span id="editColorPreview" class="color-preview" style="background-color: #4287f5;"></span>
                        </div>
                        <small class="form-text text-muted">Este color se usará para identificar visualmente la categoría.</small>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryStatus" class="form-label">Estado</label>
                        <select class="form-select" id="editCategoryStatus" required>
                            <option value="active" selected>Activa</option>
                            <option value="inactive">Inactiva</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- View Category Modal -->
<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel"><i class="fas fa-info-circle"></i> Detalles de Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            <span class="category-color" style="background-color: #4287f5;"></span>
                            Electrónicos
                            <span class="badge bg-success ms-2">Activa</span>
                        </h4>
                        <p class="text-muted">ID: 1 | Creada: 15/02/2025</p>
                        <hr>
                        <p><strong>Descripción:</strong> Productos electrónicos y tecnológicos</p>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Total Productos</h5>
                                <p class="card-text fs-3 fw-bold">23</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Valor de Inventario</h5>
                                <p class="card-text fs-3 fw-bold">$15,250.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Productos con Stock Bajo</h5>
                                <p class="card-text fs-3 fw-bold">3</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h5 class="mt-4">Productos en esta Categoría</h5>
                <div class="table-container">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Precio Venta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PROD001</td>
                                <td>Laptop HP Pavilion</td>
                                <td>15 unidades</td>
                                <td>$699.99</td>
                                <td>
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>PROD003</td>
                                <td>Monitor Samsung 24"</td>
                                <td>8 unidades</td>
                                <td>$199.99</td>
                                <td>
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>PROD010</td>
                                <td>Auriculares Bluetooth Sony</td>
                                <td>5 unidades</td>
                                <td>$129.99</td>
                                <td>
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>PROD015</td>
                                <td>Smartwatch Samsung Galaxy</td>
                                <td>3 unidades</td>
                                <td>$249.99</td>
                                <td>
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>PROD018</td>
                                <td>Cámara Digital Canon</td>
                                <td>2 unidades</td>
                                <td>$399.99</td>
                                <td>
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <span class="text-muted">Mostrando 5 de 23 productos</span>
                    </div>
                    <nav aria-label="Navegación de productos">
                        <ul class="pagination pagination-sm">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar Categoría
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-print"></i> Imprimir Reporte
                </button>
            </div>
        </div>
    </div>
</div>