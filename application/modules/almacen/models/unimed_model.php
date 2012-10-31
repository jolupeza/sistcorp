<?php

/**
 * Nombre       : models/unimed_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_unidadmedida
 * @author Ing. José Pérez
 */
class Unimed_Model extends CI_Model {
    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_unidadmedida';
    }

    /**
     * Método que nos permite obtener el listado de todas las unidades de medida
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getUnidades() {
        $this->db->select('ID_UNIDMED, UnidadMedida, Abreviatura, Activo');
        $where = array('Activo' => '1');
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    
}