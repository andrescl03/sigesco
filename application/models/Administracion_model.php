<?php
class Administracion_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function buscar_tusuarios(){
         $sql=$this->db
            ->select("tus.*, count(usu_nombre) as total")
            ->from("tipo_usuarios tus")            
            ->join('usuarios usu', 'usu.tipo_usuarios_tus_id = tus.tus_id','left')
            ->where(array("tus.tus_flag"=>1,"tus.tus_estado"=>1))           
            ->group_start()         
                ->where(array("usu.usu_estado"=>1))
                ->or_where('usu.usu_estado',null)
            ->group_end()             
            ->group_by(array("tus.tus_id", "tus.tus_usuariodescrip")) 
            ->order_by('tus_usuariodescrip asc')               
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();               
    }

    public function buscar_tusuariosActivos(){
         $sql=$this->db
            ->select("tus_id, tus_usuariodescrip, tus_estado")
            ->from("tipo_usuarios")
            ->where(array("tus_flag"=>1, "tus_estado"=>1))              
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();               
    }

    
    public function buscarTusuarioxDescrip($desc){
         $sql=$this->db
            ->select("tus_id, tus_usuariodescrip, tus_estado")
            ->from("tipo_usuarios")
            ->where(array("tus_flag"=>1, "tus_usuariodescrip"=>$desc))              
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();               
    }


    
    public function agregar_Tusuario($data=array()){
        $this->db->insert('tipo_usuarios',$data);
        return $this->db->insert_id(); // para saber el id ingresado
    } 

    public function buscar_tusuariosxId($tus_id){
         $sql=$this->db
            ->select("tus_id, tus_usuariodescrip, tus_estado")
            ->from("tipo_usuarios")
            ->where(array("tus_flag"=>1, "tus_id"=>$tus_id))              
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();               
    }

    public  function updateTusuarios($data=array(), $id){         
        $this->db->where(array("tus_id"=>$id));
        $this->db->update('tipo_usuarios', $data);
        return $this->db->affected_rows();        
    } 
    



////===============================================
    public function buscar_usuarios(){
         $sql=$this->db
            ->select("usu.usu_id, usu.usu_nombre, usu.usu_apellidos, usu.usu_dni, usu.usu_estado, tus.tus_usuariodescrip, tus.tus_estado")
            ->from("usuarios usu")
            ->join('tipo_usuarios tus', 'usu.tipo_usuarios_tus_id = tus.tus_id')
            ->where(array('tus.tus_flag'=>1, 'usu.usu_flag'=>1 ))             
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();                
    }


    public function buscar_tusuariosOtro(){
         $sql=$this->db
            ->select("tus_id, tus_usuariodescrip, tus_estado")
            ->from("tipo_usuarios")
            ->where(array("tus_estado"=>1,'tus_flag'=>1))             
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();               
    }

    public function buscar_usuariosOtro($dni){
        $sql=$this->db
            ->select("usu.usu_id")
            ->from("usuarios usu")
            ->where(array("usu.usu_dni"=>$dni, 'usu.usu_flag'=>1 ))                        
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();                   
    }

    public function agregar_Usuario($data=array()){
        $this->db->insert('usuarios',$data);
        return $this->db->insert_id(); // para saber el id ingresado
    }
    
    public function buscar_usuariosId($id){
        $sql=$this->db
            ->select("usu.usu_id, usu.usu_nombre, usu.usu_apellidos, usu.usu_dni, usu.usu_estado, tipo_usuarios_tus_id")
            ->from("usuarios usu")
            ->where(array("usu.usu_id"=>$id))                        
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();                   
    }

    public  function updateUsuario($data=array(), $id){         
        $this->db->where(array("usu_id"=>$id));
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows();        
    } 

////===============================================
    public function buscar_modulos(){
         $sql=$this->db
            ->select("modu.mdl_id, modu.mdl_nombre, modu.mdl_ruta, modu.mdl_icono,modu.mdl_hijode, mdl.mdl_nombre as hijo, modu.mdl_estado, modu.mdl_orden")
            ->from("modulos modu")
            ->join('modulos mdl', 'modu.mdl_hijode=mdl.mdl_id','left')
            ->where(array("modu.mdl_flag"=>1)) 
            ->order_by('modu.mdl_orden asc')             
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();                
    }

    public function buscar_modulosPadre(){
         $sql=$this->db
            ->select("mdl_id, mdl_nombre")
            ->from("modulos")
            // ->where(array("mdl_flag"=>1,"mdl_hijode"=>0, "mdl_estado"=>1))             
            ->where(array("mdl_flag"=>1,"mdl_ruta"=>"", "mdl_estado"=>1))
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();                
    }
    
    public function agregar_Modulo($data=array()){
        $this->db->insert('modulos',$data);
        return $this->db->insert_id(); // para saber el id ingresado
    }

    public  function updateModulo($data=array(), $id){         
        $this->db->where(array("mdl_id"=>$id));
        $this->db->update('modulos', $data);
        return $this->db->affected_rows();        
    } 

    public  function updateModuloxEstado($data=array(), $id){         
        $this->db->where(array("mdl_hijode"=>$id));
        $this->db->update('modulos', $data);
        return $this->db->affected_rows();        
    } 
    

   public function buscar_permisos($tusuario,$modulo){
         $sql=$this->db
            ->select("tipo_usuarios_tus_id, modulos_mdl_id, per_estado, per_flag")
            ->from("permisos")
            ->where(array("per_flag"=>1,"tipo_usuarios_tus_id"=>$tusuario,"modulos_mdl_id"=>$modulo))           
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();                
    }

    public function insertarPermisos($data) {
        $this->db->insert_batch('permisos',$data);      
        return ($this->db->affected_rows() > 0) ? "SI" : "NO"; 
    }

     public function buscar_permisosxtipo($tus_id){ //_____//
        $sql=$this->db
            ->select("tus.tus_id,  tus.tus_usuariodescrip, tus.tus_estado, modu.mdl_id, modu.mdl_nombre,   modu.mdl_ruta, modu.mdl_icono, modu.mdl_hijode, modu.mdl_estado,per.per_estado")
            ->from("permisos per")
            ->join('tipo_usuarios tus', 'tus.tus_id=per.tipo_usuarios_tus_id')
            ->join('modulos modu', 'modu.mdl_id=per.modulos_mdl_id')
            ->where(array("tus.tus_flag!="=>0,"tus.tus_id"=>$tus_id,"modu.mdl_estado"=>1))
            ->order_by('modu.mdl_orden asc')             
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();                
    }

    public  function actualiza_permisos($data=array(), $tus_id, $mdl_id){         
        $this->db->where(array("tipo_usuarios_tus_id"=>$tus_id,"modulos_mdl_id"=>$mdl_id));
        $this->db->update('permisos', $data);
        return ($this->db->affected_rows() > 0) ? "SI" : "NO";        
    }


    public function buscarModulosxID($mdl_id){
         $sql=$this->db
            ->select("modu.mdl_id, modu.mdl_nombre, modu.mdl_ruta, modu.mdl_icono, modu.mdl_hijode, mdl.mdl_nombre as hijo, modu.mdl_estado")
            ->from("modulos modu")
            ->join('modulos mdl', 'modu.mdl_hijode=mdl.mdl_id','left')
            ->where(array("modu.mdl_flag"=>1, "modu.mdl_id"=>$mdl_id))
            ->order_by('modu.mdl_orden asc')             
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->row();                
    }

    public function buscarHijos($mdlID){
         $sql=$this->db
            ->select("count(mdl_hijode) as total")
            ->from("modulos")
            ->where(array("mdl_flag"=>1, "mdl_estado"=>1, "mdl_hijode"=>$mdlID))
            ->group_by(array("mdl_hijode"))              
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();                
    }


    

    


   

}
