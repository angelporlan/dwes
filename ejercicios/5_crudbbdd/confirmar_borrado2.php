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
            if (recoge('borrar') == 'No') {
                header("Location: index.php");
                exit();
            }
            $pdo = conectaDb();

            $consulta = "DROP DATABASE IF EXISTS $cfg[mysqlDatabase]";


            if (!$pdo->query($consulta)) {
                print "    <p>Error al borrar la base de datos. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Base de datos borrada correctamente.</p>\n";
            }

            $consulta = "CREATE DATABASE $cfg[mysqlDatabase]
                         CHARACTER SET utf8mb4
                         COLLATE utf8mb4_unicode_ci";


            if (!$pdo->query($consulta)) {
                print "    <p>Error al crear la base de datos. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Base de datos creada correctamente.</p>\n";
                $consulta = "USE $cfg[mysqlDatabase]";
            
                if (!$pdo->query($consulta)) {
                    print "<p>Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                } else {
                    print "<p>Base de datos seleccionada correctamente.</p>\n";
                } 
            }

            $consulta = "CREATE TABLE personas (
                id INTEGER UNSIGNED AUTO_INCREMENT,
                nombre VARCHAR(255),
                apellidos VARCHAR(255),
                edad INT UNSIGNED,
                PRIMARY KEY(id)
                )";

            if (!$pdo->query($consulta)) {
                print "    <p>Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                print "    <p>Tabla creada correctamente.</p>\n";
            }

            }
                ?>
        </main>

        <?php
        pie();
    ?>
</body>

</html>


