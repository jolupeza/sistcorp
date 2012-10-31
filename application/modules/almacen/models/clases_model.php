<?php

/**
 * Nombre       : models/clases_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_claseprod
 * @author Ing. José Pérez
 */
class Clases_Model extends CI_Model {

    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_claseprod';
    }

    /** (1)
     * Método para obtener el número total de resultados de una consulta
     * @param   String      $clase      Clase a buscar
     * @return  Integer     Número de filas que devuelve la consulta
     */
    function getNumRows($clase = NULL) {
        if (!is_null($clase)) {
            $this->db->select('ID_CLASEPROD');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $this->db->like('Clase', $clase);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        } else {
            $this->db->select('ID_CLASEPROD');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        }
    }

    /**
     * Método que nos permite obtener el listado de todos las clases de 
     * productos, sean activos o no.
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getClases() {
        $this->db->select('ID_CLASEPROD, Clase, Activo');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para obtener listado de clases pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getClasesLimit($cuantos, $inicio) {
        $this->db->select('ID_CLASEPROD, Clase, c.Activo, g.Grupo, g.ID_EMPRESA');
        $this->db->from('tbl_claseprod c');
        $this->db->join('tbl_grupoprod g', 'c.ID_GRUPOPROD = g.ID_GRUPOPROD');
        $where = array('c.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->order_by("ID_CLASEPROD", "asc");
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para añadir nueva clase
     * @access public
     * @param String $data['Clase']     Nombre de la clase a insertar
     * @param String $data['ID_GRUPOPROD']     Id del grupo de la clase a insertar
     * @param String $data['Activo']   Si esta activo o no
     */
    function addClase($data) {
        return $this->db->insert($this->_table, $data);
    }

    /** (1)
     * Método para seleccionar una clase específica
     * @access      public
     * @param       String      Id de clase a editar
     * @return      Array       Obtenemos un array con los datos de la clase
     *                          indicado
     */
    function getClaseByID($id) {
        $this->db->select('ID_CLASEPROD, Clase, ID_GRUPOPROD, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_CLASEPROD' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** (1)
     * Método que permitirá actualizar los datos de la clase específico
     * @param String $clase
     * @param Integer $activo
     * @param Integer $grupo
     * @param Integer $idClase
     * @return Boolean 
     */
    function editClase($data, $idClase) {
        $this->db->where('ID_CLASEPROD', $idClase);
        return $this->db->update($this->_table, $data);
    }

    /** (1)
     * Método para buscar una clase 
     * @param type $clase
     * @param type $cuantos
     * @param type $inicio
     * @return boolean 
     */
    function getSearchClase($clase, $cuantos, $inicio) {
        $this->db->select('ID_CLASEPROD, Clase, c.Activo, g.Grupo, g.ID_EMPRESA');
        $this->db->from('tbl_claseprod c');
        $this->db->join('tbl_grupoprod g', 'c.ID_GRUPOPROD = g.ID_GRUPOPROD');
        $where = array('c.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->like('Clase', $clase);
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /**
     * Método para eliminar una clase
     * @access      public
     * @param       Integer     $id_clase  ID de la clase a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function deleteClase($id_clase) {
        return $this->db->delete($this->_table, array('ID_CLASEPROD' => $id_clase));
    }

    /**
     * Método para obtener el ID del Grupo al cual pertenece una clase específica
     * @param  Int $idClase
     * @return array
     */
    function getGrupoByID($idClase) {
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
    function getClasesByGrupo($id){
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