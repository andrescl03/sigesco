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
    public function request($method = 'GET', $url = '', $data = []) {
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

        if (strtolower($method) == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1); // Set the request method to POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Set POST data
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

}