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
    <form action="borrado2.php" method="post">
    <?php
            $pdo = conectaDb();    
            $tabla = "personas";
            $consulta = "SELECT * FROM $tabla";
            $resultado = $pdo->query($consulta);
            if (!$resultado) {
                print "    <p>Crea la base de datos para continuar</p>\n";
            } elseif ($resultado->rowCount() == 0) {
                print "<p>0 registros encontrados</p>";
            } else {

                print "<p>" . $resultado->rowCount() . " registros encontrados</p>";
                print "    <table>\n";
                print "      <thead>\n";
                print "        <tr>\n";
                print "          <th>.</th>\n";
                print "          <th>ID</th>\n";
                print "          <th>Nombre</th>\n";
                print "          <th>Apellidos</th>\n";
                print "          <th>Edad</th>\n";
                print "        </tr>\n";
                print "      </thead>\n";

                    foreach ($resultado as $registro) {
        print "      <tr>\n";
        print '        <td> <input type="checkbox" name="persona[]" value=" ' . $registro['id'] . '"/></td>';
        print "        <td>$registro[id]</td>\n";
        print "        <td>$registro[nombre]</td>\n";
        print "        <td>$registro[apellidos]</td>\n";
        print "        <td>$registro[edad]</td>\n";
        print "      </tr>\n";
    }
    print "    </table>\n";

            ?>
                
                    <button>Eliminar</button>
                </form>
            <?php
            }

        ?>

    </main>

    <?php
    pie();
    ?>
</body>

</html>