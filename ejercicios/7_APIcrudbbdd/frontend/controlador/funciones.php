<?php
function conectar_endpoint($tipo, $url, $body = null)
{
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_URL, $url);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

    // Headers
    $headers = array(
        "Content-Type: application/json; charset=UTF-8"
    );
    curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curlHandle, CURLOPT_HEADER, false);

    // Configuración para DELETE
    if ($tipo == "DELETE") {
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE");
    }

    // Configuración para PUT
    if ($tipo == "PUT") {
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $body);
    }

    // Configuración para POST
    if ($tipo == "POST") {
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $body);
    }

    $response = curl_exec($curlHandle);
    curl_close($curlHandle);

    return $response;
}

