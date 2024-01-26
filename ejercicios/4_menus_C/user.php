<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <?php
        $name = $_SESSION['userLogin']->name;
        $lastname = $_SESSION['userLogin']->lastname;
        $email = $_SESSION['userLogin']->email;
        $imgRoot = "./bbdd/" . $_SESSION['userLogin']->img;
        ?>

        <div class="container">
                <?php
                echo "<img src='" . $imgRoot ."'>";
                if ($name == null && $lastname == null) {
                    echo "<p class='name'>" . $email . "</p>";
                } else {
                    echo "<p class='name'>" . $name . " " . $lastname . "</p>";
                }
                ?>
        </div>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>