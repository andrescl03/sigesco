<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MesaParteApi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Lima');
        $this->load->library('mesaparteservice');
    }

    public function vias() {

        /*return $this->output
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
        ));*/

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('GET', 'mpv/listar/vias', [], $this->mesaparteservice->token())));
    }  

    public function zonas() {

        /*return $this->output
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
        ));*/
        
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('GET', 'mpv/listar/zonas', [], $this->mesaparteservice->token())));
    }

    public function departamentos() {

        /*return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(
            json_decode('{
                "message": "OK",
                "response": [
                    {
                        "Departamento": "AMAZONAS"
                    },
                    {
                        "Departamento": "ANCASH"
                    },
                    {
                        "Departamento": "APURIMAC"
                    },
                    {
                        "Departamento": "AREQUIPA"
                    },
                    {
                        "Departamento": "AYACUCHO"
                    },
                    {
                        "Departamento": "CAJAMARCA"
                    },
                    {
                        "Departamento": "CUSCO"
                    },
                    {
                        "Departamento": "HUANCAVELICA"
                    },
                    {
                        "Departamento": "HUANUCO"
                    },
                    {
                        "Departamento": "ICA"
                    },
                    {
                        "Departamento": "JUNIN"
                    },
                    {
                        "Departamento": "LA LIBERTAD"
                    },
                    {
                        "Departamento": "LAMBAYEQUE"
                    },
                    {
                        "Departamento": "LIMA"
                    },
                    {
                        "Departamento": "LORETO"
                    },
                    {
                        "Departamento": "MADRE DE DIOS"
                    },
                    {
                        "Departamento": "MOQUEGUA"
                    },
                    {
                        "Departamento": "PASCO"
                    },
                    {
                        "Departamento": "PIURA"
                    },
                    {
                        "Departamento": "PROV. CONST. DEL CALLAO"
                    },
                    {
                        "Departamento": "PUNO"
                    },
                    {
                        "Departamento": "SAN MARTIN"
                    },
                    {
                        "Departamento": "TACNA"
                    },
                    {
                        "Departamento": "TUMBES"
                    },
                    {
                        "Departamento": "UCAYALI"
                    }
                ],
                "status": 200
            }')
        ));*/
        
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('GET', 'mpv/listar/departamentos', [], $this->mesaparteservice->token())));
    }

    public function provincias() {

        /* return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(
            json_decode('{
                "message": "OK",
                "response": [
                    {
                        "Provincia": "AIJA"
                    },
                    {
                        "Provincia": "ANTONIO RAYMONDI"
                    },
                    {
                        "Provincia": "ASUNCION"
                    },
                    {
                        "Provincia": "BOLOGNESI"
                    },
                    {
                        "Provincia": "CARHUAZ"
                    },
                    {
                        "Provincia": "CARLOS FERMIN FITZCARRALD"
                    },
                    {
                        "Provincia": "CASMA"
                    },
                    {
                        "Provincia": "CORONGO"
                    },
                    {
                        "Provincia": "HUARAZ"
                    },
                    {
                        "Provincia": "HUARI"
                    },
                    {
                        "Provincia": "HUARMEY"
                    },
                    {
                        "Provincia": "HUAYLAS"
                    },
                    {
                        "Provincia": "MARISCAL LUZURIAGA"
                    },
                    {
                        "Provincia": "OCROS"
                    },
                    {
                        "Provincia": "PALLASCA"
                    },
                    {
                        "Provincia": "POMABAMBA"
                    },
                    {
                        "Provincia": "RECUAY"
                    },
                    {
                        "Provincia": "SANTA"
                    },
                    {
                        "Provincia": "SIHUAS"
                    },
                    {
                        "Provincia": "YUNGAY"
                    }
                ],
                "status": 200
            }')
        ));*/
        
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('POST', 'mpv/listar/provinciaspordepartamento', $_POST, $this->mesaparteservice->token())));
    }

    
    public function distritos() {

        /*return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(
            json_decode('{
                "message": "OK",
                "response": [
                    {
                        "Distrito": "CACERES DEL PERU"
                    },
                    {
                        "Distrito": "CHIMBOTE"
                    },
                    {
                        "Distrito": "COISHCO"
                    },
                    {
                        "Distrito": "MACATE"
                    },
                    {
                        "Distrito": "MORO"
                    },
                    {
                        "Distrito": "NEPEÑA"
                    },
                    {
                        "Distrito": "NUEVO CHIMBOTE"
                    },
                    {
                        "Distrito": "SAMANCO"
                    },
                    {
                        "Distrito": "SANTA"
                    }
                ],
                "status": 200
            }')
        ));*/
        
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->mesaparteservice->request('POST', 'mpv/listar/distritosporprovincia', $_POST, $this->mesaparteservice->token())));
    }

}
