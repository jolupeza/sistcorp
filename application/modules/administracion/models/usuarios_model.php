<?php

/**
 * Nombre       : administracion/controllers/usuarios_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_usuario
 * @author Ing. José Pérez
 */
class Usuarios_Model extends CI_Model {
    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_usuario';
    }

    /** (1)
     * Método para obtener el número total de resultados de una consulta
     * @param   String      $text   Texto que se buscará en el parámetro seleccionado
     * @param   String      $parameter   Parámetro de busqueda
     * @return  Integer     Número de filas que devuelve la consulta
     */
    function getNumRows($text = NULL, $parameter = '') {
        if (!is_null($text)) {
            $this->db->select('ID_USUARIO');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            switch ($parameter) {
                case 'Username' :
                    $this->db->like('Usuario', $text);
                    break;
                case 'Nombres' :
                    $this->db->like('Nombres', $text);
                    break;
                case 'Apaterno' :
                    $this->db->like('Ape_Paterno', $text);
                    break;
                case 'Amaterno' :
                    $this->db->like('Ape_Materno', $text);
                    break;
                case 'Todos' :
                    $this->db->like('Usuario', $text);
                    $this->db->or_like('Nombres', $text);
                    $this->db->or_like('Ape_Paterno', $text);
                    $this->db->or_like('Ape_Materno', $text);
                    break;
            }
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        } else {
            $this->db->select('ID_USUARIO');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        }
    }

    /** (1)
     * Método para obtener listado de usuarios pero con limit definido
     * @param   String  $cuantos    Número de perfiles a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getUsersLimit($cuantos, $inicio) {
        $this->db->select('ID_USUARIO, Usuario, Nombres, Ape_Paterno, Ape_Materno, Sexo, Email, tbl_usuario.Activo, tbl_usuario.ID_EMPRESA, PERFIL');
        $this->db->from('tbl_usuario');
        $this->db->join('tbl_perfil', 'tbl_usuario.ID_PERFIL = tbl_perfil.ID_PERFIL');
        $where = array('tbl_usuario.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /** (1)
     * Método para verificar si un usuario se encuentra registrado
     * @param   String $username 
     * @return  Boolean
     */
    function getUserByUsername($username) {
        $this->db->where('Usuario', $username);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return 1;  // Que usuario no esta en la base de datos
        }
        return 0;
    }

    /** (1)
     * Método para agregar un nuevo usuario
     * @access      public
     * @param       String      $data['Nombres']   Nombres del usuario
     * @param       String      $data['Ape_Paterno']   Ape. Paterno
     * @param       String      $data['Ape_Materno']   Ape. Materno
     * @param       String      $data['Sexo']       Sexo
     * @param       String      $data['Email']      Email
     * @param       String      $data['Telefono']   Telefono
     * @param       String      $data['Usuario']       Nombre de usuario
     * @param       String      $data['PWD']   Password
     * @param       String      $data['PWD_JS'] Password_js
     * @param       Integer   $data['ID_PERFIL'] ID_Perfil
     * @return      Boolean     De acuerdo si se efectuó correctamente la inserción
     */
    function addUser($data) {
        // Verificamos que el usuario a agregar no se encuentre ya registrado en la base de datos
        $this->db->where('Usuario', $data['Usuario']);
        $this->db->or_where('Email', $data['Email']);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert($this->_table, $data);
            return$this->db->insert_id();
        }
    }

    /** (1)
     * Método para seleccionar un usuario específico 
     * @access      public
     * @param       String      Id del usuario a editar
     * @return      Array       Obtenemos un array con los datos del perfil
     *                          indicado
     */
    function getUserByID($id) {
        $this->db->select('ID_USUARIO, Usuario, Nombres, Ape_Paterno, Ape_Materno, Sexo, Email, Telefono, Activo, ID_EMPRESA, ID_PERFIL');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_USUARIO' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** (1)
     * Método para verificar si email ya se encuentra registrado
     * @access      public
     * @param       String      $email
     * @return      Boolean     
     */
    function verifyEmail($email) {
        $this->db->where('Email', $email);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return 1;  // Que usuario no esta en la base de datos
        }
        return 0;
    }    

    /** (1)
     * Método para editar información de usuario
     * @access      public
     * @param       String      $data['Nombres']   Nombres del usuario
     * @param       String      $data['Ape_Paterno']   Ape. Paterno
     * @param       String      $data['Ape_Materno']   Ape. Materno
     * @param       String      $data['Sexo']       Sexo
     * @param       String      $data['Email']      Email
     * @param       String      $data['Telefono']   Telefono
     * @param       String      $data['Usuario']       Nombre de usuario
     * @param       String      $data['Activo']   Activo
     * @param       Integer   $data['ID_PERFIL'] ID_Perfil
     * @return      Boolean     De acuerdo si se efectuó correctamente la edición
     */
    function editUser($data, $id_usuario) {
        $id = (int) $id_usuario;
        if (is_int($id)) {
            $this->db->where('ID_USUARIO', $id);
            return $this->db->update($this->_table, $data);
        }
    }

    /** (1)
     * Método para eliminar un usuario
     * @access      public
     * @param       Integer     $id_usuario  ID del perfil a editar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          inserción
     */
    function deleteUser($id_usuario) {
        return $this->db->delete('tbl_usuario', array('ID_USUARIO' => $id_usuario));
    }

    /* (1)
     * Método para realizar la búsqueda en base al parámetro buscado
     * @access      public
     * @param       String  $text       Texto a buscar
     * @param       Integer $cuantos    Total de registros
     * @param       Integer $inicio     Desde donde comienza a buscar los registros
     */

    function getSearchUser($text, $parameter, $cuantos, $inicio) {
        $this->db->select('ID_USUARIO, Usuario, Nombres, Ape_Paterno, Ape_Materno, Sexo, Email, tbl_usuario.Activo, tbl_usuario.ID_EMPRESA, PERFIL');
        $this->db->from($this->_table);
        $this->db->join('tbl_perfil', 'tbl_usuario.ID_PERFIL = tbl_perfil.ID_PERFIL');
        $where = array('tbl_usuario.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        switch ($parameter) {
            case 'Username' :
                $this->db->like('Usuario', $text);
                break;
            case 'Nombres' :
                $this->db->like('Nombres', $text);
                break;
            case 'Apaterno' :
                $this->db->like('Ape_Paterno', $text);
                break;
            case 'Amaterno' :
                $this->db->like('Ape_Materno', $text);
                break;
            case 'Todos' :
                $this->db->like('Usuario', $text);
                $this->db->or_like('Nombres', $text);
                $this->db->or_like('Ape_Paterno', $text);
                $this->db->or_like('Ape_Materno', $text);
                break;
        }
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

}