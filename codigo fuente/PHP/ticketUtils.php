<?php

require 'conection.php';
class ticketUtils
{
    public $idPedido = -1;
    public $pedido;
    public function getUser()
    {

        if (!isset($_POST['id_pedido'])) {

            return "error";
        }
        $this->idPedido = $_POST['id_pedido'];

        $bd = new BD_PDO();

        $this->pedido = $bd->exec_instruction("SELECT 
        CONCAT(usuarios.nombre, ' ', usuarios.apellido) nombre,pedido.fecha,pedido.direccion,pedido.metodo_pago,pedido.tipo_pedido 
        FROM pedido INNER JOIN usuarios ON pedido.FK_usuario = usuarios.PK_id WHERE pedido.PK_pedido = " . $this->idPedido . ";");
        return "success";


    }
    function imprimirDatosUsuario()
    {

        echo '
          <div class="container mt-3" style="width: 50%;">
                        <div class="row">
                            <div class="col text-start">
                                <label for="">Nombre de Cliente: </label>

                            </div>

                            <div class="col text-start">
                                <label for="">' . $this->pedido[0]['nombre'] . '</label>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="row">
                            <div class="col text-start">
                                <label for="">forma de pago:</label>

                            </div>
                            <div class="col text-start">
                                <label for="">' . $this->pedido[0]['metodo_pago'] . '</label>

                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="row">
                            <div class="col text-start">
                                <label for="">direccion de pedido:</label>

                            </div>
                            <div class="col text-start">
                                <label for="">' . $this->pedido[0]['direccion'] . '</label>
                            </div>


                        </div>
                        <div class="mt-2"></div>
                        <div class="row">
                            <div class="col text-start">
                                <label for="">tipo de pedido:</label>

                            </div>
                            <div class="col text-start">
                                <label for="">' . $this->pedido[0]['tipo_pedido'] . '</label>
                            </div>


                        </div>

                        <div class="mt-5"></div>



                    </div>
        ';
    }
    function CrearTabla(
    ): string {
        $bd = new BD_PDO();
        $result = $bd->exec_instruction("SELECT detalle_pedido.cantidad,detalle_pedido.precio,producto.nombre AS nombre  FROM detalle_pedido 
                                JOIN producto on FK_producto = producto.PK_producto   WHERE FK_pedido =$this->idPedido");

        $rt = ' <table class="table table-hover">  <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" colspan="2"> Producto </th>
                                <th scope="col">Cantidad</th>

                                <th scope="col">Precio</th>
                            </tr>
                        </thead> <tbody>';
        $total = 0;
        if (isset($result)) {


            foreach ($result as $renglon) {
                $rt .= ' <tr>
                                <th scope="row">1</th>
                                <td colspan="2">' . $renglon['nombre'] . '</td>
                                <td>' . $renglon['cantidad'] . '</td>

                                <td>$' . $renglon['precio'] . '</td>
                             
                            </tr>';
                $total += $renglon['cantidad'] * $renglon['precio'];
            }
        }
        $rt .= '  </tbody> <tfoot>
                            <th>Total</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>' . $total . '</td>
                        </tfoot></table>';
        return $rt;

    }

}
