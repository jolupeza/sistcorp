<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Clase que nos permite administrar los niveles de acceso a nuestro sistema
class Acl
{

    /** Creamos propiedad que nos permitirá implementar cualquier funcionalidad
     * de Codeigniter
     */
    protected $ci;
    private $_perms = array();       //Array : Stores the permissions for the user
    private $_userID;      //Integer : Stores the ID of the current user
    private $_userRole;   //Array : Stores the roles of the current user


    // constructor asigna a la propiedad una copia de la instancia del
    // superobjeto CodeIgniter
    function __construct($id = false)
    {
        $this->ci = & get_instance();
        if ($id) {
            $this->_userID = (int) $id;
        } else {
            if ($this->ci->session->userdata('id_user')) {
                $this->_userID = $this->ci->session->userdata('id_user');
            } else {
                $this->_userID = 0;
            }
        }

        if ($this->_userID > 0) {
            $this->ci->load->model('Acciones_Model');
            //$this->_userRoles = $this->_getUserRoles();
            $this->_userRole = $this->getRole();
            $this->_perms = $this->getPermisosRole();
            $this->buildACL();
        }
    }

    /**
     * En array $this->_perm almacenamos los permisos que tiene el role del usuario
     * y los permisos asignados al usuario.
     */
    public function buildACL()
    {
        //first, get the rules for the user's role
        if (count($this->_userRole) > 0) {
            $this->_perms = array_merge($this->_perms, $this->_getRolePerms($this->_userRole));
        }

        //then, get the individual user permissions
        $permsUser = $this->_getUserPerms($this->_userID);
        if (count($permsUser)) {
            $this->_perms = array_merge($this->_perms, $permsUser);
        }
    }

    /**
     * Obtener el nombre del perfil del usuario
     */
    public function getRole()
    {
        $this->ci->db->select('ID_PERFIL');
        $this->ci->db->where('ID_USUARIO', $this->_userID);
        $role = $this->ci->db->get('tbl_usuario')->row();
        return $role->ID_PERFIL;
    }

    public function getPermisosRole()
    {
        $this->ci->db->select('ID_PERFIL, ID_ACCION, Activo');
        $this->ci->db->where('ID_PERFIL', $this->_userRole);
        $permisos = $this->ci->db->get('tbl_rel_perf_accion')->result();

        $data = array();
        for ($i=0; $i < count($permisos); $i++) {
            $key = $this->_getAccionKeyFromID($permisos[$i]->ID_ACCION);
            if ($key == '') {
                continue;
            }
            if ($permisos[$i]->Activo == 1) {
                $v = true;
            } else {
                $v = false;
            }
            $data[$key] = array(
                'key' => $key,
                'inheritted' => true,
                'value' => $v,
                'name' => $this->_getAccionNameFromID($permisos[$i]->ID_ACCION),
                'id' => $permisos[$i]->ID_ACCION
            );
        }
        //print_r($data); exit;
        return $data;
    }

    /**
     * Obtener el Key del permiso (acción)
     * @param int $accionID     ID del permiso (acción) que deseamos obtener su key
     * @return str              El key del permiso (acción)
     */
    private function _getAccionKeyFromID($accionID)
    {
        $accionID = (int) $accionID;
        $this->ci->db->select('AccionKey');
        $this->ci->db->where('ID_ACCION', $accionID);
        $data = $this->ci->db->get('tbl_accion')->row();
        return $data->AccionKey;
    }

    /**
     * Obtener el nombre del permiso (acción)
     * @param int $accionID     ID del permiso (acción) que deseamos obtener su nombre
     * @return str              El nombre del permiso (acción)
     */
    private function _getAccionNameFromID($accionID)
    {
        $accionID = (int) $accionID;
        $this->ci->db->select('Accion');
        $this->ci->db->where('ID_ACCION', $accionID);
        $data = $this->ci->db->get('tbl_accion')->row();
        return $data->Accion;
    }

    /**
     * (0)
     * @param type $roleID
     * @return type
     */
    public function getRoleNameFromID($roleID)
    {
        //$strSQL = "SELECT `roleName` FROM `".DB_PREFIX."roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
        $this->ci->db->select('roleName');
        $this->ci->db->where('id',floatval($roleID),1);
        $sql = $this->ci->db->get('role_data');
        $data = $sql->result();
        return $data[0]->roleName;
    }

    /*
    private function _getUserRoles()
    {
        //$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
        $this->ci->db->where(array('userID'=>floatval($this->userID)));
        $this->ci->db->order_by('addDate','asc');
        $sql = $this->ci->db->get('user_roles');
        $data = $sql->result();

        $resp = array();
        foreach( $data as $row ) {
            $resp[] = $row->roleID;
        }
        return $resp;
    }*/

    /**
     * (0)
     * @param type $format
     * @return type
     */
    public function getAllRoles($format='ids')
    {
        $format = strtolower($format);
        //$strSQL = "SELECT * FROM `".DB_PREFIX."roles` ORDER BY `roleName` ASC";
        $this->ci->db->order_by('roleName','asc');
        $sql = $this->ci->db->get('role_data');
        $data = $sql->result();
        $resp = array();
        foreach( $data as $row ) {
            if ($format == 'full') {
                $resp[] = array("id" => $row->ID,"name" => $row->roleName);
            } else {
                $resp[] = $row->ID;
            }
        }
        return $resp;
    }

    /**
     * (0)
     * @param type $format
     * @return type
     */
    public function getAllPerms($format='ids')
    {
        $format = strtolower($format);
        //$strSQL = "SELECT * FROM `".DB_PREFIX."permissions` ORDER BY `permKey` ASC";

        $this->ci->db->order_by('permKey','asc');
        $sql = $this->ci->db->get('perm_data');
        $data = $sql->result();

        $resp = array();
        foreach( $data as $row ) {
            if ($format == 'full') {
                $resp[$row->permKey] = array('id' => $row->ID, 'name' => $row->permName, 'key' => $row->permKey);
            } else {
                $resp[] = $row->ID;
            }
        }
        return $resp;
    }

    /**
     * Obtener los permisos (acciones) asociados al role del usuario
     * @param int $roleID       Id del role que deseamos obtener sus permisos
     * @return arr  $perms      Array que contiene los permisos del role del usuario
     */
    private function _getRolePerms($roleID)
    {
        $roleID = (int) $roleID;
        $this->ci->db->select('ID_REL_PRF_ACC, ID_PERFIL, ID_ACCION, Activo');
        $this->ci->db->where(array('ID_PERFIL' => $roleID));
        $this->ci->db->order_by('ID_REL_PRF_ACC','asc');
        $data = $this->ci->db->get('tbl_rel_perf_accion')->result();
        $perms = array();
        foreach( $data as $row ) {
            $pK = strtolower($this->_getAccionKeyFromID($row->ID_ACCION));
            if ($pK == '') { continue; }
            if ($row->Activo === '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $perms[$pK] = array(
                'key' => $pK,
                'inheritted' => true,
                'value' => $hP,
                'name' => $this->_getAccionNameFromID($row->ID_ACCION),
                'id' => $row->ID_ACCION
            );
        }
        return $perms;
    }

    /**
     * Obtener los permisos (acciones) asociados al usuario
     * @param int $userID       Id del usuario que deseamos obtener sus permisos
     * @return arr  $perms      Array que contiene los permisos del usuario
     */
    private function _getUserPerms($userID)
    {
        $userID = (int) $userID;
        $this->ci->db->select('ID_USUARIO, ID_ACCION, Activo');
        $this->ci->db->where('ID_USUARIO', $userID);
        $this->ci->db->order_by('Fec_Creacion','asc');
        $data = $this->ci->db->get('tbl_user_accion')->result();
        if (count($data)) {
            $perms = array();
            foreach( $data as $row ) {
                $pK = strtolower($this->_getAccionKeyFromID($row->ID_ACCION));
                if ($pK == '') { continue; }
                if ($row->Activo == '1') {
                    $hP = true;
                } else {
                    $hP = false;
                }
                $perms[$pK] = array(
                    'key' => $pK,
                    'inheritted' => false,
                    'value' => $hP,
                    'name' => $this->_getAccionNameFromID($row->ID_ACCION),
                    'id' => $row->ID_ACCION
                );
            }
            return $perms;
        }
    }

    public function getPermisos()
    {
        if(isset($this->_perms) && count($this->_perms)) {
            return $this->_perms;
        }
    }


    public function hasRole($roleID)
    {
        foreach($this->_userRole as $k => $v) {
            if (floatval($v) === floatval($roleID)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica si usuario tiene permiso
     * @param str $permKey      Key del permiso (acción)
     * @return boolean          Si tiene asignado el permiso devuelve true caso
     *                          contrario devuelve false
     */
    public function hasPermission($permKey)
    {
        $permKey = strtolower($permKey);
        if (array_key_exists($permKey, $this->_perms)) {
            if ($this->_perms[$permKey]['value'] === '1' || $this->_perms[$permKey]['value'] === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}