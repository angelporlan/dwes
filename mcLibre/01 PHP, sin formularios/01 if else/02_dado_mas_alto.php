<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .tablero {
            display: flex;
        }
    </style>
</head>
<body>
    <?php
        echo "<h1>JUEGO: DADO MÁS ALTO</h1>";
        echo "<p>Actualice la página para mostrar una nueva tirada.</p>";
        $dado1 = random_int(1, 6);
        $dado2 = random_int(1, 6);
        $resultado = '';
        if ($dado1 > $dado2) {
            $resultado = "Ha ganado jugador 1";
        }else {
            $resultado = "Ha ganado jugador 2";
        }
        $jugador1 = "<div class='tablero'><div><h2>Jugador1</h2><img src='img2/". $dado1 . ".svg' /></div><div><h2>Jugador2</h2><img src='img2/". $dado2 . ".svg' /></div><div><h2>Resultado</h2><p>$resultado</p></div></div>";
        echo "$jugador1";
?>  
</body>
</html>