<?php
require "PHP/Utils.php";
require "PHP/conection.php"
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php echo printHead("Inicio de Sesión"); ?>
</head>
<?php

session_start();
session_unset();
$bd = new BD_PDO();
if (isset($_POST['login'])) {

    $correo = $_POST['correo'];
    $pwd = $_POST['password'];

    $r = $bd->exec_instruction("SELECT * FROM usuarios WHERE Correo = '$correo' AND contrasena = '$pwd'");
    if (count($r) > 0) {

        $_SESSION[$Scorreo] = $correo;
        $_SESSION[$Sid] = $r[0]['PK_id'];
        $_SESSION[$Snombre] = $r[0]['nombre'] . " " . $r[0]['apellido'];
        $_SESSION[$StipoUsr] = $r[0]['tipo_Usuario'];
        header("location: index.php");

    }


} else if (isset($_POST['create'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $pwd = $_POST['c_password'];

    $bd->exec_instruction("INSERT INTO `usuarios`( `nombre`, `apellido`, `Correo`, `contrasena`) VALUES ('$nombre','$apellido','$correo','$pwd')");
    $ids = $bd->exec_instruction("SELECT PK_id FROM usuarios ORDER BY PK_id DESC");
    var_dump($ids);
    if (count($ids) > 0) {
        $id = $ids[0][0];
        $_SESSION[$Scorreo] = $correo;
        $_SESSION[$Sid] = $id;
        $_SESSION[$Snombre] = $nombre . " " . $apellido;
        $_SESSION[$StipoUsr] = "visitante";

        header("location: index.php");
    }


}





?>

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
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Service</a>
                    <a href="menu.php" class="nav-item nav-link">Menu</a>
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

    <!-- Tab Start -->
    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="position-relative d-inline-block w-100">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5 position-relative">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                        href="#tab-1">
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
    <!-- Tab End -->

    <div class="tab-content">
        <!-- Inicio Sesión -->
        <div id="tab-1" class="w-100 tab-pane fade show active">
            <div class="w-50 text-center">
                <form action="session.php" method="post">
                    <div class="form-group mb-3">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" name="correo" id="correo" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" id="login" name="login" class="btn btn-primary w-50">Iniciar Sesión</button>
                </form>
            </div>
        </div>
        <!-- Inicio Sesión End -->

        <!-- Crear Cuenta -->
        <div id="tab-2" class="tab-pane fade">
            <div class="w-50">
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
                        <input type="password" class="form-control" name="c_password" id="c_password" required>
                        <label for="password">Confirme contraseña:</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                            required>
                    </div>
                    <button type="submit" id="create" name="create" class="btn btn-primary w-50">Crear Cuenta</button>

                </form>
            </div>
        </div>
        <!-- Crear Cuenta End -->
    </div>

    <!-- Footer Start -->
    <?php echo getFooter(); ?>
    <!-- Footer End -->
    <script>
        // Selecciona los campos de entrada
        var passwordInput = document.getElementById('c_password');
        var confirmPasswordInput = document.getElementById('confirm_password');

        // Función para verificar que las contraseñas coincidan
        function validatePasswords() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Las contraseñas no coinciden.');

            } else {
                confirmPasswordInput.setCustomValidity('');  // Restaura el mensaje por defecto si es válido
            }
        }

        // Añade event listeners para el evento 'input' en ambos campos
        passwordInput.addEventListener('input', validatePasswords);
        confirmPasswordInput.addEventListener('input', validatePasswords);

        // Añade un event listener para el evento 'invalid' en el campo de confirmación de contraseña
        confirmPasswordInput.addEventListener('invalid', function (event) {
            // event.preventDefault();  // Previene el mensaje de error por defecto
            if (!event.target.validity.valid) {
                event.target.setCustomValidity('Las contraseñas no coinciden.');
            } else {
                event.target.setCustomValidity('');  // Restaura el mensaje por defecto si es válido
            }
        });


    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>