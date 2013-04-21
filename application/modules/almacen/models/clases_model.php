<?php

/**
 * Nombre       : models/clases_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_claseprod
 * @author Ing. José Pérez
 */
class Clases_Model extends CI_Model 
{

    private $_table;

    function __construct() 
    {
        parent::__construct();
        $this->_table = 'tbl_claseprod';
    }
    
    /**
     * Método para obtener listado de clases pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getClases($query_array, $cuantos, $inicio) 
    {
        $this->db->select('ID_CLASEPROD, Clase, c.Activo, g.Grupo, g.ID_EMPRESA');
        $this->db->from('tbl_claseprod c');
        $this->db->join('tbl_grupoprod g', 'c.ID_GRUPOPROD = g.ID_GRUPOPROD');
        $where = array('c.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Clase'])) {
                $this->db->like('Clase', $query_array['Clase']);
            }
        }
        $this->db->order_by("ID_CLASEPROD", "asc");
        $this->db->limit($cuantos, $inicio);
        $result['rows'] = $this->db->get()->result();
                
        $this->db->select('ID_CLASEPROD');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Clase'])) {
                $this->db->like('Clase', $query_array['Clase']);
            }
        }
        $tmp = $this->db->get($this->_table);
        $result['num_rows'] = $tmp->num_rows();
        
        return $result;
    }

    /**
     * Método que nos permite obtener el listado de todos las clases de 
     * productos, sean activos o no.
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getClasesTotal() 
    {
        $this->db->select('ID_CLASEPROD, Clase, Activo');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** 
     * Método para añadir nueva clase
     * @access public
     * @param String $data['Clase']     Nombre de la clase a insertar
     * @param String $data['ID_GRUPOPROD']     Id del grupo de la clase a insertar
     * @param String $data['Activo']   Si esta activo o no
     */
    function addClase($data) 
    {
        return $this->db->insert($this->_table, $data);
    }

    /** 
     * Método para seleccionar una clase específica
     * @access      public
     * @param       String      Id de clase a editar
     * @return      Array       Obtenemos un array con los datos de la clase
     *                          indicado
     */
    function getClaseByID($id) 
    {
        $this->db->select('ID_CLASEPROD, Clase, ID_GRUPOPROD, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_CLASEPROD' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** 
     * Método que permitirá actualizar los datos de la clase específico
     * @param String $clase
     * @param Integer $activo
     * @param Integer $grupo
     * @param Integer $idClase
     * @return Boolean 
     */
    function editClase($data, $idClase) 
    {
        $this->db->where('ID_CLASEPROD', $idClase);
        return $this->db->update($this->_table, $data);
    }

    /**
     * Método para eliminar una clase
     * @access      public
     * @param       Integer     $id_clase  ID de la clase a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function deleteClase($id_clase) 
    {
        return $this->db->delete($this->_table, array('ID_CLASEPROD' => $id_clase));
    }

    /** (1)
     * Método para obtener el ID del Grupo al cual pertenece una clase específica
     * @param  Int $idClase
     * @return array
     */
    function getGrupoByID($idClase) 
    {
        $row = array();
        $this->db->select('ID_GRUPOPROD');
        $this->db->where('ID_CLASEPROD', $idClase);
        $q = $this->db->get('tbl_claseprod');
        if ($q->num_rows() > 0) {
            $row = $q->row();
        }
        return $row;
    }
    
    /** (1)
     * Método para obtener las clases de acuerdo a grupo 
     * @param   int     $id     Id de grupo
     * @return  array           Array con las clases del grupo
     */
    function getClasesByGrupo($id)
    {
        $this->db->select('ID_CLASEPROD, Clase');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_GRUPOPROD' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }
}