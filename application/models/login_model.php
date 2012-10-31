<?php

/**
 * Nombre       : models/login_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_usuario para verificar el login del usuario.
 * @author Ing. José Pérez
 */
class Login_Model extends CI_Model {

    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_usuario';
    }

    /**
     * Método que permite verificar el login del usuario
     * @param string $data['Usuario']    El nombre del usuario
     * @param string $data['PWD']         El password encriptado con sha1
     * @param string $data['PWD_JS']  El password encriptado con función js sha1
     * @return array
     */
    function login($data) {
        $this->db->select('ID_USUARIO, Usuario, Nombres, Ape_Paterno, Ape_Materno, PWD, Activo, ID_EMPRESA, ID_PERFIL');
        $this->db->limit(1);
        $query = $this->db->get_where($this->_table, array('Usuario' => $data['Usuario'], 'PWD' => $data['PWD'], 'PWD_JS' => $data['PWD_JS'], ID_EMPRESA => $data['ID_EMPRESA'], 'Activo' => '1'));
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }
    
    /** (1)
     * Método para actualizar el estado de activación del usuario
     * @access      public
     * @param       String      $code
     * @param       Int             $id
     * @return      Boolean     
     */
    function updateStatus($code, $id) {
        $this->db->where(array('ID_USUARIO' => $id, 'Code' => $code));
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            $data = array(
                'Activo' => '1',
                'Code' => ''
            );
            $this->db->where('Code', $code);
            return $this->db->update($this->_table, $data);
        } else {
            return FALSE;
        }
    }

}