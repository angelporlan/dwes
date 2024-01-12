<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php include "components/menu.php"?>

    <main>
        <?php
            $user_list = [];
            $file = 'data.json';
            $jsonData = file_get_contents("bbdd/{$file}");
            $user_list = json_decode($jsonData);
            echo "<h2>Usuarios dados de alta: " . count($user_list) . "</h2>";
        ?>
    </main>

    <?php include "components/footer.php"?>
</body>
</html>