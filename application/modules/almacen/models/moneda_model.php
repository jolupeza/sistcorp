<?php

/**
 * Nombre       : modules/models/moneda_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_moneda
 * @author Ing. José Pérez
 */
class Moneda_Model extends CI_Model {

    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_moneda';
    }

    /**
     * Método que nos permite obtener el listado de todas las monedas
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getMonedas() {
        $this->db->select('ID_MONEDA, Moneda, Abreviatura, Simbolo, Activo, ID_EMPRESA');
        $where = array('Activo' => '1', 'ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

}