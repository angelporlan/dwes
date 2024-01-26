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
                $persona = recoge('persona');
                $pdo = conectaDb();
                $tabla = 'personas';
                session_start();
                $_SESSION['id'] = $persona;

                $consulta = "SELECT * FROM $tabla WHERE id = " . $persona;
                $resultado = $pdo->query($consulta);
                
                if (!$resultado) {
                    print "    <p>Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                } elseif ($resultado->rowCount() == 0) {
                    print "<p>0 registros encontrados</p>";
                } else {
                    $resultado = $resultado->fetch();
                    echo "<form action='modificar3.php' method='post'>";
                    print "      <tr>\n";
                    print "        <td><strong>ID: $resultado[id]</strong></td>\n";
                    print "        <td><strong>Nombre: </strong><input type='text' value='$resultado[nombre]' name='nombre'></td>\n";
                    print "        <td><strong>Apellidos: </strong><input type='text' value='$resultado[apellidos]' name='apellidos'></td>\n";
                    print "        <td><strong>Edad: </strong><input type='text' value='$resultado[edad]' name='edad'></td>\n";
                    print "      </tr>\n";
                    echo "<button>Actualizar</button>";
                    echo "</form>";
                }
            }
        ?>
    </main>
    

    <?php
        pie();
    ?>
</body>

</html>
