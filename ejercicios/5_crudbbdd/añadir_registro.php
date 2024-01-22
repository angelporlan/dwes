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
        <form action="añadir_registro2.php" method="post">
            <header>Registro de Usuario</header>
            <p>Nombre</p>
            <input type="text" name="nombre">
            <p>Apellidos</p>
            <input type="text" name="apellidos">
            <p>Edad</p>
            <input type="number" name="edad">

            <button>Enviar</button>
        </form>


    </main>

    <?php
    pie();
    ?>
</body>

</html>