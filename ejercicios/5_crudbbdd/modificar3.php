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
                $nombre = recoge('nombre');
                $apellidos = recoge('apellidos');
                $edad = recoge('edad');
                $pdo = conectaDb();
                $tabla = 'personas';

                session_start();
                $id = $_SESSION['id'];
    

                $consulta = "UPDATE $tabla
                SET nombre = :nombre, apellidos = :apellidos, edad = :edad
                WHERE id = $id;
                ";
                $resultado = $pdo->prepare($consulta);
                $resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos, ":edad" => $edad]);
                
                if (!$resultado) {
                    print "    <p>Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                } elseif ($resultado->rowCount() == 0) {
                    print "<p>0 registros encontrados</p>";
                } else {
                    print 'Datos actualizados';
                }
            }
        ?>
    </main>
    

    <?php
        pie();
    ?>
</body>

</html>
