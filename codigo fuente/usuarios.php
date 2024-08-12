<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sushi-to</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icono.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/original.css" rel="stylesheet">

</head>

<body>
    <?php
    require "PHP/SessionUtils.php";
    require 'PHP/conection.php';
    require 'PHP/Utils.php';
    session_start();

    if (!isset($_SESSION[$Sid])) {
        redirectLogin("usarios.php");
    }
    $id = $_SESSION[$Sid];
    $bd = new BD_PDO();

    if (isset($_POST['create'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['Correo'];
        $pwd = $_POST['c_password'];
        $acceso = $_POST['acceso'];

        $bd->exec_instruction("INSERT INTO `usuarios`(`nombre`, `apellido`, `Correo`, `contrasena`, `tipo_Usuario`) VALUES ('$nombre','$apellido','$correo','$pwd', '$acceso')");

      } 

    if (isset($_GET['eliminar'])) {
      
        $bd->exec_instruction("UPDATE `usuarios` SET `estado`='inactivo' WHERE PK_id= " . $_GET['eliminar'] . "");
        alert('usuario eliminado');
    }

    if (isset($_GET['txtbuscarque'])) {
        $textobuscar = $_GET['txtbuscarque'];   
    }
    $result = $bd->exec_instruction("SELECT PK_id, nombre, apellido, Correo, tipo_Usuario FROM usuarios WHERE estado = 'activa' ORDER BY PK_id DESC");
    ?>

    <div class="container-xxl bg-white p-0">

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Sushi-to</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <div class="nav-item nav-link">
                            <a href="Registro.php" class="btn btn-primary">Back</a>
                        </div>
                        <div class="nav-item nav-link">
                            <a href="session.php" class="btn btn-primary">
                                <?php echo (isset($_SESSION[$Snombre]) ? $_SESSION[$Snombre] : "Iniciar sesión") ?>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Gestión de Usuarios</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Agregar Usuario & Administrador Start -->
        <div class="w-50 mx-auto">
            <form action="usuarios.php" method="post">
                <div class="form-group mb-3">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
                <div class="form-group mb-3">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                </div>
                <div class="form-group mb-3">
                    <select id="acceso" name="acceso" class="form-control">
                        <option value="admin">Administrador</option>
                        <option value="visitante">Usuario</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="Correo">Correo Electrónico:</label>
                    <input type="email" class="form-control" name="Correo" id="Correo" required>
                </div>
                <div class="form-group mb-3">
                    <label for="c_password">Contraseña:</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirme contraseña:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit" name="create" class="btn btn-primary">Registrar</button>
            </form>
        </div>
        <!-- Agregar Usuario & Administrador End -->
        <br>
        <!-- Tabla Usuarios Start -->
        <?php if (count($result) > 0) { ?>
            <!-- Buscar Usuarios Start -->
            <div>
                <form class="d-flex justify-content-center" action="usuarios.php" method="get">
                    <input type="text" id="txtbuscarque" name="txtbuscarque" placeholder="Buscar"
                        value="<?php echo isset($textobuscar) ? htmlspecialchars($textobuscar) : ''; ?>"
                        class="form-control me-3 mb-0 w-50">
                    <input class="btn btn-primary" type="submit" id="btnbuscar" name="btnbuscar" value="Buscar">
                </form>
            </div>
            <!-- Buscar Usuarios End -->
            <div class="container my-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Tipo Usuario</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($textobuscar)) {
                                $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%" . $textobuscar . "%' ";
                                $result = $bd->exec_instruction($sql);
                            }
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tipo_Usuario']); ?></td>
                                    <td>
                                        <a href="usuarios.php?eliminar=<?php echo htmlspecialchars($row['PK_id']); ?>"
                                            class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
        <!-- Tabla Usuarios End -->
    </div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Compañía
                    </h4>
                    <a class="btn btn-link" href="#">Nosotros</a>
                    <a class="btn btn-link" href="#">Contáctanos</a>
                    <a class="btn btn-link" href="#">Reservaciones</a>
                    <a class="btn btn-link" href="#">Política de Privacidad</a>
                    <a class="btn btn-link" href="#">Términos y Condiciones</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contacto
                    </h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Av. 16 de Septiembre, Piedras
                        Negras, MX</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+52 878 123 9277</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Horario
                    </h4>
                    <h5 class="text-light fw-normal">Lunes - Sábado</h5>
                    <p>09AM - 09PM</p>
                    <h5 class="text-light fw-normal">Domingo</h5>
                    <p>10AM - 08PM</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">
                        Promociones</h4>
                    <p>Para cupones, descuentos, ofertas y más. ¡REGÍSTRATE!</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Correo Electrónico">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">REGÍSTRATE</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Diseño por nosotros</a>, Todos los Derechos
                        Reservados.
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML
                            Codex</a><br><br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com"
                            target="_blank">ThemeWagon</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="#">Inicio</a>
                            <a href="registro.php">Registro</a>
                            <a href="#">Cookies</a>
                            <a href="#">Ayuda</a>
                            <a href="#">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <script>
        // Selecciona los campos de entrada
        var passwordInput = document.getElementById('c_password'); // Se elimina el espacio en blanco
        var confirmPasswordInput = document.getElementById('confirm_password');

        // Función para verificar que las contraseñas coincidan
        function validatePasswords() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Las contraseñas no coinciden.');
            } else {
                confirmPasswordInput.setCustomValidity(''); // Restaura el mensaje por defecto si es válido
            }
        }

        // Añade event listeners para el evento 'input' en ambos campos
        passwordInput.addEventListener('input', validatePasswords);
        confirmPasswordInput.addEventListener('input', validatePasswords);

        // Opcional: Añade un event listener para el evento 'invalid' en el campo de confirmación de contraseña
        confirmPasswordInput.addEventListener('invalid', function (event) {
            if (!event.target.validity.valid) {
                event.target.setCustomValidity('Las contraseñas no coinciden.');
            } else {
                event.target.setCustomValidity(''); // Restaura el mensaje por defecto si es válido
            }
        });
    </script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>