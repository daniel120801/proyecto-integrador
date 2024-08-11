<?php
require "PHP/SessionUtils.php";

session_start();
if (!isset($_SESSION[$StipoUsr]) || $_SESSION[$StipoUsr] != "admin") {
    redirectLogin('registro.php');

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sushi-to - Bootstrap Restaurant Template</title>
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




</head>
<?php
error_reporting(1);
require 'PHP/conection.php';
$obj = new BD_PDO();

if (isset($_POST['btnregistrar'])) {
    $nombre = $_POST['txtnombre'];
    $PKcategoria = $_POST['txtPKcategoria'];
    $estado = $_POST['txtestado'];
    $descripcion = $_POST['txtdescripcion'];
    $precio = $_POST['txtprecio'];

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $ruta_destino = 'img/'; // Carpeta donde se guardará la imagen
        $nombre_imagen = basename($_FILES['file']['name']);
        $ruta_completa = $ruta_destino . $nombre_imagen;

        // Mover la imagen a la carpeta
        if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta_completa)) {
            // Guardar la ruta en la base de datos
            $obj->exec_instruction("INSERT INTO producto (Nombre, direccion_imagen, FK_categoria, Estado, Descripcion, Precio)
            VALUES ('$nombre', '$ruta_completa', '$PKcategoria', '$estado', '$descripcion', '$precio')");
        } else {
            echo "Error al mover la imagen.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}

if (isset($_POST['btnactualizar'])) {
    $id = $_POST['id_producto'];
    $nombre = $_POST['txtnombre'];
    $PKcategoria = $_POST['txtPKcategoria'];
    $estado = $_POST['txtestado'];
    $descripcion = $_POST['txtdescripcion'];
    $precio = $_POST['txtprecio'];

    $update_query = "UPDATE producto SET Nombre = '$nombre', FK_categoria = '$PKcategoria', Estado = '$estado', Descripcion = '$descripcion', Precio = '$precio'";

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $ruta_destino = 'img/';
        $nombre_imagen = basename($_FILES['file']['name']);
        $ruta_completa = $ruta_destino . $nombre_imagen;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta_completa)) {
            $update_query .= ", direccion_imagen = '$ruta_completa'";
        } else {
            echo "Error al mover la imagen.";
        }
    }

    $update_query .= " WHERE PK_producto = '$id'";
    $obj->exec_instruction($update_query);
} elseif (isset($_GET['idmodificar'])) {
    $id = $_GET['idmodificar'];
    $datos_modificar = $obj->exec_instruction("Select * from producto where PK_producto = '$id'");
    $categoria = $obj->ListarCategorias("Select * from categoria", $datos_modificar[0][5]);
} else {
    $categoria = $obj->ListarCategorias("Select * from categoria", -1);
}

$textobuscar = $_POST['txtbuscarque'];
$result = $obj->exec_instruction("Select * from producto where Nombre like '%$textobuscar%'");

?>

<body>

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
                        <a href="registro.php" class="nav-item nav-link active">Resgitro</a>
                        <a href="menu.php" class="nav-item nav-link ">Menu</a>
                        <a href="contact.html" class="nav-item nav-link">Contacto</a>

                    </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Registro de Productos</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Product Registration Start -->
        <div class="container ">

            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Registro de Productos
            </h5>
            <div class="row ">
                <div class="col-6">
                    <h1 class="mb-4">Registrar un nuevo producto</h1>
                    <div class="mb-3">
                        <div class="container py-5">
                            <form id="productForm" action="Registro.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="txtnombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" id="txtnombre" name="txtnombre" class="form-control"
                                        placeholder="Nombre"
                                        value="<?php echo isset($datos_modificar[0]['nombre']) ? $datos_modificar[0]['nombre'] : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="txtPKcategoria" class="form-label">Categoria</label>
                                    <select name="txtPKcategoria" id="txtPKcategoria" class="form-control" required>
                                        <option value="">Seleccione Opcion</option>
                                        <?php echo $categoria; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtestado" class="form-label">Estado</label>
                                    <select class="form-select" name="txtestado" id="txtestado">
                                        <option value="1">--- vacio ---
                                        </option>
                                        <option value="disponible" <?php echo isset($datos_modificar[0]['estado']) && $datos_modificar[0]['estado'] == 'disponible' ? 'selected' : ''; ?>>Disponible
                                        </option>
                                        <option value="No disponible" <?php echo isset($datos_modificar[0]['estado']) && $datos_modificar[0]['estado'] == 'No disponible' ? 'selected' : ''; ?>>No
                                            disponible
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="txtdescripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="txtdescripcion" name="txtdescripcion"
                                        placeholder="Descripcion"
                                        rows="3"><?php echo isset($datos_modificar[0]['descripcion']) ? $datos_modificar[0]['descripcion'] : ''; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="txtprecio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="txtprecio" name="txtprecio"
                                        placeholder="Precio"
                                        value="<?php echo isset($datos_modificar[0]['precio']) ? $datos_modificar[0]['precio'] : ''; ?>">
                                </div>
                                <div>
                                    <label for="file">Selecciona una imagen:</label>
                                    <input type="file" class="btn" name="file" id="file">
                                </div>
                                <?php
                                if (isset($datos_modificar)) {
                                    echo '<input type="hidden" name="id_producto" value="' . $datos_modificar[0]['PK_producto'] . '">';
                                    echo '<div><input type="submit" id="btnactualizar" name="btnactualizar" value="Actualizar"></div>';
                                } else {
                                    echo '<div><input type="submit" id="btnregistrar" name="btnregistrar" value="Registrar"></div>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">


                    <!-- Tabla de productos -->
                    <div class="">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Productos
                            Registrados</h5>
                        <h1 class="mb-4">Lista de productos</h1>
                        <form action="Registro.php" method="post">
                            <div class="mb-3 d-flex justify-content-between">

                                <input type="text" id="txtbuscarque" name="txtbuscarque" class="form-control me-1"
                                    placeholder="Ingrese el nombre a buscar">
                                <input type="submit" id="btnbuscar" name="btnbuscar" class="btn btn-primary"
                                    value="Buscar">
                            </div>
                        </form>
                        <div id="productList" class=" row product-list">
                            <?php
                            foreach ($result as $producto) {
                                echo '  <div class=" col-6 card mb-6">
                                        <div class="">
                                            <div class="d-flex justify-content-center">
                                                <img src="' . $producto['direccion_imagen'] . '"
                                                    class="img-fluid rounded-start w-75"
                                                    alt="' . $producto['nombre'] . '"
                                                    style="height: 80%; object-fit: cover;">
                                            </div>
                                            <div>
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>' . $producto['nombre'] . '</span>
                                                        <span class="text-primary">$' . $producto['precio'] . '</span>
                                                    </h5>
                                                    <p class="card-text"><small class="text-muted">' .
                                    $producto['descripcion'] . '</small></p>
                                                    <div class="d-flex justify-content-end">
                                                        <form method="GET" action="Registro.php"
                                                            style="display: inline;">
                                                            <input type="hidden" name="idmodificar"
                                                                value="' . $producto['PK_producto'] . '">
                                                            <button type="submit" class="btn btn-outline-primary">
                                                                <i class="fas fa-edit"></i> Editar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>';
                            }
                            ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Product Registration End -->

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
                        <a class="btn btn-outline-light btn-social " href=" "><i class="fab fa-twitter "></i></a>
                        <a class="btn btn-outline-light btn-social " href=" "><i class="fab fa-facebook-f "></i></a>
                        <a class="btn btn-outline-light btn-social " href=" "><i class="fab fa-youtube "></i></a>
                        <a class="btn btn-outline-light btn-social " href=" "><i class="fab fa-linkedin-in "></i></a>
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
    <a href="# " class="btn btn-lg btn-primary btn-lg-square back-to-top "><i class="bi bi-arrow-up "></i></a>
    </div>

</body>
</html>