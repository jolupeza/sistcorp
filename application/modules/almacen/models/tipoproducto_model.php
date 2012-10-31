<?php

/**
 * Nombre       : modules/models/tipoproducto_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_tipoproducto
 * @author Ing. José Pérez
 */
class Tipoproducto_Model extends CI_Model {

    private $_table;
    
    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_tipoproducto';
    }
    
    /**
     * Método que nos permite obtener el listado de todos los tipos de productos
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getTipoProductos() {
        $this->db->select('ID_TIPOPRODUCTO, Tipo, Activo');
        $where = array('Activo' => '1');
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }
}