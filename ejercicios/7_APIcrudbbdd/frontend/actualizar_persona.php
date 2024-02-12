

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, tr, td, tbody, thead, th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<?php

session_start();

include "components/menu.php";

?>



<form action="controlador/controlador.php" method="post">
    <header>Actualizar Persona</header>
    <input type="number" name="idPersona">
    <input type="text" name="nombre" placeholder="nombre">
    <input type="text" name="apellidos" placeholder="apellidos">
    <button name="valor" value="PUT">Enviar</button>
    <?php
        if (isset($_SESSION['mensajeAPI'])){
            echo "<p>$_SESSION[mensajeAPI]</p>";
            unset($_SESSION['mensajeAPI']);
        }
    ?>
</form>


</body>
</html>



