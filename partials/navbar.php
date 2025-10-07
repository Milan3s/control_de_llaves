<?php
$currentPage = basename($_SERVER["PHP_SELF"]);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <!-- Logo / Título -->
        <a class="navbar-brand" href="../views/dashboard.php">
            <i class="fas fa-key"></i> Control de Llaves
        </a>

        <!-- Botón hamburguesa para móvil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Si NO estamos en el dashboard, mostrar menú -->
            <?php if ($currentPage !== "dashboard.php"): ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="../views/dashboard.php">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>

                    <!-- Todos los usuarios ven dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tablasDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-database"></i> Listado
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="tablasDropdown">
                            <li><a class="dropdown-item" href="../views/usuarios.php"><i class="fas fa-users"></i> Usuarios</a></li>
                            <li><a class="dropdown-item" href="../views/roles.php"><i class="fas fa-user-shield"></i> Roles</a></li>
                            <li><a class="dropdown-item" href="../views/empresas.php"><i class="fas fa-building"></i> Empresas</a></li>
                            <li><a class="dropdown-item" href="../views/empleados.php"><i class="fas fa-id-card"></i> Empleados</a></li>
                            <li><a class="dropdown-item" href="../views/llaves.php"><i class="fas fa-key"></i> Llaves</a></li>
                        </ul>
                    </li>

                </ul>
            <?php endif; ?>

            <!-- Usuario logueado -->
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION["nombre_usuario"])): ?>
                    <li class="nav-item d-flex align-items-center text-white fw-bold me-3">
                        <i class="fas fa-user"></i> &nbsp; <?php echo htmlspecialchars($_SESSION["nombre_usuario"]); ?>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="../views/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="../views/login.php">
                            <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
