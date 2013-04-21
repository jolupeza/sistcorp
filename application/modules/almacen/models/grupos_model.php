<?php

/**
 * Nombre       : models/grupos_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_grupoprod
 * @author Ing. José Pérez
 */
class Grupos_Model extends CI_Model 
{
    private $_table;

    function __construct() 
    {
        parent::__construct();
        $this->_table = 'tbl_grupoprod';
    }
    
    /** 
     * Método para obtener listado de grupos pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getGrupos($query_array, $cuantos, $inicio) 
    {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Grupo'])) {
                $this->db->like('Grupo', $query_array['Grupo']);
            }
        }
        $this->db->order_by("ID_GRUPOPROD", "asc");
        $result['rows'] = $this->db->get($this->_table, $cuantos, $inicio)->result();
        
        $this->db->select('ID_GRUPOPROD');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Grupo'])) {
                $this->db->like('Grupo', $query_array['Grupo']);
            }
        }
        $tmp = $this->db->get($this->_table);
        $result['num_rows'] = $tmp->num_rows();
        
        return $result;
    }
 
    /** 
     * Método que nos permite obtener el listado de todos los grupos de 
     * productos, sean activos o no.
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getGruposTotal() 
    {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** 
     * Método para verificar si grupo ya existe en la tabla
     * @param   String  $perfil 
     * @return  Boolean
     */
    function verifyExistGrupo($grupo) 
    {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Grupo' => $grupo);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /** 
     * Método para añadir un nuevo grupo
     * @access public
     * @param String $data['Grupo']    Nombre del nuevo grupo
     * @param String $data['Activo']    Si esta activo o no
     */
    function addGrupo($data) 
    {
        $this->db->where('Grupo', $data['Grupo']);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return FALSE;
        }
        else {
            return $this->db->insert($this->_table, $data);
        }
    }

    /** 
     * Método para seleccionar un grupo específico 
     * @access      public
     * @param       String      Id del grupo a editar
     * @return      Array       Obtenemos un array con los datos del perfil
     *                          indicado
     */
    function getGrupoByID($id) 
    {
        $this->db->select('ID_GRUPOPROD, Grupo, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_GRUPOPROD' => $id);
        $this->db->where($where);
        $result = $this->db->get('tbl_grupoprod');
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }
 
    /** 
     * Método que permitirá actualizar los datos de un grupo específico
     * @param String $data['Grupo']
     * @param Integer $data['Activo']
     * @param Integer $id_grupo
     * @return Boolean 
     */
    function editGrupo($data, $id_grupo) 
    {
        $this->db->where('ID_GRUPOPROD', $id_grupo);
        return $this->db->update($this->_table, $data);
    }

    /** 
     * Método para eliminar un grupo
     * @access      public
     * @param       Integer     $id_grupo  ID del grupo a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function deleteGrupo($id_grupo) 
    {
        return $this->db->delete($this->_table, array('ID_GRUPOPROD' => $id_grupo));
    }

}