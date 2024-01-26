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
                $personas = isset($_POST['persona']) ? $_POST['persona'] : array();
            
                if (!empty($personas)) {
                    $pdo = conectaDb();    
                    $tabla = "personas";
                    
                    foreach($personas as $persona) {
                        $consulta = "DELETE FROM $tabla WHERE ID = {$persona}";

                        $resultado = $pdo->query($consulta);

                        if (!$resultado) {
                            print "<p>Hubo un error</p>";
                        } else {
                            print "<p>Usuario con id {$persona} borrado correctamente</p>";
                        }
                    }
                } else {
                    print "<p>No se seleccionaron usuarios para borrar.</p>";
                }
            }
        ?>
    </main>

    <?php
        pie();
    ?>
</body>

</html>
