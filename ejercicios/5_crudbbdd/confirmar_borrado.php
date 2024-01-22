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
        <form action="confirmar_borrado2.php" method="post">
            <p>¿Está seguro de borrar la base de datos?</p>
            <button type="submit" name="borrar" value="Si">Si</button>
            <button type="submit" name="borrar" value="No">No</button>
        </form>


    </main>

    <?php
    pie();
    ?>
</body>

</html>