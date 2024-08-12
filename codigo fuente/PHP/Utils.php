<?php
function printHead($titlePage)
{
    return '
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $titlePage . '</title>
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
    <link href="css/original.css" rel="stylesheet">
    ';
}
function getFooter()
{
    return '
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
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a><br><br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com"
                                target="_blank">ThemeWagon</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Inicio</a>
                                <a href="registro.php">Registro</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';


}
function alert($message){
    echo "<script type='text/javascript'>
    alert('".$message."');
</script>";

}