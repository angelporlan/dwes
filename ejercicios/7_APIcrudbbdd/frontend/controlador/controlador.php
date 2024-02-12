<?php
include_once("./funciones.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = recoge('valor');
    if ($valor == 'POST') {
        $nombre = recoge('nombre');
        $apellidos = recoge('apellidos');

        $body_array = array('nombre' => $nombre, 'apellidos' => $apellidos);
        $body = json_encode($body_array);

        $response = conectar_endpoint("POST", "http://127.0.0.1:8000/personas", $body);

        if ($response) {
            $response = json_decode($response);
            $_SESSION["mensajeAPI"]  = $response->mensaje;
            
        } else {
            $_SESSION["mensajeAPI"]  = "ERROR:No se ha podido insertar los datos";
        }
    }

    if ($valor == 'DELETE') {
        $id = recoge('idPersona');
        $body = '';

        $response = conectar_endpoint("DELETE", "http://127.0.0.1:8000/personas/$id", $body);

        if ($response) {
            $response = json_decode($response);
            $_SESSION["mensajeAPI"]  = $response->mensaje;
            
        } else {
            $_SESSION["mensajeAPI"]  = "ERROR:No se ha podido insertar los datos";
        }
    }

    if ($valor == 'PUT') {
        $id = recoge('idPersona');
        $nombre = recoge('nombre');
        $apellidos = recoge('apellidos');

        $body_array = array('nombre' => $nombre, 'apellidos' => $apellidos);
        $body = json_encode($body_array);
        
        $response = conectar_endpoint("PUT", "http://127.0.0.1:8000/personas/$id", $body);

        if ($response) {
            $response = json_decode($response);
            $_SESSION["mensajeAPI"]  = $response->mensaje;
            
        } else {
            $_SESSION["mensajeAPI"]  = "ERROR:No se ha podido insertar los datos";
        }
    }
}

function recoge($var)
{
    if (isset($_REQUEST[$var])) {
        if ($_REQUEST[$var] != "") {
            $tmp = trim(htmlspecialchars(strip_tags($_REQUEST[$var])));
            return $tmp;
        }
    }
    return null;
}
header("Location: ../anadir_persona.php");
?>
