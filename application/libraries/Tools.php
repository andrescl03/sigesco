<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Tools {

    public function responseDefault()
    {
        return ['success' => false, 'data' => null, 'message' => 'Este servicio no se encuentra disponible en estos instantes. Inténtelo más tarde.', 'status' => 500];
    }

    public function _crypt($string)
    {
        return crypt($string, '$2a$09$tARm1a9A9N7q1W9T9n5LqR$');
    }

    public function getFieldArray($files = [], $fields = [], $index) {
        $file = array();
        foreach ($fields as $key => $field) {
            $file[$field] = $files[$field][$index];
        }
        return $file;
    }

    public function getDateHour($format = "Y-m-d H:i:s") {
        date_default_timezone_set('America/Lima');
        $fecha = date($format);
        return $fecha;
    }

}