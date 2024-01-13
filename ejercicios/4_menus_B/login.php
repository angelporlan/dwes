<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <form action="controlador/procesar_login.php" method="post">
            <header>Log in de usuarios</header>
            <label>Usuario: </label>
            <input type="text" name="email">
            <label>*Contraseña: </label>
            <input type="password" name="password">
            
            <?php
                if (isset($_SESSION['errorLogin'])) {
                    echo "<p>" . $_SESSION['errorLogin'] . "</p>";
                    unset($_SESSION['errorLogin']);
                }
            ?>
            <button>Log In</button>

        </form>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>