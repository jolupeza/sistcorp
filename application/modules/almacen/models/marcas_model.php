<?php

/**
 * Nombre       : modules/models/marcas_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_marca
 * @author Ing. José Pérez
 */
class Marcas_Model extends CI_Model {
    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_marca';
    }
    
    /**
     * Método que nos permite obtener el listado de todas marcas
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getMarcas() {
        $this->db->select('ID_MARCA, Marca, Activo');
        $where = array('Activo' => '1');
        $this->db->where($where);
        $result = $this->db->get('tbl_marca');
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }
}