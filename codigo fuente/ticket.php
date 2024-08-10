<?php
require "PHP/ticketUtils.php";
require "PHP/Utils.php";
require "PHP/SessionVars.php";

session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php echo printHead("compra"); ?>
</head>

<body>
    <?php

    $utils = new ticketUtils();
    $r = $utils->getUser();
    if ($r == "error") {
        header("location: menu.php");
        exit();
    }

    ?>
    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Sushi-to</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
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
            </div>
        </nav>

        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Compra</h1>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
    <?php
    if (isset($_GET['confirm'])) {
        $utils->confirmTicket();

    } else if (isset($_GET['cancel'])) {
        $utils->cancelTicket();
    }



    ?>
    <div class="container">
        <div class=" tab-content text-center wow fadeInUp"
            style=" border: 4px solid rgb(254, 175, 57); border-radius: 20px;    box-shadow: 0 0 45px rgba(0, 0, 0, .3);">

            <!--  ticket-->
            <div class="tab-pane active">
                <div class="container w-75">
                    <!--informacion del cliente-->
                    <h3 class="section-title mt-5">Información de cliente</h3>
                    <?php $utils->imprimirDatosUsuario(); ?>

                    <!--tabla de productos-->
                    <?php echo $utils->CrearTabla(); ?>

                </div>

            </div>
            <form action="ticket.php" class="text-center wow fadeInUp mt-5 mb-4" method="get">



                <input type="submit" id="confirm" id="confirm" name="confirm" class=" btn btn-primary rounded-3 py-sm-2
                    px-sm-2" value="Confirmar" />

                <input type="submit" id="cancel" name="cancel" class="btn btn-danger rounded-3 py-sm-2  px-sm-2"
                    value="Cancelar" />

            </form>
        </div>
        <!-- Footer Start -->
        <?php echo getFooter(); ?>
        <!-- Footer End -->

    </div>


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