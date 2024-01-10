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
    <?php
        $user_list = [];
        $file = 'data.json';
        $jsonData = file_get_contents("bbdd/{$file}");
        $user_list = json_decode($jsonData);
        echo ("<h2>Total de usuarios de alta: " . count($user_list) . "</h2>");
        echo ("<p>Mostraremos la fecha y hora del ultimo usuario con cookey");
        session_start();
        echo "<pre>";
print_r($_SESSION);
echo "</pre>";
        ?>

        
    </main>



<?php include "footer.php"?>

</body>
</html>
