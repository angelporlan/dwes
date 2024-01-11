<?php

require_once('modelo/modelo.php');

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include "menu.php"?>

    <main>
    
    <table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php echo "<img src='bbdd/{$_SESSION['userObject']->imagen}' alt='Imagen de perfil'>"; ?>
            </td>
            <td><?php echo $_SESSION['userObject']->nombre; ?></td>
            <td><?php echo $_SESSION['userObject']->apellidos; ?></td>
            <td><?php echo $_SESSION['userObject']->email; ?></td>
        </tr>
    </tbody>
</table>

        
    </main>



<?php include "footer.php"?>

</body>
</html>
