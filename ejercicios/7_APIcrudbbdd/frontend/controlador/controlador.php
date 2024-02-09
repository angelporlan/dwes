<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = recoge('valor');
    if ($valor == 'POST') {
        $nombre = recoge('nombre');
        $apellidos = recoge('apellidos');

        $body = "{'nombre':'$nombre', 'apellidos':'$apellidos'}";

        //headers
        $headers = array(
            "X-Custom-Header: header-value",
            "Content-Type: application/json"
        );

        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, "http://127.0.0.1:8000/personas/");
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlHandle, CURLOPT_HEADER, false);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $body);
        
        // EXECUTE
        $response = curl_exec($curlHandle);

        //close the connections
        curl_close($curlHandle);

        echo $response;
    }
}

function recoge($var)
{
    if (isset($_REQUEST[$var])) {
        if ($_REQUEST[$var] != "") {
            $tmp = trim(htmlspecialchars(strip_tags($_REQUEST[$var])));
            return $tmp;
        }
    }
    return null;
}
// header("Location: ../anadir_persona.php");
?>
