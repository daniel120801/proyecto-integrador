<?php

require 'conection.php';
class ticketUtils
{
    public $idPedido = 1;
    public $pedido;
    public function getUser()
    {

        $bd = new BD_PDO();

        $this->pedido = $bd->exec_instruction("SELECT * FROM pedido WHERE PK_pedido =" . $this->idPedido . " ");



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
                                <th scope="col">acciones</th>
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
                                <td>
                                    <button class="btn btn-primary" style="width: 30px; height:30px;">-</button>
                                </td>
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
