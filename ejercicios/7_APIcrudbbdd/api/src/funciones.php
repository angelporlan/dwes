<?php

require_once("config.php");

//Esta funcion me devuelve el PDO
function conectaDb()
{
    global $cfg;

    try {
        //Conecto a una bbdd concreta
        $tmp = new PDO("mysql:host=$cfg[mysqlHost];dbname=$cfg[mysqlDatabase];charset=utf8mb4", $cfg["mysqlUser"], $cfg["mysqlPassword"]);
    } catch (PDOException $e) {
        //Conecto pero sin escoger la bbdd. Por ejemplo, si voy a crearla
        $tmp = new PDO("mysql:host=$cfg[mysqlHost];charset=utf8mb4", $cfg["mysqlUser"], $cfg["mysqlPassword"]);
    } catch (PDOException $e) {
        //print "    <p>Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        return null;
        //exit;
    } finally {
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        return $tmp;
    }
}

function obtenerPersonasBBDD() {
    global $cfg;
    global $pdo;
    // $pdo = conectaDb();
    $consulta = "SELECT * FROM $cfg[nombretabla]";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        return null;
    } else {

        $listaPersonas = array(); //array con los datos

        //Creo un array de arrais asociativos. 
        foreach ($resultado as $registro) {
            $persona = array(
                "id" => $registro["id"],
                "nombre" => $registro["nombre"],
                "apellidos" => $registro["apellidos"]          
            );
            array_push($listaPersonas, $persona);
        }
        return $listaPersonas;
    }
}


function obtenerPersonaBBDD($id) {
    global $cfg;
    global $pdo;
    // $pdo = conectaDb();
    $consulta = "SELECT * FROM $cfg[nombretabla] WHERE id =$id";
}

function añadirPersonaBBDD($persona){
    global $cfg;
    global $pdo;

    if ($pdo != null) {
        $consulta = "INSERT INTO $cfg[nombretabla] (`nombre`, `apellidos`) VALUES (:nombre_, :apellidos_)";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            return false;
        } elseif (!$resultado->execute([
            ":nombre_" => $persona["nombre"],
            ":apellidos_" => $persona["apellidos"]
        ])) {
            return false;
        } else {
            // Inserción OK
            return true;
        }
    } else {
        // $pdo es null
        return false;
    }
}

function borrarPersonaBBDD($id) {
    global $cfg;
    global $pdo;

    if ($pdo != null) {

        $consulta = "DELETE FROM $cfg[nombretabla]
        WHERE id = :indice";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            return false;
        } elseif (!$resultado->execute([
            ":indice" => $id
        ])) {
            return false;
        } else {
            //Insercion OK
            return true;
            $pdo = null;
        }
    } else {
        //$pdo es null
        return false;
    }
}


function editarPersonaBBDD($persona, $id){
    global $cfg;
    global $pdo;

    if ($pdo != null) {

        $consulta = "UPDATE $cfg[nombretabla]
        SET `nombre` = :nombre_, `apellidos` = :apellidos_ 
        WHERE `id` = $id;";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            return false;
        } elseif (!$resultado->execute([
            ":nombre_" => $persona["nombre"],
            ":apellidos_" => $persona["apellidos"]
        ])) {
            return false;
        } else {
            //Insercion OK
            return true;
            $pdo = null;
        }
    } else {
        //$pdo es null
        return false;
    }


        $listaPersonas = array(); //array con los datos

        //Creo un array de arrais asociativos. 
        foreach ($resultado as $registro) {
            $persona = array(
                "id" => $registro["id"],
                "nombre" => $registro["nombre"],
                "apellidos" => $registro["apellidos"]          
            );
            array_push($listaPersonas, $persona);
        }
        return $listaPersonas;
    }
