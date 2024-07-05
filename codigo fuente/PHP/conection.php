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
        } catch (PDOException $e) {
            echo 'Failed to get DB handle: '.$e->getMessage();
            exit;
        }

        // Asignando una instruccion sql
        $result = null;
        $query = $conexion->prepare($instruction);
        if (!$query) {
           echo'Error al mostrar';
        } else {
            $query->execute();
            while ($r = $query->fetch()) {
                $result[] = $r;
            }
        }

        return $result;
    }
}
