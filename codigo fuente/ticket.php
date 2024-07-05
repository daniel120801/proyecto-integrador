<?php
require "PHP/ticketUtils.php";
require "PHP/Utils.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ticket</title>

    <?php echo printLinks(); ?>
</head>

<body>
    <?php

    $utils = new ticketUtils();

    ?>
    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 pe-4">
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Service</a>
                    <a href="menu.html" class="nav-item nav-link active">Menu</a>
                </div>
        </nav>

        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Compra</h1>
            </div>
        </div>
    </div>

    <!-- Navbar & Hero End -->
    <div class="container">
        <div class=" tab-content text-center wow fadeInUp"
            style=" border: 4px solid rgb(254, 175, 57); border-radius: 20px;    box-shadow: 0 0 45px rgba(0, 0, 0, .3);">

            <!--  ticket-->
            <div class="tab-pane active">
                <div class="container " style="  width: 80%; ">

                    <!--informacion del cliente-->
                    <h3 class="section-title mt-5">Información de cliente</h3>
                    <div class="container mt-3" style="width: 50%;">
                        <div class="row">
                            <div class="col text-start">
                                <label for="">Nombre de Cliente: </label>

                            </div>

                            <div class="col text-start">
                                <label for="">Nombre........</label>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="row">
                            <div class="col text-start">
                                <label for="">forma de pago:</label>

                            </div>
                            <div class="col text-start">
                                <label for="">efectivo/tarjeta</label>

                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="row">
                            <div class="col text-start">
                                <label for="">direccion de pedido:</label>

                            </div>
                            <div class="col text-start">
                                <label for="">Algun lugar </label>
                            </div>


                        </div>
                        <div class="mt-2"></div>
                        <div class="row">
                            <div class="col text-start">
                                <label for="">tipo de pedido:</label>

                            </div>
                            <div class="col text-start">
                                <label for="">Domicilio/recoger en local</label>
                            </div>


                        </div>

                        <div class="mt-5"></div>



                    </div>
                    <!--tabla de productos-->

                    <?php
                    echo $utils->CrearTabla();
                    ?>


                </div>

            </div>
            <div class="text-center wow fadeInUp mt-5 mb-4">

                <a id="confirmar" href="" class="btn btn-primary rounded-3 py-sm-2 px-sm-2">Confirmar</a>

            </div>
        </div>



        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3  align-self-center col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Reservation</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3  align-self-center col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3  align-self-center col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>09AM - 09PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 08PM</p>
                    </div>
                    <div class="col-lg-3  align-self-center col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a><br><br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com"
                                target="_blank">ThemeWagon</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    </div>
</body>

</html>