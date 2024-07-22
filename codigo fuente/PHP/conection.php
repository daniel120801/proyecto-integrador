<?php

class BD_PDO
{
    public function exec_instruction($instruction)
    {

        $host = 'localhost';
        $usr = 'root';
        $pwd = '';
        $db = 'db_sushi';

        try {
            $conexion = new PDO("mysql:host=$host;dbname=$db;", $usr, $pwd);
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Failed to get DB handle: ' . $e->getMessage();
            exit;
        }

        // Asignando una instruccion sql

        $result = null;
        $query = $conexion->prepare($instruction);
        if (!$query) {
            echo 'Error al mostrar';
        } else {
            $query->execute();
            while ($r = $query->fetch()) {
                $result[] = $r;
            }
        }

        return $result;
    }
    function ListarCategorias($instruccion_sql, $llave_foranea)
    {
        $datos = $this->exec_instruction($instruccion_sql);

        $cadena = "";
        foreach ($datos as $renglon) {
            if (isset($renglon["PK_categoria"]) && isset($renglon["nombre_categoria"])) {
                $cadena .= '<option value="' . $renglon["PK_categoria"] . '" ';

                if ($llave_foranea == $renglon["PK_categoria"]) {
                    $cadena .= 'selected';
                }
                $cadena .= '>' . $renglon["nombre_categoria"] . '</option>';
            } else {
                error_log('Índices no definidos en el array $renglon');
            }
        }
        return $cadena;
    }
}
