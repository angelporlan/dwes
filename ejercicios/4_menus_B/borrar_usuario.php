<?php

$lista_usuarios = [];
$file = './bbdd/data.json';

$jsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);
$lista_usuarios = json_decode($jsonData);

$email = str_replace('%40', '@', $_GET['email']);

foreach ($lista_usuarios as $index => $user) {
    if ($user->email == $email) {
        unset($lista_usuarios[$index]);
        break;
    }
}

$json_usuarios = json_encode(array_values($lista_usuarios), JSON_PRETTY_PRINT);
file_put_contents("./bbdd/data.json", $json_usuarios);

header("Location: ./index.php");
?>
