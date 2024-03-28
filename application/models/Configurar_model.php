<?php
class Configurar_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function buscarUsuario($dni, $id){
         $sql=$this->db
            ->select("*")
            ->from("usuarios usu")
            ->join('tipo_usuarios tus', 'usu.tipo_usuarios_tus_id = tus.tus_id')
            ->where(array("usu.usu_dni"=>$dni, 'usu.usu_id'=>$id))            
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();               
    }

    public function buscarPassAnterior($usuID, $dni){
        $sql=$this->db
            ->select("usu.usu_pass")
            ->from("usuarios usu")
            ->where(array("usu.usu_dni"=>$dni, 'usu.usu_id'=>$usuID ))                        
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();                   
    }

    public  function updateUsuario($data=array(), $id){         
        $this->db->where(array("usu_id"=>$id));
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();        
    }

    public function registrarFirmaUsuario($id, $filename)
    {

        $data = [
            'usu_firma' => $filename
        ];
        $this->db->where(array("usu_id" => $id));
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();
    }






}

?>