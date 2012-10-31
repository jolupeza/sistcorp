<?php

/**
 * Nombre       : models/perfil_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_perfil
 * @author Ing. José Pérez
 */
class Perfil_Model extends CI_Model {

    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_perfil';
    }
    
    /** (1)
     * Método para obtener el listado total de perfiles
     * @return Si existen datos.
     */
    function getPerfil(){
        $this->db->select('ID_PERFIL, Perfil, Activo');
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
        else {
            return FALSE;
        }
    }

    /** (1)
     * Método para obtener el número total de resultados de una consulta
     * @param   String      $perfil Perfil a buscar
     * @return  Integer     Número de filas que devuelve la consulta
     */
    function getNumRows($perfil = NULL) {
        if (!is_null($perfil)) {
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $this->db->like('Perfil', $perfil);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        } else {
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        }
    }

    /** (1)
     * Método para obtener listado de perfiles pero con limit definido
     * @param   String  $cuantos    Número de perfiles a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getPerfilLimit($cuantos, $inicio) {
        $this->db->select('ID_PERFIL, Perfil, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table, $cuantos, $inicio);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para agregar un nuevo perfil 
     * @access      public
     * @param       String          Nombre del nuevo perfil
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          inserción
     */
    function addPerfil($data) {
        $this->db->where('perfil', $perfil);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return FALSE;
        }
        else {
            return $this->db->insert($this->_table, $data);
        }
    }

    /** (1)
     * Método para seleccionar un perfil específico 
     * @access      public
     * @param       String      Id del perfil a editar
     * @return      Array       Obtenemos un array con los datos del perfil
     *                          indicado
     */
    function getPerfilByID($id) {
        $this->db->select('ID_PERFIL, Perfil, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_Perfil' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** (1)
     * Método para obtener los datos de un perfil por su nombre
     * @param   String  $perfil 
     * @return  Boolean
     */
    function getPerfilByName($perfil) {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Perfil' => $perfil);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /** (1)
     * Método para editar un perfil 
     * @access      public
     * @param       String        $data['Perfil']       Nombre del perfil
     * @param       String        $data['Activo']     Si esta activo o no
     * @param       Integer     $id  ID del perfil a editar
     * @return      Boolean     De acuerdo si se efectuó correctamente la inserción
     */
    function editPerfil($data, $id) {        
        $this->db->where('ID_PERFIL', $id);
        return $this->db->update($this->_table, $data);
    }

    /** (1)
     * Método para eliminar un perfil 
     * @access      public
     * @param       Integer     $id_perfil  ID del perfil a editar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          inserción
     */
    function deletePerfil($id_perfil) {
        return $this->db->delete($this->_table, array('ID_PERFIL' => $id_perfil));
    }

    /** (1)
     * Método que nos devolverá los registros que coinciden con el texto de búsqueda
     * @param Str $perfil           Perfil a buscar
     * @param Int $cuantos     Cuantos registros nos devuelve la búsqueda
     * @param Int $inicio           Desde donde inicia a buscar
     * @return boolean              Si obtenemos resultados de lo contrario nos devolverá FALSE
     */
    function getSearchPerfil($perfil, $cuantos, $inicio) {
        $this->db->select('ID_PERFIL, Perfil, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->like('Perfil', $perfil);
        $result = $this->db->get($this->_table, $cuantos, $inicio);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

}