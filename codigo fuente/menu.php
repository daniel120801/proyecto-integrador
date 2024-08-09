<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tabla.css">

    <script>
        function CrearURLModificar(event, idDetPedido, idProducto) {

            event.preventDefault();

            var form = event.target;
            var formData = new FormData(form);
            var params = new URLSearchParams();

            for (var pair of formData.entries()) {
                params.append(pair[0], pair[1]);
            }

            params.append("idPedido", idDetPedido);
            params.append("idProducto", idProducto);
            params.append("modificar", '');

            var url = 'menu.php?' + params.toString();


            // Redirigir a la URL modificada
            window.location.href = url;
        }
    </script>

</head>

<body>
    <?php
    //error_reporting(1);
    require 'PHP/conection.php';
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
    if (isset($_GET['insertar_id'])) {
        $bd->exec_instruction("CALL agregar_producto(" . $_GET['insertar_id'] . ",1)");
    } else if (isset($_GET['modificar'])) {
        $bd->exec_instruction("CALL Actualizar_pedido(" . $_GET['idPedido'] . ",
                                    " . $_GET['idProducto'] . ",'" . $_GET['nombre'] . "'," . $_GET['cantidad'] . "," . $_GET['precio'] . ")");
    } else if (isset($_GET['eliminar'])) {
        $bd->exec_instruction("DELETE FROM detalle_pedido   WHERE PK_detpedido = " . $_GET['eliminar'] . "");
    }

    if (isset($_GET['txtbuscarque'])) {
        $textobuscar = $_GET['txtbuscarque'];
    }
    if (isset($_GET['idpremodificar'])) {
        $modificar = $bd->exec_instruction("SELECT dp.*, producto.nombre AS nombre 
            FROM detalle_pedido dp JOIN producto on dp.FK_producto = producto.PK_producto 
             WHERE PK_detpedido = " . $_GET['idpremodificar'] . " ");
    }

    ?>

    <div class="container-xxl bg-white p-0">
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
                        <a href="index.php" class="nav-item nav-link">Inicio</a>
                        <a href="about.html" class="nav-item nav-link">Nosotros</a>
                        <a href="registro.php" class="nav-item nav-link">Servicios</a>
                        <a href="menu.php" class="nav-item nav-link active">Menú</a>
                        <a href="contact.html" class="nav-item nav-link">Contacto</a>
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
            <form action="menu.php" method="get">
                <input type="text" id="txtbuscarque" name="txtbuscarque" placeholder="Buscar"
                    value="<?php echo isset($textobuscar) ? htmlspecialchars($textobuscar) : ''; ?>"
                    class="form-control mb-3 w-25">
                <input class="btn btn-primary" type="submit" id="btnbuscar" name="btnbuscar" value="Buscar">
            </form>
        </div>

<!-- Categorias Start -->
<div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
    <div class="position-relative d-inline-block w-100">
        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5 position-relative">
            <li class="nav-item">
                <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                    <i class="fa fa-coffee fa-2x text-primary"></i>
                    <div class="ps-3">
                        <h6 class="mt-n1 mb-0">Entradas</h6>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                    <i class="fa fa-hamburger fa-2x text-primary"></i>
                    <div class="ps-3">
                        <h6 class="mt-n1 mb-0">Rollos Naturales</h6>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
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
                <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-4">
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
                    if (!empty($textobuscar)) {
                        $sql .= " AND nombre LIKE '%" . $textobuscar . "%'";
                    }
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
                    if (!empty($textobuscar)) {
                        $sql .= " AND nombre LIKE '%" . $textobuscar . "%'";
                    }
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
                    if (!empty($textobuscar)) {
                        $sql .= " AND nombre LIKE '%" . $textobuscar . "%'";
                    }
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
                        $sql = "SELECT  dp.*, producto.nombre AS nombre FROM detalle_pedido dp JOIN producto on dp.FK_producto = producto.PK_producto WHERE FK_pedido = 1 "; // Ajusta la consulta según tu lógica
                        
                        $result = $bd->exec_instruction($sql);
                        foreach ($result as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row[3]); ?></td>
                                <td><?php echo htmlspecialchars($row[4]); ?></td>
                                <td>
                                    <a href="menu.php?idpremodificar=<?php echo htmlspecialchars($row[0]); ?>"
                                        class="btn btn-primary me-3 ">Modificar</a>

                                    <a href="menu.php?eliminar=<?php echo htmlspecialchars($row[0]); ?>"
                                        class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Productos Agregados End -->
            </div>
        </div>

        <!-- Tab Content End -->
        <?php
        if (isset($modificar)) {


            ?>
            <Form action="menu.php" method="get" class="container mt-3"
                onsubmit="CrearURLModificar(event,<?php echo $modificar[0]['PK_detpedido']; ?>,<?php echo $modificar[0]['FK_producto']; ?>)">
                <h5></h5>
                <div class="row">
                    <div class="col text-start">
                        <label>Nombre</label>

                    </div>
                    <div class="col text-start">
                        <input class="form-control" type="text" id="nombre" name="nombre"
                            value="<?php echo $modificar[0]['nombre']; ?>"></input>

                    </div>
                </div>

                <div class="row">
                    <div class="col text-start">
                        <label>Cantidad</label>

                    </div>
                    <div class="col text-start">
                        <input class="form-control" type="number" id="cantidad" name="cantidad"
                            value="<?php echo $modificar[0]['cantidad']; ?>"></input>

                    </div>
                </div>

                <div class="row">
                    <div class="col text-start">
                        <label>Precio</label>

                    </div>
                    <div class="col text-start">
                        <input class="form-control" type="number" id="precio" name="precio"
                            value="<?php echo $modificar[0]['precio']; ?>"></input>
                    </div>
                </div>
                <button type="submit" id="modificar" name="modificar" class="btn btn-primary">Modificar</button>


            </Form>
        <?php } ?>  


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Company</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Reservation</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Contact</h4>
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
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>09AM - 09PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 08PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-3">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
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

                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
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