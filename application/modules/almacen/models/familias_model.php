<?php

/**
 * Nombre       : models/familias_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_familiaprod
 * @author Ing. José Pérez
 */
class Familias_Model extends CI_Model {

    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_familiaprod';
    }

    /** (1)
     * Método para obtener el número total de resultados de una consulta
     * @param   String      $clase      Clase a buscar
     * @return  Integer     Número de filas que devuelve la consulta
     */
    function getNumRows($familia = NULL) {
        if (!is_null($familia)) {
            $this->db->select('ID_FAMILIAPROD');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $this->db->like('Familia', $familia);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        } else {
            $this->db->select('ID_FAMILIAPROD');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        }
    }

    /**
     * Método que nos permite obtener el listado de todos las familias de 
     * productos, sean activos o no.
     * @access public
     * @return boolean, array Devolvemos boolean si no obtenemos resultados
     *                        y array si obtenemos resultados 
     */
    function getFamilias() {
        $this->db->select('ID_FAMILIAPROD, Familia, Activo');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para obtener listado de familias pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getFamiliasLimit($cuantos, $inicio) {
        $this->db->select('ID_FAMILIAPROD, Familia, f.Activo, g.Grupo, c.Clase, f.ID_EMPRESA');
        $this->db->from('tbl_familiaprod f');
        $this->db->join('tbl_claseprod c', 'c.ID_CLASEPROD = f.ID_CLASEPROD');
        $this->db->join('tbl_grupoprod g', 'f.ID_GRUPOPROD = g.ID_GRUPOPROD');
        $where = array('c.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->order_by("ID_FAMILIAPROD", "asc");
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /**
     * Método para verificar si familia ya existe en la tabla
     * @param   String  $familia
     * @return  Boolean
     */
    function verifyExistFamilia($familia) {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Familia' => $familia);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /** (1)
     * Método para añadir nueva familia
     * @access public
     * @param String  $data['Familia']   Nombre de la familia a insertar
     * @param Integer $data['ID_CLASEPROD']     Id de la clase de la familia a insertar
     * @param Integer $data['ID_GRUPOPROD']     Id del grupo de la familia a insertar
     * @param Integer $data['Activo']    Si esta activo o no
     */
    function addFamilia($data) {
        return $this->db->insert($this->_table, $data);
    }

    /** (1)
     * Método para seleccionar una familia específica
     * @access      public
     * @param       String      Id de familia a editar
     * @return      Array       Obtenemos un array con los datos de la familia
     *                          indicado
     */
    function getFamiliaByID($id) {
        $this->db->select('ID_FAMILIAPROD, Familia, ID_CLASEPROD, ID_GRUPOPROD, Activo, ID_EMPRESA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_FAMILIAPROD' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /**
     * Método que permitirá actualizar los datos de la familia
     * @param String $familia
     * @param Integer $clase
     * @param Integer $activo
     * @param Integer $grupo
     * @param Integer $idFamilia
     * @return Boolean 
     */
    function editFamilia($data, $id) {
        $this->db->where('ID_FAMILIAPROD', $id);
        return $this->db->update($this->_table, $data);
    }

    /**
     * Método que permite obtener el o los grupos buscados
     * @param String $grupo Nombre del grupo a buscar
     */
    function getGrupoByName($grupo) {
        $this->db->like('Grupo', $grupo);
        $result = $this->db->get('tbl_grupoprod');
        if (!$result) {
            return FALSE;
        }
        if ($result->num_rows() == 0) {
            return FALSE;
        }
        return $result->result();
    }

    /**
     * Método para buscar una familia
     * @param str $familia
     * @param int $cuantos
     * @param int $inicio
     * @return array de objetos
     */
    function searchFamilia($familia, $cuantos, $inicio) {
        $this->db->select('ID_FAMILIAPROD, Familia, f.Activo, g.Grupo, c.Clase, f.ID_EMPRESA');
        $this->db->from('tbl_familiaprod f');
        $this->db->join('tbl_claseprod c', 'c.ID_CLASEPROD = f.ID_CLASEPROD');
        $this->db->join('tbl_grupoprod g', 'f.ID_GRUPOPROD = g.ID_GRUPOPROD');
        $where = array('f.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->like('Familia', $familia);
        $this->db->order_by("ID_FAMILIAPROD", "asc");
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        var_dump($this->db->last_query());
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /**
     * Método para eliminar una familia
     * @access      public
     * @param       Integer     $id_familia  ID de la familia a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function deleteFamilia($id_familia) {
        return $this->db->delete($this->_table, array('ID_FAMILIAPROD' => $id_familia));
    }

    /**
     * 
     */
    function getFamiliasByClase($id_clase) {
        $this->db->select('ID_FAMILIAPROD, Familia');
        $where = array('ID_CLASEPROD' => $id_clase, 'ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }
}