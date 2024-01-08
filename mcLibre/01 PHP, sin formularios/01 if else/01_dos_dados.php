<?php

    print "<h1>DOS DADOS</h1>";
    print "<p>Actualice la página para mostrar una nueva tirada.</p>";

    $dado1 = random_int(1, 6);
    $dado2 = random_int(1, 6);
    
    print "<img src='img2/" . $dado1 . ".svg' />";
    print "<img src='img2/" . $dado2 . ".svg' />";

    if ($dado1 == $dado2) {
        print "<p>Has sacado pareja de $dado1.";
    }else{
        if ($dado1 > $dado2) {
            print "<p>No has sacado pareja, el valor mas alto es el $dado1.";
        }else{
            print "<p>No has sacado pareja, el valor mas alto es el $dado2.";
        }
    }
?>