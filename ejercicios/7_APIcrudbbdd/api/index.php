<?php
require_once("./src/funciones.php");

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");
//header("Content-Type: text/plain; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($uri[1] !== 'personas') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// Miramos a ver si hay userid en el endpoint
$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
}



switch ($requestMethod) {
    case 'GET':
        if ($userId != null) {
            $pdo = conectaDb();
            $listaEmpleados = obtenerPersonaBBDD($userId);

            if ($listaEmpleados == null) {
                header("HTTP/1.1 500 Internat Server Error");
                exit();
            }

            $respuesta = $listaEmpleados;
            header("HTTP/1.1 200");
            echo json_encode($respuesta);
            exit();
        } else {
            //-------------------------------
            //Endpoint    /empleados/
            //-------------------------------
            //Pedir la lista de empleados a la bbdd
            $pdo = conectaDb();
            $listaEmpleados = obtenerPersonasBBDD();

            //Debug-----
            //print_r($listaEmpleados);
            //------------

            if ($listaEmpleados == null) {
                header("HTTP/1.1 500 Internat Server Error");
                exit();
            }

            $respuesta = $listaEmpleados;
            header("HTTP/1.1 200");
            echo json_encode($respuesta);
            exit();
        }

    case 'POST':
        //-------------------------------
        //Endpoint POST /empleados/
        //-------------------------------
        $data = (array) json_decode(file_get_contents('php://input'), TRUE);

        //Añadir datos a la bbdd
        $pdo = conectaDb();
        $insercionOK = añadirPersonaBBDD($data);
        if ($insercionOK) {
            $respuesta = ['mensaje' => "Persona añadida."];
            header("HTTP/1.1 201");
            echo json_encode($respuesta);
            exit();
        } else {
            $respuesta = ['mensaje' => 'Error al añadir persona.'];
            header("HTTP/1.1 500");
            echo json_encode($respuesta);
            exit();
        }
        break;

    case 'DELETE':
        //-------------------------------
        //Endpoint DELETE /empleados/X
        //-------------------------------
        if ($userId == null) {
            header("HTTP/1.1 404 Not Found");
            exit();
        } else {
            $pdo = conectaDb();
            $borrarOK = borrarPersonaBBDD($userId);

            if ($borrarOK) {
                $respuesta = ['mensaje' => "Persona borrado."];
                header("HTTP/1.1 200 OK");
                echo json_encode($respuesta);
                exit();
            } else {
                $respuesta = ['mensaje' => 'Error al borrar persona.'];
                header("HTTP/1.1 500");
                echo json_encode($respuesta);
                exit();
            }
        }
        break;

    case 'PUT':
        if ($userId == null) {
            header("HTTP/1.1 404 Not Found");
            exit();
        } else {
            $data = (array) json_decode(file_get_contents('php://input'), TRUE);
    
            // Editar datos en la bbdd
            $pdo = conectaDb();
            $edicionOK = editarPersonaBBDD($data, $userId);
            if ($edicionOK) {
                $respuesta = ['mensaje' => "Persona editada."];
                header("HTTP/1.1 200 OK");
                echo json_encode($respuesta);
                exit();
            } else {
                $respuesta = ['mensaje' => 'Error al editar persona.'];
                header("HTTP/1.1 500");
                echo json_encode($respuesta);
                exit();
            }
        }
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}
