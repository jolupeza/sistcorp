<?php
    /**
     * Nombre       : models/modulos_model.php
     * Descripción  : Modelo que trabajará con la tabla tbl_modulos, tbl_opciones, tbl_accion, tbl_rel_perf_accion
     * @author Ing. José Pérez
     */

     class Modulos_Model extends CI_Model{
     
         function __construct() {
             parent::__construct();
         }
         
         /**
          * Obtener los módulos que cuenta nuestro sistema por perfil
          * @access     public
          * @return     array
          */
         function getModulos(){
             $sql = "SELECT distinct m.ID_MODULO, Modulo "
                   ."FROM tbl_modulos m, tbl_opciones o, tbl_accion a, tbl_rel_perf_accion r "
                   ."WHERE m.ID_MODULO = o.ID_MODULO AND o.ID_OPCION = a.ID_OPCION "
                   ."AND a.ID_ACCION = r.ID_ACCION AND o.Activo=1 AND a.Activo=1 "
                   ."AND r.Activo=1 AND r.ID_PERFIL=".$this->session->userdata('perfil');
             $query = $this->db->query($sql);
             if(!$query){
                 return FALSE;
             }
             if($query->num_rows() == 0){
                 return FALSE;
             }
             return $query->result();
         }
         
         /**
          * Método para obtener las opciones
          * @access     public
          * @return     array
          */
         function getOpciones($id_modulo){
             $sql = "SELECT distinct o.ID_OPCION, Opcion, URL, o.ID_MODULO, o.ID_OPCION_REF "
                   ."FROM tbl_modulos m, tbl_opciones o, tbl_accion a, tbl_rel_perf_accion r "
                   ."WHERE m.ID_MODULO = o.ID_MODULO AND o.ID_OPCION = a.ID_OPCION AND a.ID_ACCION=r.ID_ACCION "
                   ."AND o.Activo=1 AND a.Activo=1 AND r.Activo=1 AND r.ID_PERFIL=".$this->session->userdata('perfil')
                   ." AND o.ID_MODULO =".$id_modulo;
             $query = $this->db->query($sql);
             $this->db->last_query();
             if(!$query){
                 return FALSE;
             }
             if($query->num_rows() == 0){
                 return FALSE;
             }
             return $query->result();
         }
         
         /**
          * Método para obtener las sub opciones
          * @access     public
          * @return     array
          */
         function getSubOpciones($id_opcion){
           $this->db->select('ID_OPCION, Opcion, URL');
           $where = array('ID_OPCION_REF' => $id_opcion, 'Activo' => '1', 'ID_OPCION !=' => $id_opcion);
           $this->db->where($where); 
           $query = $this->db->get('tbl_opciones');
           if(!$query){
            return FALSE;
           }
           if($query->num_rows() == 0){
            return FALSE;
           }
           return $query->result();
         }
     }