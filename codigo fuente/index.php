<?php
require 'PHP/SessionUtils.php';
require 'PHP/conection.php';
$bd = new BD_PDO();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sushi-to </title>
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
    function ImprimirProductoTabla($img, $nombre, $descripcion, $id, $precio): string
    {
        return '
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 img-fluid rounded" src="' . htmlspecialchars($img) . '" alt="" style="width: 80px;">
                    <div class="w-100 d-flex flex-column text-start ps-4">
                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                            <span>' . htmlspecialchars($nombre) . '</span>
                            <span class="text-primary">$' . htmlspecialchars($precio) . '</span>
                        </h5>
                        <small class="fst-italic">' . htmlspecialchars($descripcion) . '</small>
                    </div>
                </div>
            </div>';
    }
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
                <div class="collapse navbar-collapse " id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 ">

                        <a href="index.php" class="nav-item nav-link active ">Inicio</a>

                        <a href="registro.php" class="nav-item nav-link">Servicios</a>

                        <a href="menu.php" class="nav-item nav-link">Menú</a>

                        <a href="contact.php" class="nav-item nav-link">Comentarios</a>

                        <div class="nav-item nav-link">
                            <a href="session.php"
                                class="btn btn-primary"><?php echo (isset($_SESSION[$Snombre]) ? $_SESSION[$Snombre] : "Iniciar sesión") ?></a>
                        </div>
                    </div>
            </nav>

            <div class="container-xxl py-5 bg-dark mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Ven <br>y Difruta!</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">
                                "Sumérgete en la esencia de nuestra comida, donde la tradición y su sabor se unen para
                                una experiencia inolvidable."</p>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="img/sushi.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                                <h5>Maestros Sushi Chefs</h5>
                                <p>La verdadera magia ocurre detrás de la barra de sushi, combinada con años de
                                    experiencia,
                                    habilidad y pasión para crear.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                                <h5>Compromiso con la Calidad</h5>
                                <p>Nuestro compromiso con la calidad no es solo una promesa, sino una práctica diaria
                                    que se refleja en cada plato que servimos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                                <h5>Ordena en Línea</h5>
                                <p>¡Disfruta de la auténtica experiencia de sushi de Sushi To desde la comodidad de tu
                                    hogar!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                                <h5>Servicio 24/7</h5>
                                <p>Entendemos que los antojos no tienen horario, y por eso estamos aquí para ti las 24
                                    horas del día, los 7 días de la semana. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
                                    src="img/Sake roll.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"
                                    src="img/Tuna tower.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s"
                                    src="img/Brownie.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                                    src="img/Mexico roll.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Sobre Nosotros</h5>
                        <h1 class="mb-4">Bienvenidos a <i class="fa fa-utensils text-primary me-2"></i>Sushi-to!</h1>
                        <p class="mb-4">En el corazón de la ciudad, donde la tradición se encuentra con la modernidad,
                            nació Sushi To con un sueño simple pero ambicioso:
                            ofrecer una experiencia auténtica de sushi que capture la esencia de Japón en cada bocado.
                        </p>
                        <p class="mb-4">Nos comprometemos a utilizar solo los ingredientes más frescos y de la más alta
                            calidad. Nuestro pescado es seleccionado a mano cada mañana en el mercado local, y nuestros
                            chefs,
                            formados en la tradición del sushi, preparan cada pieza con la precisión y el cuidado que
                            caracteriza a la verdadera gastronomía.</p>
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                    <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">15
                                    </h1>
                                    <div class="ps-4">
                                        <p class="mb-0">Años de</p>
                                        <h6 class="text-uppercase mb-0">Experencia</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                    <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">5
                                    </h1>
                                    <div class="ps-4">
                                        <p class="mb-0"></p>
                                        <h6 class="text-uppercase mb-0">Sucursales</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Categorias Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Menú</h5>
                    <h1 class="mb-5">Nuestros Platillos</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative d-inline-block w-100">
                        <ul
                            class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5 position-relative">
                            <li class="nav-item">
                                <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active"
                                    data-bs-toggle="pill" href="#tab-1">
                                    <i class="fa fa-coffee fa-2x text-primary"></i>
                                    <div class="ps-3">
                                        <h6 class="mt-n1 mb-0">Entradas</h6>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill"
                                    href="#tab-2">
                                    <i class="fa fa-hamburger fa-2x text-primary"></i>
                                    <div class="ps-3">
                                        <h6 class="mt-n1 mb-0">Rollos Naturales</h6>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                                    href="#tab-3">
                                    <i class="fa fa-utensils fa-2x text-primary"></i>
                                    <div class="ps-3">
                                        <h6 class="mt-n1 mb-0">Kombos y Postres</h6>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Menu Start -->
                <div class="tab-content">
                    <!-- Entradas -->
                    <div id="tab-1" class="tab-pane fade show active">
                        <div class="row g-4">
                            <?php
                            $sql = "SELECT * FROM producto WHERE FK_categoria = 14 AND estado = 'disponible'";
                            $result = $bd->exec_instruction($sql);
                            foreach ($result as $row) {
                                echo ImprimirProductoTabla($row["direccion_imagen"], $row["nombre"], $row["descripcion"], $row["PK_producto"], $row["precio"]);
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Rollos Naturales -->
                    <div id="tab-2" class="tab-pane fade">
                        <div class="row g-4">
                            <?php
                            $sql = "SELECT * FROM producto WHERE FK_categoria = 15 AND estado = 'disponible'";
                            $result = $bd->exec_instruction($sql);

                            foreach ($result as $row) {
                                echo ImprimirProductoTabla($row["direccion_imagen"], $row["nombre"], $row["descripcion"], $row["PK_producto"], $row["precio"]);
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Kombos y Postres -->
                    <div id="tab-3" class="tab-pane fade">
                        <div class="row g-4">
                            <?php
                            $sql = "SELECT * FROM producto WHERE FK_categoria = 16 AND estado = 'disponible'";
                            $result = $bd->exec_instruction($sql);

                            foreach ($result as $row) {
                                echo ImprimirProductoTabla($row["direccion_imagen"], $row["nombre"], $row["descripcion"], $row["PK_producto"], $row["precio"]);
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="session.php">Crea tu pedido</a>
                    <!-- Menu End -->


                <!-- Footer Start -->
                <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn " data-wow-delay="0.1s ">
                    <div class="container py-5 ">
                        <div class="row g-5 ">
                            <div class="col-lg-3 col-md-6 ">
                                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4 ">
                                    Compañia</h4>
                                <a class="btn btn-link " href=" ">Nosotros</a>
                                <a class="btn btn-link " href=" ">Contactanos</a>
                                <a class="btn btn-link " href=" ">Reservaciones</a>
                                <a class="btn btn-link " href=" ">Politica de Privacidad</a>
                                <a class="btn btn-link " href=" ">Terminos y condiciones</a>
                            </div>
                            <div class="col-lg-3 col-md-6 ">
                                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4 ">
                                    Contacto</h4>
                                <p class="mb-2 "><i class="fa fa-map-marker-alt me-3 "></i>Av.16 de Septiembre,
                                    Piedras Negras,
                                    MX</p>
                                <p class="mb-2 "><i class="fa fa-phone-alt me-3 "></i>+52 878 123 9277</p>
                                <p class="mb-2 "><i class="fa fa-envelope me-3 "></i>info@example.com</p>
                                <div class="d-flex pt-2 ">
                                    <a class="btn btn-outline-light btn-social " href=" "><i
                                            class="fab fa-twitter "></i></a>
                                    <a class="btn btn-outline-light btn-social " href=" "><i
                                            class="fab fa-facebook-f "></i></a>
                                    <a class="btn btn-outline-light btn-social " href=" "><i
                                            class="fab fa-youtube "></i></a>
                                    <a class="btn btn-outline-light btn-social " href=" "><i
                                            class="fab fa-linkedin-in "></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 ">
                                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4 ">
                                    Horario</h4>
                                <h5 class="text-light fw-normal ">Lunes - Sabado</h5>
                                <p>09AM - 09PM</p>
                                <h5 class="text-light fw-normal ">Domingo</h5>
                                <p>10AM - 08PM</p>
                            </div>
                            <div class="col-lg-3 col-md-6 ">
                                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4 ">
                                    PROMOCIONES</h4>
                                <p>Para cupones, descuentos, ofertas y de mas. REGISTRATE!.</p>
                                <div class="position-relative mx-auto " style="max-width: 400px; ">
                                    <input class="form-control border-primary w-100 py-3 ps-4 pe-5 " type="text "
                                        placeholder="Correo Electronico ">
                                    <button type="button "
                                        class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2 ">REGISTRATE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container ">
                        <div class="copyright ">
                            <div class="row ">
                                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 ">
                                    &copy; <a class="border-bottom " href="#
                            ">Diseño por nosotros</a>, Todos los Derechos Reservados.

                                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal ". Thank you for your support. ***/-->
                                    Designed By <a class="border-bottom " href="https://htmlcodex.com ">HTML
                                        Codex</a><br><br>
                                    Distributed By <a class="border-bottom " href="https://themewagon.com "
                                        target="_blank ">ThemeWagon</a>
                                </div>
                                <div class="col-md-6 text-center text-md-end ">
                                    <div class="footer-menu ">
                                        <a href=" ">Inicio</a>
                                        <a href=" ">Cookies</a>
                                        <a href=" ">Ayuda</a>
                                        <a href=" ">FQAs</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->



                    <!-- Back to Top -->
                    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                            class="bi bi-arrow-up"></i></a>
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