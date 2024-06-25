<?php

require 'conection.php';
class ticketUtils
{
    public $idPedido = 1;
    public $pedido;
    public function getUser()
    {

        $bd = new BD_PDO();

       $pedido = $bd.exec_instruction("SELECT * FROM pedido WHERE PK_pedido =".$idPedido." ");



    }
}
