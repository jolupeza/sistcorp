<?php
    /**
     * Nombre       : models/acciones_model.php
     * Descripción  : Modelo que trabajará con la tabla tbl_accion, tbl_user_accion, tbl_rel_perf_accion
     * @author Ing. José Pérez
     */

 class Acciones_Model extends CI_Model
{
     private $_table;

     function __construct() {
         parent::__construct();
         $this->_table = 'tbl_user_accion';
     }

     /**
      * Obtenermos los permisos asignados a un usuario específico
      * @param int $userID      ID del usuario
      * @return arr             Los permisos del usuario
      */
     function getUserPerms($userID)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
     {
        $userID = (int) $userID;
        $this->db->select('ID_USUARIO, ID_ACCION, Activo');
        $this->db->where('ID_USUARIO', $userID);
        $this->db->order_by('Fec_Creacion','asc');
        return $this->db->get($this->_table)->result();
     }
     
     /** 
     * Método para obtener listado de Permisos de un Perfil específico
     * @return  Array
     */
    function getPermsRole($idPerfil) 
    {
        $this->db->select('ID_REL_PRF_ACC, ID_PERFIL, ID_ACCION, Activo');
        $where = array(
            'ID_EMPRESA'    =>  $this->session->userdata('empresa'),
            'ID_PERFIL'     =>  $idPerfil
        );
        $this->db->where($where);
        $result = $this->db->get('tbl_rel_perf_accion')->result();
        
        $data = array();
        for ($i = 0; $i < count($result); $i++) {
            $key = $this->getAccionKeyFromID($result[$i]->ID_ACCION);
            if ($key == '') { continue; }
            
            if ($result[$i]->Activo == 1) {
                $v = 1;
            } else {
                $v = 0;
            }
            
            $data[$key] = array(
                'key'   =>  $key,
                'valor' =>  $v,
                'nombre'   => $this->getAccionNameFromID($result[$i]->ID_ACCION),
                'id'    => $result[$i]->ID_ACCION
            );
        }  
        $data = array_merge($this->getAllAcciones(), $data);
        
        return $data;
    }
     
     /** 
      * Obtenemos el key de un permiso específico
      * @param int $accionID        ID del permiso
      * @return str                 Key del permiso
      */
     function getAccionKeyFromID($accionID) 
     {
        $accionID = (int) $accionID;
        $this->db->select('AccionKey');
        $this->db->where('ID_ACCION', $accionID);
        $result = $this->db->get('tbl_accion')->row();
        return $result->AccionKey;
     }
     
     /** 
      * Obtenemos el nombre de un permiso específico
      * @param int $accionID        ID del permiso
      * @return str                 Nombre del permiso
      */
     function getAccionNameFromID($accionID)
     {
        $accionID = (int) $accionID;
        $this->db->select('Accion');
        $this->db->where('ID_ACCION', $accionID);
        $result = $this->db->get('tbl_accion')->row();
        return $result->Accion;
     }
     
     function getAllAcciones()
     {
         $this->db->select('AccionKey, Activo, Accion, ID_ACCION');
         $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
         $this->db->where($where);
         $result = $this->db->get('tbl_accion')->result();
         
         $data = array();
         for ($i = 0; $i < sizeof($result); $i++) {
            if ($result[$i]->AccionKey == '') { continue; }
            $data[$result[$i]->AccionKey] = array(
                'key' => $result[$i]->AccionKey,
                'valor' => 'x',
                'nombre' => $result[$i]->Accion,
                'id' => $result[$i]->ID_ACCION
            );
        }
        return $data;
     }
     
     /** 
     * Método para obtener listado de Permisos pero con limit definido
     * @param   String  $cuantos    Número de permisos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getAcciones($query_array, $cuantos, $inicio) 
    {
        $this->db->select('ID_ACCION, Accion, Activo, ID_OPCION, AccionKey');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Accion'])) {
                $this->db->like('Accion', $query_array['Accion']);
            }
        }
        $this->db->order_by("Accion", "asc");
        $result['rows'] = $this->db->get('tbl_accion', $cuantos, $inicio)->result();
        
        $this->db->select('ID_ACCION');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        if (count($query_array) > 0) {
            if (strlen($query_array['Accion'])) {
                $this->db->like('Accion', $query_array['Accion']);
            }
        }
        $tmp = $this->db->get('tbl_accion');
        $result['num_rows'] = $tmp->num_rows();
        
        return $result;
    }
    
    /**
     * Obtenemos el listado de todas las opciones (menús)
     * @return arr
     */
    function getAllOpciones() 
    {
        $this->db->select('ID_OPCION, Opcion');
        $where = array(
            'ID_EMPRESA' => $this->session->userdata('empresa'),
            'Activo'    => 1
        );
        $this->db->where($where);
        return $this->db->get('tbl_opciones')->result();
    }
    
    /** 
     * Verificamos si el permiso a través de su nombre ya se encuentra registrado
     * @param   String  $permiso 
     * @return  Boolean
     */
    function verifyPermiso($permiso) 
    {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'Accion' => $permiso);
        $this->db->where($where);
        $result = $this->db->get('tbl_accion');
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }
    
    /** 
     * Verificamos si el key del permiso ya se encuentra registrado
     * @param   String  $key 
     * @return  Boolean
     */
    function verifyKey($key) 
    {
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'AccionKey' => $key);
        $this->db->where($where);
        $result = $this->db->get('tbl_accion');
        if ($result->num_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }
    
    /** 
     * Método para agregar un nuevo permiso 
     * @access      public
     * @param       String      $data       Array con los campos del permiso a agregar
     * @return      Boolean     De acuerdo si se efectuó correctamente la inserción
     */
    function addPermiso($data) 
    {        
        return $this->db->insert('tbl_accion', $data);
    }
    
    /** 
     * Método para seleccionar un permiso específico 
     * @access      public
     * @param       String      Id del permiso a editar
     * @return      Array       Obtenemos un array con los datos del permiso indicado
     */
    function getPermisoByID($id) 
    {
        $this->db->select('ID_ACCION, Accion, a.Activo, a.ID_OPCION, Opcion, AccionKey, a.ID_EMPRESA');
        $this->db->from('tbl_accion a');
        $this->db->join('tbl_opciones o', 'a.ID_OPCION = o.ID_OPCION');
        $where = array('a.ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_ACCION' => $id);
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }
    
    /** 
     * Método para editar un permiso
     * @access      public
     * @param       Array       $data               Datos del permiso a editar
     * @param       Integer     $id                 ID del permiso a editar
     * @return      Boolean     De acuerdo si se efectuó correctamente la inserción
     */
    function editPermiso($data, $id) 
    {        
        $this->db->where('ID_ACCION', $id);
        return $this->db->update('tbl_accion', $data);
    }
    
    /** 
     * Método para eliminar un permiso 
     * @access      public
     * @param       Integer     $id  ID del permiso a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la eliminación
     */
    function deletePermiso($id) 
    {
        return $this->db->delete($this->_table, array('ID_PERFIL' => $id));
    }
    
    /**
    * Editar el permisos asignado a un perfil
    *
    * @param int $perfilID
    * Id del perfil a editar.
    *
    * @param int $permisoID
    * Id del permisos a editar.
    *
    * @param int $valor
    * Estado del permisos a editar.
    *
    * @return
    * FALSE en caso no se pueda editar el permiso o TRUE en caso de sí.
    */
    public function editarPermisoPerfil($perfilID, $permisoID, $valor)
    {
        $perfilID = (int) $perfilID;
        $permisoID = (int) $permisoID;
        $valor = (int) $valor;
        $data = array();
        $this->db->select('ID_PERFIL, ID_ACCION');
        $where = array('ID_PERFIL' => $perfilID, 'ID_ACCION' => $permisoID);
        $this->db->where($where);
        $result = $this->db->get('tbl_rel_perf_accion');
        if($result->num_rows() > 0) {
            $data = array(
                'Activo' => $valor, 
                'User_Modificacion' => $this->session->userdata('id_user'),
                'Fec_Modificacion' => date('Y-m-d H:i:s')            
            );
            $where = array('ID_PERFIL' => $perfilID, 'ID_ACCION' => $permisoID);
            $this->db->where($where);
            $this->db->update('tbl_rel_perf_accion', $data); 
        } else {
            $data = array(
                'ID_PERFIL' =>  $perfilID,
                'ID_ACCION' =>  $permisoID,
                'Activo'    =>  $valor,
                'User_Creacion' =>  $this->session->userdata('id_user'),
                'Fec_Creacion'  =>  date('Y-m-d H:i:s'),
                'ID_EMPRESA'    =>  $this->session->userdata('empresa')  
            );
            $this->db->insert('tbl_rel_perf_accion', $data);
        }
    }
    
    /**
    * Denegar permisos a un perfil
    *
    * @param int $perfilID
    * Id del perfil a denegar.
    *
    * @param int $permisoID
    * Id del permisos a denegar.
    *
    * @return
    * FALSE en caso no se pueda editar el permiso o TRUE en caso de sí.
    */
    public function eliminarPermisoPerfil($perfilID, $permisoID)
    {
        $perfilID = (int) $perfilID;
        $permisoID = (int) $permisoID;
        $where = array('ID_PERFIL' => $perfilID, 'ID_ACCION' => $permisoID);
        $this->db->where($where); 
        $this->db->delete('tbl_rel_perf_accion', array('ID_PERFIL' => $perfilID, 'ID_ACCION' => $permisoID));
    }
 }