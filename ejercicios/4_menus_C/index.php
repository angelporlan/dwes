<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <header>
        <?php
            $user_list = [];
            $file = 'data.json';
            $jsonData = file_get_contents("bbdd/{$file}");
            $user_list = json_decode($jsonData);
            echo "<h2>Usuarios dados de alta: " . count($user_list) . "</h2>";
            
            if (isset($_COOKIE['last_user'])) {
                $cookieData = json_decode($_COOKIE['last_user']);

                echo "Último usuario de alta: " . $cookieData[0] . " el día " . $cookieData[1] . " a las " . $cookieData[2];
            }
        ?>
        </header>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>