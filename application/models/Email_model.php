<?php
/* 
    http://codeigniter.com/user_guide/libraries/email.html
    https://gist.github.com/as3eem/ca61926fd81363bfec9cb8aeb0830e1a
*/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Email_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('tools');
	}

    public function mail($args=[])
    {
        $rsp = $this->tools->responseDefault();
        try {
            
            $receivers = $args['receivers'];
            $subject = $args['subject'];
            $message = $args['message'];

            if (count($receivers) == 0){
                throw new Exception("No se registro ningún correo electronico");
            }

            $this->load->library("email");
            $this->email->set_crlf("\r\n");
            $config = array(
                'protocol' => 'smtp',
                // 'smtp_host' => 'smtp.office365.com',
                // 'smtp_host' =>  'ssl://smtp.mail.com',
                'smtp_host' =>  'smtp.gmail.com',
                'smtp_port' => 587,
                //'smtp_port' => 465,
                'smtp_timeout' => '5', //60
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'smtp_crypto' => 'tls',
                // '_smtp_auth' => TRUE,
                'smtp_user' => 'postulacioncdocenteugel05@gmail.com',
                'smtp_pass' => 'wiyhzxibhbfmjcou',
                'wordwrap' => TRUE,
                'newline' => "\r\n"
            );

            $this->email->initialize($config);
            $this->email->from('postulacioncdocenteugel05@gmail.com', 'PLATAFORMA REGISTRO DE CONTRATACIÓN DOCENTE');
            // $this->email->to('josearchivo01@gmail.com');
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->set_newline("\r\n");
    
            $this->email->to(implode(', ', $receivers));
            $this->email->send();

            $rsp['success'] = true;
            $rsp['message'] = 'Se envio correctamente a '.count($receivers).' usuarios';

        } catch (\Exception $e) {
            $rsp['message'] = $e->getMessage();
        }
        return $rsp;
    }

    public function test() 
    {
        $rsp = $this->tools->responseDefault();
        try {

            $this->load->library("email");
            $this->email->set_crlf("\r\n");

            $configOutlook = array(
                'protocol' => 'smtp',
                // 'smtp_host' => 'smtp.office365.com',
                // 'smtp_host' =>  'ssl://smtp.mail.com',
                'smtp_host' =>  'smtp.gmail.com',
                'smtp_port' => 587,
                //'smtp_port' => 465,
                'smtp_timeout' => '5', //60
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'smtp_crypto' => 'tls',
                // '_smtp_auth' => TRUE,
                'smtp_user' => $_ENV['SMTP_USER'],
                'smtp_pass' => $_ENV['SMTP_PASSWORD'],
                'wordwrap' => TRUE,
                'newline' => "\r\n"
            );

            $this->email->initialize($configOutlook);
            $this->email->from($_ENV['SMTP_USER'], 'PLATAFORMA CONVERSA');
            $this->email->to('josearchivo01@gmail.com');
            $this->email->subject('PRUEBA');
            $this->email->message('Hola Mundo');
            $this->email->set_newline("\r\n");
    
            $this->email->send();
            var_dump($this->email->print_debugger());
            /*for ($i = 1; $i <= 1; $i++) {
                if ($this->email->send()) {
                } else {
                    // show_error($this->email->print_debugger());
                }
                sleep(1);
            }*/

            /*if($this->email->send())
            {
                return true;
            }
            else
            {
                show_error($this->email->print_debugger());
            }*/
            /*
            foreach ($list as $address) {
    $email->setTo($address);
    $cid = $email->setAttachmentCID($filename);
    $email->setMessage('<img src="cid:'. $cid .'" alt="photo1" />');
    $email->send();
}
            */

            $rsp['success'] = true;
            $rsp['data'] = null;
            $rsp['message'] = 'Se envio correctamente';

        } catch (\Exception $e) {
            $rsp['message'] = $e->getMessage();
        }
        return $rsp;
    }

}