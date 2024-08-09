<?php
// Conexion a la base de datos
require "PHP/conection.php";
require "PHP/SessionVars.php";
session_start();
if(!isset($_SESSION[$Sid])){
    header("location:session.php?route=contact");
}
$id = $_SESSION[$Sid];


$bd = new BD_PDO();
// Verificar la conexión


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitComment'])) {
        // Insertar el comentario en la base de datos
        $comentario = $_POST['comment'];
        $calificacion = $_POST['rating'];
        $fecha = date("Y-m-d");

        $sql = "INSERT INTO resenas (FK_usuarios, calificacion, comentario, fecha) VALUES ($id, $comentario, $calificacion, $fecha)";
        $bd->exec_instruction($sql);
        

    } elseif (isset($_POST['deleteComment'])) {
        // Eliminar comentario
        $resenaId = $_POST['resenaId'];
        $sql = "DELETE FROM resenas WHERE PK_resenas = $resenaId";
        $bd->exec_instruction($sql);
    }

}


// Mostrar los comentarios
$sql = "SELECT PK_resenas, calificacion, comentario, fecha FROM resenas ORDER BY fecha DESC";
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
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
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
            margin-bottom: 10px;
            color: #f2b01e;
        }

        .comment-text {
            margin-bottom: 10px;
        }

        .outer-comment {
            list-style-type: none;
            padding-left: 0;
        }

        .outer-comment > li {
            margin-bottom: 15px;
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
            <!-- Código del navbar omitido para brevedad -->
        </div>
        <!-- Navbar & Hero End -->

        <!-- Contact Start -->
        < class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Dinos, tu experiencia.
                    </h5>
                    <h1 class="mb-5">Envíanos tu comentario</h1>
                </div>

                <div class="row g-4 contact-form-wrapper">
                    <div class="col-12 contact-form">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <div class="comment-form-container">
                                <form action="" method="POST">
                                    <div class="input-row">
                                        <input type="hidden" name="comment_id" id="commentId" value="0" />
                                        <input class="form-control" type="text" name="name" id="name"
                                            placeholder="Nombres" required />
                                    </div>
                                    <div class="input-row">
                                        <textarea class="input-field form-control" name="comment" id="comment"
                                            placeholder="Agrega tu mensaje" required></textarea>
                                    </div>
                                    <div class="input-row">
                                        <label for="rating">Calificación:</label>
                                        <div class="star-rating">
                                            <input type="radio" id="star5" name="rating" value="5" required /><label
                                                for="star5" title="5 estrellas">5 estrellas</label>
                                            <input type="radio" id="star4" name="rating" value="4" required /><label
                                                for="star4" title="4 estrellas">4 estrellas</label>
                                            <input type="radio" id="star3" name="rating" value="3" required /><label
                                                for="star3" title="3 estrellas">3 estrellas</label>
                                            <input type="radio" id="star2" name="rating" value="2" required /><label
                                                for="star2" title="2 estrellas">2 estrellas</label>
                                            <input type="radio" id="star1" name="rating" value="1" required /><label
                                                for="star1" title="1 estrella">1 estrella</label>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-primary" name="submitComment"
                                            value="Agregar Comentario" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comentarios existentes -->
                
                <div class="mt-4">
                    <ul class="outer-comment">
                        <?php
                        if (count($resultado) > 0) {

                            foreach ($resultado as $fila) {




                                ?>
                                <li>
                                    <div class="comment-row">
                                        <div class="comment-info">
                                            <span class="star-rating-display">
                                                <?php for ($i = 0; $i < $fila['calificacion']; $i++)
                                                    echo "&#9733;"; ?>
                                            </span>
                                            <span class="posted-by"><?php echo "Usuario ID: " . $fila['PK_resenas']; ?></span>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                    type="button">...</button>
                                                <div class="dropdown-menu">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="resenaId"
                                                            value="<?php echo $fila['PK_resenas']; ?>">
                                                        <input type="submit" name="deleteComment" value="Eliminar"
                                                            class="dropdown-item">
                                                    </form>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="resenaId"
                                                            value="<?php echo $fila['PK_resenas']; ?>">

                                                
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-text"><?php echo $fila['comentario']; ?></div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            echo "No hay comentarios todavía.";
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
        
        <!-- Contact End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
                class="bi bi-arrow-up"></i></a>
    </div>
</body>

</html>

