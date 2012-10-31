<?php

/**
 * Nombre       : models/grupos_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_grupoprod
 * @author Ing. José Pérez
 */
class Grupos_Model extends CI_Model {
    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_grupoprod';
    }

    /** (1)
     * Método para obtener el número total de resultados de una consulta
     * @param   String      $perfil Perfil a buscar
     * @return  Integer     Número de filas que devuelve la consulta
     */
    function getNumRows($grupo = NULL) {
        if (!is_null($grupo)) {
            $this->db->select('ID_GRUPOPROD');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $this->db->like('Grupo', $grupo);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        } else {
            $this->db->select('ID_GRUPOPROD');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        }
    }

    /** (1)
     * Método para obtener listado de grupos pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getGrupoLimit($cuantos, $inicio) {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table, $cuantos, $inicio);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }
 
    /** (1)
     * Método que nos permite obtener el listado de todos los grupos de 
     * productos, sean activos o no.
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getGrupos() {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para verificar si grupo ya existe en la tabla
     * @param   String  $perfil 
     * @return  Boolean
     */
    function verifyExistGrupo($grupo) {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Grupo' => $grupo);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /** (1)
     * Método para añadir un nuevo grupo
     * @access public
     * @param String $data['Grupo']    Nombre del nuevo grupo
     * @param String $data['Activo']    Si esta activo o no
     */
    function addGrupo($data) {
        $this->db->where('Grupo', $data['Grupo']);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return FALSE;
        }
        else {
            return $this->db->insert($this->_table, $data);
        }
    }

    /** (1)
     * Método para seleccionar un grupo específico 
     * @access      public
     * @param       String      Id del grupo a editar
     * @return      Array       Obtenemos un array con los datos del perfil
     *                          indicado
     */
    function getGrupoByID($id) {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_GRUPOPROD' => $id);
        $this->db->where($where);
        $result = $this->db->get('tbl_grupoprod');
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }
 
    /** (1)
     * Método que permitirá actualizar los datos de un grupo específico
     * @param String $data['Grupo']
     * @param Integer $data['Activo']
     * @param Integer $id_grupo
     * @return Boolean 
     */
    function editGrupo($data, $id_grupo) {
        $this->db->where('ID_GRUPOPROD', $id_grupo);
        return $this->db->update($this->_table, $data);
    }

    /** (1)
     * Método para buscar un grupo 
     * @param type $grupo
     * @param type $cuantos
     * @param type $inicio
     * @return boolean 
     */
    function getSearchGrupo($grupo, $cuantos, $inicio) {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->like('Grupo', $grupo);
        $result = $this->db->get($this->_table, $cuantos, $inicio);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para eliminar un grupo
     * @access      public
     * @param       Integer     $id_grupo  ID del grupo a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function deleteGrupo($id_grupo) {
        return $this->db->delete($this->_table, array('ID_GRUPOPROD' => $id_grupo));
    }

}