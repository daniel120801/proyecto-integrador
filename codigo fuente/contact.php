<?php
// Conexion a la base de datos
require "PHP/conection.php";
require "PHP/SessionUtils.php";
session_start();
if (!isset($_SESSION[$Sid])) {
    redirectLogin('contact.php');
}
$id = $_SESSION[$Sid];
$bd = new BD_PDO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitComment'])) {
        // Insertar el comentario en la base de datos
        $comentario = $_POST['comment'];
        $calificacion = $_POST['rating'];
        $fecha = date("Y-m-d");

        $sql = "INSERT INTO resenas (FK_usuarios, calificacion, comentario, fecha) VALUES ('$id', '$calificacion', '$comentario', '$fecha')";
        $bd->exec_instruction($sql);
    } elseif (isset($_POST['deleteComment'])) {
        // Validar permisos para eliminar comentario
        $resenaId = $_POST['resenaId'];

        // Verificar si el usuario es admin
        $sql = "SELECT tipo_usuario FROM usuarios WHERE PK_id = '$id'";
        $resultado = $bd->exec_instruction($sql);
        $usuario = $resultado[0];
        $rol = $usuario['tipo_usuario'];

        // Verificar si el comentario pertenece al usuario o el usuario es admin
        if ($rol == 'admin') {
            $sql = "DELETE FROM resenas WHERE PK_resenas = $resenaId";
        } else {
            $sql = "DELETE FROM resenas WHERE PK_resenas = $resenaId AND FK_usuarios = '$id'";
        }
        $bd->exec_instruction($sql);
    }
}

// Mostrar los comentarios
$sql = "SELECT PK_resenas, FK_usuarios, calificacion, comentario, fecha FROM resenas ORDER BY fecha DESC";
$resultado = $bd->exec_instruction($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        .contact-form-wrapper {
            display: flex;
            justify-content: center;
        }

        .contact-form {
            max-width: 600px;
            width: 100%;
        }

        .comment-form-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        .comment-row {
            margin-bottom: 15px;
        }

        .comment-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            /* Agregado para separar la información del comentario del texto */
        }

        .comment-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .posted-by {
            font-weight: bold;
        }

        .star-rating-display {
            color: #f2b01e;
        }

        .comment-text {
            text-align: left;
            /* Cambiado de center a left */
            margin-bottom: 10px;
        }

        .comment-date {
            text-align: left;
            /* Cambiado de center a left */
            font-size: 0.9em;
            color: #999;
        }

        .outer-comment {
            list-style-type: none;
            padding-left: 0;
            margin: 0 auto;
            /* Centrar la lista de comentarios */
            max-width: 800px;
            /* Ajustar el ancho máximo */
        }

        .outer-comment>li {
            margin-bottom: 15px;
            padding: 10px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .dropdown-menu {
            display: none;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
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
                    <div class="navbar-nav ms-auto py-0 pe-4">

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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Reseñas</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Contact Start -->
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Dinos, tu experiencia.</h5>
                <h1 class="mb-5">Hola <?php echo $_SESSION[$Snombre] ?>, Dejanos un comentario.</h1>
            </div>
            <div class="row g-4 contact-form-wrapper">
                <div class="col-12 contact-form">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="comment-form-container">
                            <form action="" method="post">
                                <div class="input-row">
                                    <input type="hidden" name="comment_id" id="commentId" value="0" />
                                </div>
                                <div class="input-row">
                                    <textarea class="input-field form-control" name="comment" id="comment"
                                        placeholder="Escribe tu comentario aquí"></textarea>
                                </div>
                                <div class="input-row">
                                    <label for="rating">Calificación:</label>
                                    <select name="rating" id="rating" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="submit" name="submitComment" class="btn btn-primary"
                                        value="Enviar Comentario" />
                                </div>
                            </form>
                        </div>

                        <ul class="outer-comment">
                            <?php
                            if (count($resultado) > 0) {
                                $bd = new BD_PDO();
                                $tipouser = $bd->exec_instruction("SELECT usuarios.tipo_Usuario FROM usuarios WHERE PK_id = $id ");
                                foreach ($resultado as $fila) {

                                    $name = $bd->exec_instruction("SELECT CONCAT(usuarios.nombre, ' ', usuarios.apellido) nombre FROM usuarios WHERE PK_id = " . $fila["FK_usuarios"] . "  ");

                                    ?>
                                    <li>
                                        <div class="comment-info">
                                            <span class="posted-by ms-2"><?php echo htmlspecialchars($name[0][0]); ?></span>

                                            <span class="star-rating-display">
                                                <?php for ($i = 0; $i < $fila['calificacion']; $i++) { ?>
                                                    <i class="fa fa-star"></i>
                                                <?php } ?>
                                            </span>

                                            <!-- Mostrar menú de opciones solo si el usuario es admin o dueño del comentario -->
                                            <?php if ($tipouser[0][0] == 'admin' || $fila['FK_usuarios'] == $id) { ?>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <form method="post" action="">
                                                                <input type="hidden" name="resenaId"
                                                                    value="<?php echo $fila['PK_resenas']; ?>">
                                                                <button type="submit" name="deleteComment"
                                                                    class="dropdown-item">Eliminar</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="comment-text"><?php echo htmlspecialchars($fila['comentario']); ?></div>
                                        <div class="comment-date"><?php echo htmlspecialchars($fila['fecha']); ?></div>
                                    </li>
                                <?php }
                            } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Compañia</h4>
                        <a class="btn btn-link" href="">Nosotros</a>
                        <a class="btn btn-link" href="">Contacto</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contacto</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Piedras Negras ,Coahuila</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>878 123 9277</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>dandilbr4343@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Horario</h4>
                        <h5 class="text-light fw-normal">Lunes - Sabado</h5>
                        <p>09AM - 09PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 08PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Promociones</h4>
                        <p>¿Quieres saber de nuestras promociones registra tu correo</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Tu correo">
                            <button type="button"
                                class="btn btn-primary py-2 px-4 position-absolute top-0 end-0 mt-2 me-2">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>