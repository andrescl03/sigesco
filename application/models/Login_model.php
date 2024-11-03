<?php
class Login_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function validar($usuario, $pass){
      $sql=$this->db
        ->select("usu.usu_id, usu.usu_dni, usu.usu_pass, usu.usu_nombre, usu.usu_apellidos, usu.usu_estado, usu.tipo_usuarios_tus_id, tu.tus_usuariodescrip")
        ->join('tipo_usuarios tu','tu.tus_id=usu.tipo_usuarios_tus_id')
        ->from("usuarios usu")        
        ->where(array("usu.usu_dni"=>$usuario,"usu.usu_pass"=>$pass, "usu.usu_estado"=>1))       
         //->where(array("usu.usu_dni"=>$usuario, "usu.usu_estado"=>1))       
        ->get();
       // echo $this->db->last_query(); exit(); 
        return $sql->row();
    }

    public function modulos($user,$estado){
        $query=$this->db
            ->select("*")
            ->from("modulos as m")
            ->join('permisos as p','p.modulos_mdl_id=m.mdl_id', 'inner')
            ->join('tipo_usuarios as tu','tu.tus_id=p.tipo_usuarios_tus_id', 'inner')
            ->join('usuarios as u','u.tipo_usuarios_tus_id=tu.tus_id', 'inner')
            ->where(array("u.usu_id"=>$user,"u.usu_estado"=>$estado,"m.mdl_estado"=>1,"p.per_estado"=>1, "tu.tus_estado"=>1))
            ->order_by("m.mdl_orden", "asc")
            ->get();
         
            $result = $query->result();
            if($result){
               /*foreach ($result as $item){
                    if($item->hijo_de == $item->cod_modulo){
                        echo "item";
                    }
                }*/
                return $result;
            }else{
                return false;
            }
    }



/**
 * ========================================================================================================================
 * ========================================================================================================================
 * 											LOGIN CONSULTAS
 * ======================================================================================================================== 
 */
    

    public function validarConsultas($usuario, $pass){
        $sql=$this->db
        ->select("urep.urep_id, urep.urep_usuario")     
        ->from("usuarios_reportes urep")        
        ->where(array("urep.urep_usuario"=>$usuario,"urep.urep_password"=>$pass, "urep.urep_estado"=>1))       
        ->get();
        // echo $this->db->last_query(); exit(); 
        return $sql->row();
    }



    


}