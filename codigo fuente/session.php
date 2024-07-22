<?php
require "PHP/ticketUtils.php";
require "PHP/Utils.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php echo printHead("Inicio de Sesión"); ?>
</head>

<body>

    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 pe-4">
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Service</a>
                    <a href="menu.html" class="nav-item nav-link">Menu</a>
                </div>
            </div>
        </nav>

        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Inicio de Sesión</h1>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Categorías Start -->
    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="position-relative d-inline-block w-100">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5 position-relative">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <i class="fa fa-coffee fa-2x text-primary"></i>
                        <div class="ps-3">
                            <h6 class="mt-n1 mb-0">Iniciar Sesión</h6>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                        <i class="fa fa-hamburger fa-2x text-primary"></i>
                        <div class="ps-3">
                            <h6 class="mt-n1 mb-0">Crear Cuenta</h6>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Categorías End -->

    <div class="tab-content">
        <!-- Inicio Sesión -->
        <div id="tab-1" class="tab-pane fade show active">
            <div class="row g-4">
                <form action="session.php" method="post">
                    <div class="form-group mb-3">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" name="correo" id="correo" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-50">Iniciar Sesión</button>
                </form>
            </div>
        </div>
        <!-- Inicio Sesión End -->

        <!-- Crear Cuenta -->
        <div id="tab-2" class="tab-pane fade">
            <div class="row g-4">
                <form action="session.php" method="post">
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" name="correo" id="correo" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-50">Crear Cuenta</button>
                </form>
            </div>
        </div>
        <!-- Crear Cuenta End -->
    </div>

    <!-- Footer Start -->
    <?php echo getFooter(); ?>
    <!-- Footer End -->

</body>

</html>
