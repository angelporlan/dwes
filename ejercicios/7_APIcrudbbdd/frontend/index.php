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

$listaPersonas = json_decode(file_get_contents("http://127.0.0.1:8000/personas/"));


echo "<table>";
echo "<thead>";
echo "<th>Id</th>";
echo "<th>Nombre</th>";
echo "<th>Apellidos</th>";
echo "</thead>";
echo "<tbody>";
foreach ($listaPersonas as $persona) {
    echo "<tr>";
    echo "<td>$persona->id</td>";
    echo "<td>$persona->nombre</td>";
    echo "<td>$persona->apellidos</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>

</body>
</html>



