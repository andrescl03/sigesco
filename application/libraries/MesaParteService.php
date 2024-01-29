<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class MesaParteService {

    /**
     * Url base of API
     */
    function uri() {
        return trim(load_class('Config')->config['url_api']);
    }

    /**
     * (String) Method
     * (String) Url
     * (Array)  Data
     */
    public function request($method = 'GET', $url = '', $data = [], $token = null, $fileupload = false) {
        // url request
        $url = $this->uri() . trim($url);

        // Initialize cURL session
        $ch = curl_init();

        // Check if cURL initialization was successful
        if ($ch === false) {
            throw new Exception('cURL initialization failed');
        }

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url); // URL to fetch
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response as a string
        curl_setopt($ch, CURLOPT_HEADER, 0); // Don't include the header in the output

        if ($token) {
            $contenttype = $fileupload ? 'multipart/form-data' : 'application/json';
            // Encabezados de la solicitud
            $headers = array(
                'Content-Type: ' . $contenttype,
                'Authorization: Bearer ' . $token // Reemplaza "TU_TOKEN_AQUI" con tu token de portador real
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if (strtolower($method) == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1); // Set the request method to POST
            if ($fileupload) { 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            } else {
                $headers = array(
                    'Content-Type: application/json',
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Set POST data
            }
        }

        // Execute cURL session and fetch response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        // Close cURL session
        curl_close($ch);

        // Process the response
        return json_decode($response, true);
    }

    public function token() {
        $data = [
            "username"=> "abluis15",
            "password"=> "123456"
        ];
        $response = $this->request('POST', 'auth/', $data);
        return $response['success'] ? $response['token'] : null;
    }

}