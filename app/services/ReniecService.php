<?php

class ReniecService {

    public function validarDni($dni) {
        // EJEMPLO: API falsa, tú pondrás la real luego
        $url = "https://apireniec.fake/v1/dni/" . $dni;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
