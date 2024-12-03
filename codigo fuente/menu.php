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

    session_start();
    if (!isset($_SESSION[$Sid])) {
        redirectLogin("menu.php");
    }
    $id = $_SESSION[$Sid];
    //error_reporting(1);
    $bd = new BD_PDO();

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
                        <form method="get" class="mt-2">
                            <input type="hidden" name="insertar_id" value="' . htmlspecialchars($id) . '">
                            <input class="btn btn-success" type="submit" value="Agregar">
                        </form>
                        </h5>
                        <small class="fst-italic">' . htmlspecialchars($descripcion) . '</small>
                    </div>
                </div>
            </div>';
    }
    function Buscar($img, $nombre, $descripcion, $id, $precio): string
    {
        return '
            <div class="col-lg-8">
                <div class="d-flex align-items-center">
                    <img class="flex-shrink-0 img-fluid rounded" src="' . htmlspecialchars($img) . '" alt="" style="width: 80px;">
                    <div class="w-100 d-flex flex-column text-start ps-3">
                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                            <span>' . htmlspecialchars($nombre) . '</span>
                            <span class="text-primary ms-3">$' . htmlspecialchars($precio) . '</span>
                        <form method="get" class="mt-5">
                            <input type="hidden" name="insertar_id" value="' . htmlspecialchars($id) . '">
                            <input class="btn btn-success" type="submit" value="Agregar">
                        </form>
                        </h5>
                        <small class="fst-italic">' . htmlspecialchars($descripcion) . '</small>
                    </div>
                </div>
            </div>';
    }

    if (isset($_POST['Enlace'])) {

        $metodoPago = $_POST['metodoPago'];
        $metodoEntrega = $_POST['tipopedido'];
        $direccion = $_POST['Direccion'];


        $sql = "UPDATE `pedido` SET `tipo_pedido`='$metodoEntrega',`direccion`='$direccion',`metodo_pago`='$metodoPago' WHERE PK_pedido= " . $_SESSION[$Sid_pedido] . "";
        $bd->exec_instruction($sql);
        header("Location: ticket.php");

        return;
    }

    if (isset($_GET['insertar_id'])) {

        if (!isset($_SESSION[$Sid_pedido])) {

            $bd->exec_instruction("Insert into pedido(FK_usuario,estado_pedido,fecha) values('$id','cancelado',Now())");

            $ultima_compra = $bd->exec_instruction("SELECT PK_pedido FROM pedido where FK_usuario = '$id' ORDER by PK_pedido DESC");

            $_SESSION[$Sid_pedido] = $ultima_compra[0][0];
        }
        //obj->Ejecutar_Instruccion("Insert into detalle_venta(Id_venta,Id_producto,Cantidad,Precio) values('$idventa','$idproducto','$cantidad','$precio')");
    
        $bd->exec_instruction("CALL agregar_producto(" . $_GET['insertar_id'] . "," . $_SESSION[$Sid_pedido] . ")");

    }
    if (isset($_POST['actualizar_cantidad'])) {
        $nueva_cantidad = intval($_POST['cantidad']);
        var_dump($_POST);

        if ($nueva_cantidad > 0) {
            $sql = "UPDATE detalle_pedido SET cantidad = '$nueva_cantidad' WHERE PK_detpedido = " . $_POST['PK_detpedido'] . "";
            $bd->exec_instruction($sql);
        }

    } else if (isset($_GET['eliminar'])) {
        $bd->exec_instruction("DELETE FROM detalle_pedido   WHERE PK_detpedido = " . $_GET['eliminar'] . "");
    }

    if (isset($_GET['txtbuscarque'])) {
        $textobuscar = $_GET['txtbuscarque'];
    }

    ?>


    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Sushi-to</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">

                        <a href="index.php" class="nav-item nav-link">Inicio</a>

                        <a href="menu.php" class="nav-item nav-link active">Menú</a>

                        <a href="contact.php" class="nav-item nav-link">Comentarios</a>

                        <div class="nav-item nav-link">
                            <a href="session.php"
                                class="btn btn-primary"><?php echo (isset($_SESSION[$Snombre]) ? $_SESSION[$Snombre] . ' ' . $_SESSION[$Sapellido] : "Iniciar sesión") ?></a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Menú Comidas</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <div>
            <form class="d-flex justify-content-center" action="menu.php" method="get">
                <input type="text" id="txtbuscarque" name="txtbuscarque" placeholder="Buscar"
                    value="<?php echo isset($textobuscar) ? htmlspecialchars($textobuscar) : ''; ?>"
                    class="form-control me-3 mb-0 w-50">
                <input class="btn btn-primary" type="submit" id="btnbuscar" name="btnbuscar" value="Buscar">
            </form>
            <br>
            <div class="row">
                <?php
                if (!empty($textobuscar)) {
                    $sql = "SELECT * FROM producto WHERE nombre LIKE '%" . $textobuscar . "%' AND estado = 'disponible'";
                    $result = $bd->exec_instruction($sql);
                    ?>
                    <div class="col-10 mb-4 ">
                        <h2 class="text-center">Resultados relacionados</h2>
                        <div class="row justify-content-center">
                            <?php
                            foreach ($result as $row) {
                                ?>
                                <div class="col-5 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <?php echo Buscar($row["direccion_imagen"], $row["nombre"], $row["descripcion"], $row["PK_producto"], $row["precio"]); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <br>

            <!-- Categorias Start -->
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative d-inline-block w-100">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5 position-relative">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-1">
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
                    <!-- Ícono de carrito separado -->
                    <ul class="nav nav-pills d-inline-flex justify-content-center mt-3 position-relative">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill"
                                href="#tab-4">
                                <i class="fa fa-shopping-cart fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <h6 class="mt-n1 mb-0">Carrito</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Categorias End -->


            <!-- Tab Content Start -->
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

                <!-- Carrito -->
                <div id="tab-4" class="tab-pane fade">

                    <!-- Productos Agregados -->
                    <?php
                    $result = [];
                    if (isset($_SESSION[$Sid_pedido])) {
                        $sql = "SELECT  dp.*, producto.nombre AS nombre FROM detalle_pedido dp JOIN producto on dp.FK_producto = producto.PK_producto WHERE FK_pedido = " . $_SESSION[$Sid_pedido] . " ";
                        $result = $bd->exec_instruction($sql);
                    }
                    if (count($result) > 0) {
                        ?>
                        <div class="container my-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($result as $row) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                                <td>
                                                    <form action="menu.php" method="post">
                                                        <input id="cantidad" type="number" name="cantidad" class="form-control"
                                                            value="<?php echo htmlspecialchars($row[3]); ?>" min="1">
                                                        <input id="PK_detpedido" name="PK_detpedido" type="hidden"
                                                            value="<?php echo htmlspecialchars($row[0]); ?>">
                                                </td>
                                                <td><?php echo htmlspecialchars($row[0]); ?></td>
                                                <td>
                                                    <button id="actualizar_cantidad" type="submit" name="actualizar_cantidad"
                                                        class="btn btn-primary me-3">actualizar</button>
                                                    </form>
                                                    <a href="menu.php?eliminar=<?php echo htmlspecialchars($row[0]); ?>"
                                                        class="btn btn-danger">Eliminar</a>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>

                            </div>

                            <div class="container mt-5">
                                <form action="menu.php" method="post" class="p-3">
                                    <div class="form-group ">
                                        <label for="metodoPago">Método de Pago:</label>
                                        <select id="metodoPago" name="metodoPago" class="form-control">
                                            <option value="tarjeta">Tarjeta</option>
                                            <option value="efectivo">Efectivo</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="tipopedido">Método de Entrega:</label>
                                        <select id="tipopedido" name="tipopedido" class="form-control"
                                            onchange="this.form.submit()">
                                            <option value="Domicilio" <?php if (isset($_POST['tipopedido']) && $_POST['tipopedido'] == 'Domicilio')
                                                echo 'selected'; ?>>Domicilio</option>
                                            <option value="Sucursal" <?php if (isset($_POST['tipopedido']) && $_POST['tipopedido'] == 'Sucursal')
                                                echo 'selected'; ?>>Sucursal</option>
                                        </select>
                                    </div>

                                    <?php
                                    // Mostrar el campo de dirección solo si el método de entrega es "Domicilio"
                                    if (isset($_POST['tipopedido']) && $_POST['tipopedido'] == 'Domicilio') {
                                        echo '<div class="form-group mt-3">';
                                        echo '<label for="Direccion">Dirección:</label>';
                                        echo '<input type="text" id="Direccion" name="Direccion" class="form-control" value="' . $_SESSION[$Sdomicilio] . '" required>';
                                        echo '</div>';
                                    } else if (isset($_POST['tipopedido']) && $_POST['tipopedido'] == 'Sucursal') {
                                        echo '<div class="form-group mt-3">';
                                        echo '<label for="Direccion">Dirección:</label>';
                                        echo '<input type="text" id="Direccion" name="Direccion" class="form-control" value="Seccion 1, Residencial del Lago, Piedras Negras, MX" readonly>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="form-group mt-3">';
                                        echo '<label for="Direccion">Dirección:</label>';
                                        echo '<input type="text" id="Direccion" name="Direccion" class="form-control"value="' . $_SESSION[$Sdomicilio] . '"  required>';
                                        echo '</div>';
                                    }
                                    ?>

                                    <div class="form-group mt-3">
                                        <input id="Enlace" name="Enlace" type="submit" class="btn btn-primary mb-3"
                                            value="Ver Ticket">
                                    </div>
                                </form>
                            </div>

                            <!-- Productos Agregados End -->
                        <?php } else { ?>
                            <h4 class="text-center">Vacio</h4>
                        <?php } ?>
                    </div>
                </div>
                <!-- Tab Content End -->

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
                                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Seccion 1, Residencial del
                                    Lago, Piedras
                                    Negras, MX</p>
                                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+52 878 123 9277</p>
                                <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                                <div class="d-flex pt-2">
                                    <a class="btn btn-outline-light btn-social" href="#"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-light btn-social" href="#"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-light btn-social" href="#"><i
                                            class="fab fa-youtube"></i></a>
                                    <a class="btn btn-outline-light btn-social" href="#"><i
                                            class="fab fa-linkedin-in"></i></a>
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