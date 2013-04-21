<?php

/**
 * Nombre       : modules/models/marcas_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_marca
 * @author Ing. José Pérez
 */
class Marcas_Model extends CI_Model 
{
    private $_table;

    function __construct() 
    {
        parent::__construct();
        $this->_table = 'tbl_marca';
    }
    
    /**
     * Método para obtener listado de marcas pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getMarcas($query_array, $cuantos, $inicio) 
    {
        $this->db->select('ID_MARCA, Marca, Activo, Foto');;
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Marca'])) {
                $this->db->like('Marca', $query_array['Marca']);
            }
        }
        $this->db->order_by("ID_MARCA", "asc");
        $result['rows'] = $this->db->get($this->_table, $cuantos, $inicio)->result();
                
        $this->db->select('ID_MARCA');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Marca'])) {
                $this->db->like('Marca', $query_array['Marca']);
            }
        }
        $tmp = $this->db->get($this->_table);
        $result['num_rows'] = $tmp->num_rows();
        
        return $result;
    }
    
    /** 
     * Método para verificar si el nombre de Marca ya existe en la base de datos
     * @param   int $marca  Marca
     * @return  bol         True si no lo encuentra y False si lo encuentra
     */
    function getMarca($marca)
    {
        $this->db->select('ID_Marca');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Marca' => $marca);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return 1;
        }
        return 0;
    }
    
    /**
     * Método para añadir nueva marca
     * @access public
     * @param String $data['Marca']         Nombre de la marca a insertar
     * @param String $data['Foto']          Nombre de la foto
     * @param String $data['Activo']        Si esta activo o no
     */
    function addMarca($data) 
    {
        return $this->db->insert($this->_table, $data);
    }
    
    /**
     * Método para seleccionar una marca específica
     * @access      public
     * @param       String      Id de marca a obtener datos
     * @return      Array       Obtenemos un array con los datos de la marca indicada
     */
    function getMarcaByID($id) 
    {
        $this->db->select('ID_Marca, Marca, Activo, Foto');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_Marca' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        return $result->row();
    }
    
    /**
     * Método que permitirá actualizar los datos de la marca específico
     * @param String $clase
     * @param Integer $activo
     * @param Integer $grupo
     * @param Integer $idClase
     * @return Boolean 
     */
    function editMarca($data, $idMarca) 
    {
        $this->db->where('ID_Marca', $idMarca);
        return $this->db->update($this->_table, $data);
    }
    
    function deleteMarca($id)
    {
         return $this->db->delete($this->_table, array('ID_MARCA' => $id)); 
    }
}