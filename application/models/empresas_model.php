<?php
    /**
     * Nombre       : models/empresas_model.php
     * Descripción  : Modelo que trabajará con la tabla tbl_empresa
     * @author Ing. José Pérez
     */

     class Empresas_Model extends CI_Model{
         
         function __construct() {
             parent::__construct();
         }
         
         /**
          * Se encargará de obtener todas las empresas que tengamos disponibles 
          * en la base de datos
          * @return array
          */
         function getEmpresas(){
             $this->db->select('ID_EMPRESA, RUC, RazonSocial, Activo');
             $query = $this->db->get_where('tbl_empresa', array('Activo' => 1));
             if(!$query){
                 return FALSE;
             }
             if($query->num_rows() == 0){
                 return FALSE;
             }
             return $query->result();
         }
     }