<?php
$Scorreo = "correo";
$Spwd = "pwd";
$Snombre = "nombre";
$Sapellido = "apellido";
$Sid = "id";
$Sdomicilio = "domicilio";
$Sid_pedido = "id_pedido";
$StipoUsr = "tipo_Usuario";


function redirectLogin($route)
{

    $url = 'session.php';  // Reemplaza con la URL de destino
    /* $data = array(
         'route' => $route,
     );
 */
    // Construye un formulario HTML con los datos POST
    echo "<form id='postForm' action='$url' method='POST'>";

    // Añade los campos ocultos con los datos POST

    echo "<input type='hidden' id='" . htmlspecialchars('route') . "' name='" . htmlspecialchars('route') . "' value='" . htmlspecialchars($route) . "'>";


    echo "</form>";

    // Genera el script de JavaScript para enviar el formulario automáticamente
    echo "<script type='text/javascript'>
    document.getElementById('postForm').submit();
</script>";



}
