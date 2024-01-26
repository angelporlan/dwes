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
                $pdo = conectaDb();
                $nombre = recoge('nombre');
                $apellidos = recoge('apellidos');
                $tabla = 'personas';
                $resultado = null;
                $consulta = '';

                if ($nombre == null && $apellidos == null) {
                    $consulta = "SELECT * FROM $tabla";
                    $resultado = $pdo->query($consulta);

                } elseif (isset($nombre) && $apellidos == null) {
                    $consulta = "SELECT * FROM $tabla WHERE nombre = :nombre";
                    $resultado = $pdo->prepare($consulta);
                    $resultado->execute([":nombre" => $nombre]);
                } elseif (isset($apellidos) && $nombre == null) {
                    $consulta = "SELECT * FROM $tabla WHERE apellidos = :apellidos";
                    $resultado = $pdo->prepare($consulta);
                    $resultado->execute([":apellidos" => $apellidos]);
                } else {
                    $consulta = "SELECT * FROM $tabla WHERE nombre = :nombre AND apellidos = :apellidos";
                    $resultado = $pdo->prepare($consulta);
                    $resultado->execute([":nombre" => $nombre, ":apellidos" => $apellidos]);
                }

                if (!$resultado) {
                    print "    <p>Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                } elseif ($resultado->rowCount() == 0) {
                    print "<p>0 registros encontrados</p>";
                } else {
                
                    print "<p>" . $resultado->rowCount() . " registros encontrados</p>";
                    print "    <table>\n";
                    print "      <thead>\n";
                    print "        <tr>\n";
                    print "          <th>ID</th>\n";
                    print "          <th>Nombre</th>\n";
                    print "          <th>Apellidos</th>\n";
                    print "          <th>Edad</th>\n";
                    print "        </tr>\n";
                    print "      </thead>\n";
                
                    foreach ($resultado as $registro) {
                        print "      <tr>\n";
                        print "        <td>$registro[id]</td>\n";
                        print "        <td>$registro[nombre]</td>\n";
                        print "        <td>$registro[apellidos]</td>\n";
                        print "        <td>$registro[edad]</td>\n";
                        print "      </tr>\n";
                    }
                    print "    </table>\n";
                }


            }
        ?>
    

    </main>

    <?php
    pie();
    ?>
</body>

</html>