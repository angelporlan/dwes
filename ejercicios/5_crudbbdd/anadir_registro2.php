<?php

require_once("funciones.php");

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>BBDD - Borrar y crear</title>
</head>

<body>
    <?php
        cabecera("Inicio", 'MENU_VOLVER');
    ?>
    
    <main>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $nombre = recoge("nombre");
            $apellidos = recoge("apellidos");
            $edad = recoge("edad");

            if ($nombre == '' || $apellidos == '' || $edad == '') {
                echo 'Todas las casillas deben ser rellenadas';
                exit();
            }

            $pdo = conectaDb();

            $consulta = "INSERT INTO personas (nombre, apellidos, edad) VALUES (:nombre, :apellidos, :edad)";

            $resultado = $pdo->prepare($consulta);

            if (!$resultado) {
                print "    <p>Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } elseif (!$resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":edad" => intval($edad)])) {
                print "    <p>Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Registro creado correctamente.</p>\n";
            }
        }

    ?>

    </main>

    <?php
        pie();
    ?>
</body>

</html>