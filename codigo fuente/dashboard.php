<?php
require "PHP/Utils.php";
require "PHP/SessionUtils.php";
require "PHP/conection.php";
session_start();

if (!isset($_SESSION[$Snombre])) {
    redirectLogin('dashboard.php');
    exit();
}
$id = $_SESSION[$Sid];
$bd = new BD_PDO();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo printHead("Dashboard"); ?>
</head>
<?php
if (isset($_GET['mod_pwd'])) {
    $pwd = $_GET['c_password'];
    $sql = "UPDATE `usuarios` SET `contrasena`='$pwd' WHERE PK_id = $id";
    $bd->exec_instruction($sql);

} else if (isset($_GET['mod_data'])) {
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $direccion = $_GET['direccion'];
    $sql = "UPDATE `usuarios` SET `nombre`='$nombre',`apellido`='$apellido',`direccion`='$direccion' WHERE  PK_id = $id";
    $bd->exec_instruction($sql);

    $_SESSION[$Sdomicilio] = $direccion;
    $_SESSION[$Snombre] = $nombre . " " . $apellido;

}

?>

<body>




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


                    <a href="menu.php" class="nav-item nav-link">Menú</a>

                    <div class="nav-item nav-link">
                        <a href="session.php?nologin=" class="btn btn-danger">Cerrar sesión</a>
                    </div>
                </div>
        </nav>
        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Dashboard</h1>
                <h4 class="display-8  text-primary mt-3 animated slideInDown">Hola
                    <?php echo $_SESSION[$Snombre] ?>
                </h4>
            </div>

        </div>
    </div>
    <div class="container-xxl">
        <div class="row g-2">
            <div class="col-7 ">
                <h3>Pedidos</h3> <?php
                $SQLpedidos = "SELECT * FROM pedido WHERE FK_usuario = $id";
                $pedidos = $bd->exec_instruction($SQLpedidos);
                if (count($pedidos) > 0) {

                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Productos</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($pedidos as $pedido) {

                                    $SQLdetalle = "SELECT  dp.*, producto.nombre AS nombre FROM detalle_pedido dp JOIN producto on dp.FK_producto = producto.PK_producto WHERE FK_pedido = " . $pedido['PK_pedido'] . " ";
                                    $detalles = $bd->exec_instruction($SQLdetalle);

                                    $filas = '<div class="ms-5 row row-cols-2">';
                                    foreach ($detalles as $detalle) {
                                        $filas .= '<div class="col">';
                                        $filas .= $detalle['nombre'];
                                        $filas .= '</div> ';
                                        $filas .= '<div class="col">';
                                        $filas .= $detalle['cantidad'];
                                        $filas .= '</div>';
                                    }
                                    $filas .= '</div>'; // Se corrige la asignación para cerrar el div correctamente
                            
                                    echo '
                                    <tr class="">
                                        <td scope="row">' . $pedido['fecha'] . '</td>
                                        <td>' . $filas . '</td>
                                        <td>' . $pedido['estado_pedido'] . '</td>
                                    </tr>';
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>

                    <?php

                } else { ?>
                    <h6 class="text-center">Sin pedidos realizados</h6>
                <?php } ?>
            </div>
            <div class="col-5">
                <div class="w-50 mx-auto">
                    <form action="dashboard.php" method="get">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                value=" <?php echo explode(" ", $_SESSION[$Snombre])[0]; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" name="apellido" id="apellido"
                                value=" <?php echo explode(" ", $_SESSION[$Snombre])[1]; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="direccion">Direccion de entrega(opcional):</label>
                            <input type="text" class="form-control" name="direccion" id="direccion"
                                value=" <?php echo $_SESSION[$Sdomicilio]; ?>" placeholder="no asignado">
                        </div>
                        <button type="submit" id="mod_data" name="mod_data" class="btn btn-primary w-50">Modificar
                            cuenta</button>

                    </form>

                    <form action="dashboard.php" class="mt-5" method="get">
                        <h5>Modificar contraseña</h5>
                        <div class="form-group mb-3">
                            <label for="c_password">Contraseña:</label>
                            <input type="password" class="form-control" name="c_password" id="c_password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm_password">Confirme contraseña:</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                required>
                        </div>
                        <button type="submit" id="mod_pwd" name="mod_pwd" class="btn btn-primary w-50">Modificar
                            contraseña</button>
                    </form>
                </div>

            </div>
        </div>



    </div>

    <?php echo getFooter(); ?>
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
</body>

</html>