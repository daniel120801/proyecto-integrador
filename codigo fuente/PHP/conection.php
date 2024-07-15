<?php

class BD_PDO
{
    public function exec_instruction($instruction)
    {
        $host = 'localhost';
        $usr = 'root';
        $pwd = 'Zorrilla21';
        $db = 'db_sushi';

        try {
            $conexion = new PDO("mysql:host=$host;dbname=$db;", $usr, $pwd);
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Failed to get DB handle: '.$e->getMessage();
            exit;
        }

        // Asignando una instruccion sql
        $result = [];
        $result['message'] = 'vacio';
        $result['rows'] = [];
        $query = $conexion->prepare($instruction);
        if (!$query) {
            $result['message'] = 'Error al mostrar';
        } else {
            $query->execute();
            while ($r = $query->fetch()) {
                $result['rows'][] = $r;
                $result['message'] = 'ejecutado con exito';
            }
        }

        return $result;
    }
}
