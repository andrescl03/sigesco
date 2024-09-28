<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mesaparteapi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->load->model('Ubigeo_model');
        $this->load->library('mesaparteservice');
    }

    public function vias() {

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(
            json_decode('{
                "message": "OK",
                "response": [
                    {
                        "DesTipoVia": "AVENIDA",
                        "TipoViaID": 1
                    },
                    {
                        "DesTipoVia": "JIRÓN",
                        "TipoViaID": 2
                    },
                    {
                        "DesTipoVia": "CALLE",
                        "TipoViaID": 3
                    },
                    {
                        "DesTipoVia": "PASAJE",
                        "TipoViaID": 4
                    },
                    {
                        "DesTipoVia": "CARRETERA",
                        "TipoViaID": 5
                    },
                    {
                        "DesTipoVia": "PROLONGACIÓN",
                        "TipoViaID": 6
                    }
                ],
                "status": 200
            }')
        ));

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('GET', 'mpv/listar/vias', [], $this->mesaparteservice->token())));
    }  

    public function zonas() {

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(
            json_decode('{
                "message": "OK",
                "response": [
                    {
                        "DesTipoZona": "URBANIZACIÓN",
                        "TipoZonaID": 1
                    },
                    {
                        "DesTipoZona": "PUEBLO JOVEN",
                        "TipoZonaID": 2
                    },
                    {
                        "DesTipoZona": "UNIDAD VECINAL",
                        "TipoZonaID": 3

                    },
                    {
                        "DesTipoZona": "CONJUNTO HABITACIONAL",
                        "TipoZonaID": 4
                    },
                    {
                        "DesTipoZona": "ASENTAMIENTO HUMANO",
                        "TipoZonaID": 5
                    },
                    {
                        "DesTipoZona": "COOPERATIVA",
                        "TipoZonaID": 6
                    },
                    {
                        "DesTipoZona": "RESIDENCIAL",
                        "TipoZonaID": 7
                    },
                    {
                        "DesTipoZona": "ZONA INDUSTRIAL",
                        "TipoZonaID": 8
                    },
                    {
                        "DesTipoZona": "CENTRO POBLADO",
                        "TipoZonaID": 9
                    },
                    {
                        "DesTipoZona": "CASERÍO",
                        "TipoZonaID": 10
                    },
                    {
                        "DesTipoZona": "ASOCIACIÓN",
                        "TipoZonaID": 11
                    },
                    {
                        "DesTipoZona": "GRUPO",
                        "TipoZonaID": 12
                    },
                    {
                        "DesTipoZona": "FUNDO",
                        "TipoZonaID": 13
                    },
                    {
                        "DesTipoZona": "OTROS",
                        "TipoZonaID": 14
                    }
                ],
                "status": 200
            }')
        ));
        
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('GET', 'mpv/listar/zonas', [], $this->mesaparteservice->token())));
    }

    public function departamentos() {


        $departments = $this->Ubigeo_model->getDepartamentos();
        $data = [
            "message" => "OK",
            "response" => $departments,
            "status" => 200
        ];

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function provincias()
    {

        $idDepartamento = $_POST['Departamento'];

        $provinces = $this->Ubigeo_model->getProvincias($idDepartamento);

        $data = [
            "message" => "OK",
            "response" => $provinces,
            "status" => 200
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }


    public function distritos() {

        $idProvince = $_POST['Provincia'];
       
        $districts = $this->Ubigeo_model->getDistritos($idProvince);

        $data = [
            "message" => "OK",
            "response" => $districts,
            "status" => 200
        ];

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function procesarexpedientes()
    {
        $this->load->model("postulaciones_model");

        log_message_ci("Ingresa a procesarexpedientes");

        $con_id  = $this->input->post("con_id", true);
        $actualizacionesCounter = 0;
        $actualizacionesNoCounter = 0;

        $postulantes = $this->postulaciones_model->buscarDocentesXConvocatoria($con_id);

        foreach ($postulantes as $postulante) {

            if (!$postulante->numero_expediente) {

                $uid = $postulante->uid;
                $postulacion_id = $postulante->id;

                $requestBody = array(
                    "codigoTramite" => $uid
                );

                $response = $this->mesaparteservice->request('POST', 'expedientesmpv/buscar/porcodigotramite', $requestBody, $this->mesaparteservice->token());

                if (isset($response['response']['numeroExpediente'])) {
                    log_message_ci("Ingresa a procesarexpedientes - procesa " . json_encode($postulante));

                    $numero_expediente = $response['response']['numeroExpediente'];

                    $this->postulaciones_model->updateExpedienteXPostulante($postulacion_id, $numero_expediente);

                    $actualizacionesCounter++;
                } else {

                    $actualizacionesNoCounter++;
                    log_message_ci("Ingresa a procesarexpedientes - no procesa " . json_encode($postulante));
                }
            }
        }

        $responsejson = [
            "message" => "OK",
            "response" => [
                "cantidad_procesados"  => $actualizacionesCounter,
                "cantidad_no_procesados" => $actualizacionesNoCounter

            ],
            "status" => 200
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($responsejson));
    }


}