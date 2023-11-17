<?php
class Mesadepartes_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->DB2 = $this->load->database('bd_mpv', TRUE);
    }

    public function gruposTupa(){
        return [];
        /*$sql=$this->DB2
           ->select("grt.grt_id, grt.grt_descripcion, tcr.tcr_tipoUsuario")
           ->from("tramitecreado tcr")
           ->join('grupostupa grt', 'grt.grt_id = tcr.gruposTupa_grt_id','right') 
           ->where(array('tcr.tcr_estadoEliminado'=>1, 'tcr.tcr_estado'=>1))
           ->group_by(array("grt.grt_id","grt.grt_descripcion","tcr.tcr_tipoUsuario"))
           ->order_by('grt.grt_descripcion asc')      
           ->get();
           //echo $this->db->last_query(); exit(); 
       return $sql->result_array();*/
   }

   public function tipoTramite($grupo){
        return [];
        /*$sql=$this->DB2
            ->select("tcr.tcr_id, tcr.tcr_descripcion")
            ->from("tramitecreado tcr")
            ->join("t_tupatramite t_tup",'t_tup.TupaTramiteId = tcr.TupaTramiteId')
            ->join('grupostupa grt', 'grt.grt_id = tcr.gruposTupa_grt_id')
            ->where(array("t_tup.t_tup_estado"=>1, 'tcr.tcr_estadoEliminado'=>1, 'tcr.tcr_estado'=>1, "grt.grt_id"=>$grupo)) 
            ->order_by('tcr.tcr_descripcion asc')
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result_array();*/
    }


    public function buscarExpedientesProcesados($F_desde, $F_hasta, $TramiteId){
        return [];
        /*$sql=$this->DB2
           ->select("ins.*, tra.*, tcr.*")
           ->from("inscripcion ins")            
           ->join('tramites tra', 'ins.ins_id = tra.inscripcion_ins_id')
           ->join('tramitecreado tcr', 'tra.tramiteCreado_tcr_id=tcr.tcr_id')
           ->where(array("tra.tra_estadoProceso"=>2, "DATE(tra_fechaAtencion)>="=>$F_desde, "DATE(tra_fechaAtencion)<="=>$F_hasta, "tcr.tcr_id"=>$TramiteId))
           ->order_by('tra.tra_fechaRegistro desc')
           ->get();
           //echo $this->db->last_query(); exit(); 
       return $sql->result();*/
   }

   public function listarTramitesObservados($insID){
        return [];
        /*$sql=$this->DB2
            ->select("tra.tra_urlArchivo as urlArchivo, tra.tra_urlAdjunto as urlAdjunto")
            ->from("tramites tra")
            ->where(array("tra.tra_estadoProceso"=>3, "tra.tra_estadoSubsanacion"=>1,"tra.inscripcion_ins_id"=>$insID))
            ->order_by('tra.tra_fechaRegistro asc')
            ->get();
            //echo $this->db->last_query(); exit(); 
        return $sql->result();*/
    }

    public function buscarExpedienteyDetalle($Anio, $Numero){        
        return [];
        /*$sql=$this->DB2
           ->select("ins.ins_nombres, ins.ins_apellidos, ins.ins_numeroDocumento, ins.ins_telefono1, ins.ins_telefono2, ins.ins_correoElectronico, tra.tra_numeroExpediente, tra.tra_urlArchivo, tra.tra_urlAdjunto")           
           ->from("inscripcion ins")            
           ->join('tramites tra', 'ins.ins_id = tra.inscripcion_ins_id')      
           ->where(array("tra.tra_anio"=>$Anio, "tra.tra_numero"=>$Numero))                               
           ->get();
          // echo $this->db->last_query(); exit(); 
       return $sql->result_array();*/               
   }

    






}