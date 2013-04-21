<?php

/**
 * Nombre       : models/perfil_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_perfil
 * @author Ing. José Pérez
 */
class Perfil_Model extends CI_Model 
{

    private $_table;

    function __construct() 
    {
        parent::__construct();
        $this->_table = 'tbl_perfil';
    }
    
    /**
     * Obtenemos el listado de todos los perfiles
     * @return Object
     */
    function getPerfilTotal()
    {
        $this->db->select('ID_PERFIL, Perfil');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        return $this->db->get($this->_table)->result();
    }

    /** 
     * Método para obtener listado de perfiles pero con limit definido
     * @param   String  $cuantos    Número de perfiles a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getPerfiles($query_array, $cuantos, $inicio) 
    {
        $this->db->select('ID_PERFIL, Perfil, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Perfil'])) {
                $this->db->like('Perfil', $query_array['Perfil']);
            }
        }
        $this->db->order_by("ID_PERFIL", "asc");
        $result['rows'] = $this->db->get($this->_table, $cuantos, $inicio)->result();
        
        $this->db->select('ID_PERFIL');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Perfil'])) {
                $this->db->like('Perfil', $query_array['Perfil']);
            }
        }
        $tmp = $this->db->get($this->_table);
        $result['num_rows'] = $tmp->num_rows();
        
        return $result;
    }

    /** 
     * Método para agregar un nuevo perfil 
     * @access      public
     * @param       String          Nombre del nuevo perfil
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          inserción
     */
    function addPerfil($data) 
    {
        $this->db->where('perfil', $data['Perfil']);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return FALSE;
        } else {
            return $this->db->insert($this->_table, $data);
        }
    }

    /** 
     * Método para seleccionar un perfil específico 
     * @access      public
     * @param       String      Id del perfil a editar
     * @return      Array       Obtenemos un array con los datos del perfil
     *                          indicado
     */
    function getPerfilByID($id) 
    {
        $this->db->select('ID_PERFIL, Perfil, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_Perfil' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** 
     * Método para obtener los datos de un perfil por su nombre
     * @param   String  $perfil 
     * @return  Boolean
     */
    function getPerfilByName($perfil) 
    {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Perfil' => $perfil);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /** 
     * Método para editar un perfil 
     * @access      public
     * @param       String        $data['Perfil']       Nombre del perfil
     * @param       String        $data['Activo']     Si esta activo o no
     * @param       Integer     $id  ID del perfil a editar
     * @return      Boolean     De acuerdo si se efectuó correctamente la inserción
     */
    function editPerfil($data, $id) 
    {        
        $this->db->where('ID_PERFIL', $id);
        return $this->db->update($this->_table, $data);
    }

    /** 
     * Método para eliminar un perfil 
     * @access      public
     * @param       Integer     $id_perfil  ID del perfil a editar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          inserción
     */
    function deletePerfil($id_perfil) 
    {
        return $this->db->delete($this->_table, array('ID_PERFIL' => $id_perfil));
    }
}