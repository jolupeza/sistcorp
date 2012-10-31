<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Nombre       : administracion/controllers/usuarios.php
 * Descripción  : Controlador que se encargará de administrar los usuarios.
 * @author Ing. José Pérez
 */
class Usuarios extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_Model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('email');
    }

    /**
     * Nos cargará la vista por defecto del controlador perfil
     */
    function index() {
        if ($this->_is_logged_in()) {
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            $num_row = $this->Usuarios_Model->getNumRows();
            if (is_numeric($num_row) && $num_row > 0) {
                $config['base_url'] = base_url() . 'administracion/usuarios/index';
                $config['total_rows'] = $num_row;
                $config['per_page'] = '5';
                $config['uri_segment'] = '4';
                $this->pagination->initialize($config);
                $data['users'] = $this->Usuarios_Model->getUsersLimit($config['per_page'], $this->uri->segment(4));
                $data['pag_links'] = $this->pagination->create_links();
            }
            // Enviamos los perfiles para que se carguen al momento de agregar o editar un usuario.
            $this->load->model('Perfil_Model');
            $perfiles = $this->Perfil_Model->getPerfil();
            if (is_array($perfiles)) {
                $data['perfiles'] = $perfiles;
            }
            $data['active'] = 'Administración'; // Hacemos que se muestre activo el menu Administracion
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'bootstrap-tab', 'bootstrap-modal', 'validate', 'jquery.alerts');
            $data['jsPropio'] = array('usuarios/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Usuarios';
            $data['subtitle'] = 'Administraci&oacute;n de Usuarios';
            $data['main_content'] = 'usuarios';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validateUserAjax() {
        $this->load->library('validator');
        $response =
                '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
                '<response>' .
                '<result>' .
                $this->validator->validateAJAX($this->input->post('inputValue'), $this->input->post('fieldID')) .
                '</result>' .
                '<fieldid>' .
                $this->input->post('fieldID') .
                '</fieldid>' .
                '</response>';
        // genera la respuesta
        if (ob_get_length())
            ob_clean();
        header('Content-Type: text/xml');
        echo $response;
    }

    /**
     *  Nos permitirá enviar email para validación de usuario.
     * @access      private 
     */
    function _sendEmail($to, $code, $id_user) {
        // Enviamos correo al nuevo usuario para que active su cuenta
        $this->email->from('jolupeza@hotmail.com', 'SISTCORP');
        $this->email->to($to);
        //$this->email->cc('jolupeza@gmail.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject('Registro de su cuenta en SISTCORP');
        $this->email->message('Su cuenta esta pendiente de activaci&oacute;n. Click en el siguiente enlace ' . anchor(base_url() . 'login/register_confirm/' . $code . '/' . $id_user, 'Click aqu&iacute;'));
        $this->email->send();
    }

    /**
     * Realizará validaciones del lado del servidor y si todo esta correcto
     * ingresará el nuevo registro a la base de datos. 
     * @access     public
     */
    function verifyAddUser() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtNomUser', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('txtApePaterno', 'A. Paterno', 'trim|required');
            $this->form_validation->set_rules('txtApeMaterno', 'A. Materno', 'trim|required');
            $this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|min_length[6]|sha1');
            $this->form_validation->set_rules('txtRePassword', 'Repertir password', 'trim|required|min_length[6]|matches[txtPassword]|sha1');
            $this->form_validation->set_rules('txtUsername', 'Usuario', 'trim|callback__verifyExistUser|required');
            $this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|callback__verifyExistEmail');
            $this->form_validation->set_rules('ddlPerfiles', 'Perfil', 'callback__verifySelect');
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('min_length', 'El %s debe contener al menos 6 caracteres');
            $this->form_validation->set_message('valid_email', 'Verificar que %s sea v&aacute;lido');
            $this->form_validation->set_message('_verifyExistUser', '%s ya existe');
            $this->form_validation->set_message('_verifyExistEmail', '%s ya existe');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar un %s');
            $this->form_validation->set_message('matches', 'Los password no coinciden');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $code = $this->_random_string(10);
                $data = array(
                    'Usuario' => $this->input->post('txtUsername'),
                    'PWD' => $this->input->post('txtPassword'),
                    'PWD_JS' => $this->input->post('txtRePassword'),
                    'Nombres' => $this->input->post('txtNomUser'),
                    'Ape_Paterno' => $this->input->post('txtApePaterno'),
                    'Ape_Materno' => $this->input->post('txtApeMaterno'),
                    'Sexo' => $this->input->post('rbtSexo'),
                    'Email' => $this->input->post('txtEmail'),
                    'Telefono' => $this->input->post('txtTelefono'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'Code' => $code,
                    'ID_EMPRESA' => $this->session->userdata('empresa'),
                    'ID_PERFIL' => $this->input->post('ddlPerfiles')
                );
                $result = $this->Usuarios_Model->addUser($data);
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo agregar al nuevo usuario. Por favor verifique que los datos.');
                } else {
                    $this->_sendEmail($this->input->post('txtEmail'), $code, $result);
                    $this->session->set_flashdata('mensaje_exito', 'El nuevo usuario se agregó satisfactoriamente.');
                }
                redirect('administracion/usuarios');
            }
        }
    }

    /**
     * Método para si se seleccionó elemento
     * @param  String  $value
     * @return Boolean
     */
    function _verifySelect($value) {
        if ($value == '0') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Método para verificar que existe el email
     * @param  String  $email
     * @return Boolean
     */
    function _verifyExistEmail($value) {
        $result = $this->Usuarios_Model->verifyEmail($value);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Método para verificar que existe el nombre de usuario
     * @param  String  $username
     * @return Boolean
     */
    function _verifyExistUser($value) {
        $result = $this->Usuarios_Model->getUserByUsername($value);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Método que generará un código aleatorio para la confirmación del 
     * registro del usuario
     * @access     private
     * @param      $length     Tamaño del código aleatorio
     * @return     String      Código aleatorio
     */
    function _random_string($length) {
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789*-+';
        $max = strlen($base) - 1;
        $activation_code = '';
        while (strlen($activation_code) < $length) {
            $activation_code .= $base{mt_rand(0, $max)};
        }
        return $activation_code;
    }

    /**
     * Método que permitirá editar al usuario seleccionado
     * @access     public
     */
    function editUser() {
        if ($this->_is_logged_in()) {
            $result = $this->Usuarios_Model->getUserByID($this->input->post('iduser'));
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de validar que se haya ingresado correctamente los 
     * valores para editar. 
     * @access     public
     */
    function verifyEditUser() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtNomUserEdit', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('txtApePaternoEdit', 'A. Paterno', 'trim|required');
            $this->form_validation->set_rules('txtApeMaternoEdit', 'A. Materno', 'trim|required');
            $this->form_validation->set_rules('txtEditUsername', 'Usuario', 'trim|required');
            $this->form_validation->set_rules('txtEditEmail', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('ddlPerfilesEdit', 'Perfil', 'callback__verifySelect');
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('valid_email', 'Verificar que %s sea v&aacute;lido');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar un %s');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Usuario' => $this->input->post('txtEditUsername'),
                    'Nombres' => $this->input->post('txtNomUserEdit'),
                    'Ape_Paterno' => $this->input->post('txtApePaternoEdit'),
                    'Ape_Materno' => $this->input->post('txtApeMaternoEdit'),
                    'Sexo' => $this->input->post('rbtSexo'),
                    'Email' => $this->input->post('txtEditEmail'),
                    'Telefono' => $this->input->post('txtTelefonoEdit'),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s'),
                    'ID_EMPRESA' => $this->session->userdata('empresa'),
                    'ID_PERFIL' => $this->input->post('ddlPerfilesEdit')
                );
                $id_usuario = $this->input->post('id');

                if ($this->input->post('txtEditUsername') == $this->input->post('hdUsername')) {
                    if ($this->input->post('txtEditEmail') == $this->input->post('hdEmail')) {
                        $result = $this->Usuarios_Model->editUser($data, $id_usuario);
                        if (!$result) {
                            $this->session->set_flashdata('mensaje_error', 'No se pudo editar el usuario. Por favor vuelva a intentarlo.');
                        } else {
                            $this->session->set_flashdata('mensaje_exito', 'El usuario se editó satisfactoriamente.');
                        }
                    } else {
                        if (!$this->Usuarios_Model->verifyEmail($this->input->post('txtEditEmail'))) {
                            $this->session->set_flashdata('mensaje_error', 'No se puede editar el usuario porque el email ya se encuentra registrado.');
                        } else {
                            $code = $this->_random_string(10);
                            $data['Code'] = $code;
                            $data['Activo'] = '0';
                            $result = $this->Usuarios_Model->editUser($data, $id_usuario);
                            if (!$result) {
                                $this->session->set_flashdata('mensaje_error', 'No se pudo editar el usuario. Por favor vuelva a intentarlo.');
                            } else {
                                $this->_sendEmail($this->input->post('txtEditEmail'), $code, $id_usuario);
                                $this->session->set_flashdata('mensaje_exito', 'El usuario se editó satisfactoriamente.');
                            }
                        }
                    }
                } else {
                    if ($this->input->post('txtEditEmail') == $this->input->post('hdEmail')) {
                        if (!$this->Usuarios_Model->getUserByUsername($this->input->post('txtEditUsername'))) {
                            $this->session->set_flashdata('mensaje_error', 'No se puede editar el usuario porque el nombre de usuario esta siendo utilizado.');
                        } else {
                            $result = $this->Usuarios_Model->editUser($data, $id_usuario);
                            if (!$result) {
                                $this->session->set_flashdata('mensaje_error', 'No se pudo editar el usuario. Por favor vuelva a intentarlo.');
                            } else {
                                $this->session->set_flashdata('mensaje_exito', 'El usuario se editó satisfactoriamente.');
                            }
                        }
                    } else {
                        if (!$this->Usuarios_Model->verifyEmail($this->input->post('txtEditEmail')) || !$this->Usuarios_Model->getUserByUsername($this->input->post('txtEditUsername'))) {
                            $this->session->set_flashdata('mensaje_error', 'No se puede editar el usuario porque el nombre de usuario o el email se encuentran registrados.');
                        } else {
                            $code = $this->_random_string(10);
                            $data['Code'] = $code;
                            $data['Activo'] = '0';
                            $result = $this->Usuarios_Model->editUser($data, $id_usuario);
                            if (!$result) {
                                $this->session->set_flashdata('mensaje_error', 'No se pudo editar el usuario. Por favor vuelva a intentarlo.');
                            } else {
                                $this->_sendEmail($this->input->post('txtEditEmail'), $code, $id_usuario);
                                $this->session->set_flashdata('mensaje_exito', 'El usuario se editó satisfactoriamente.');
                            }
                        }
                    }
                }
                redirect('administracion/usuarios');
            }
        }
    }

    /**
     * Función que eliminará de la tabla tbl_perfil el perfil indicado
     * como parámetro
     * @access     public
     */
    function deleteUser() {
        if (!$this->Usuarios_Model->deleteUser($this->uri->segment(4))) {
            $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar al usuario. Por favor vuelva a intentarlo.');
        } else {
            $this->session->set_flashdata('mensaje_exito', 'El usuario se eliminó satisfactoriamente.');
        }
        redirect('administracion/usuarios');
    }

    /**
     * Función que permitirá buscar un determinado perfil
     * @access     public
     */
    function searchUser($text = NULL, $parameter = NULL) {
        if ($this->_is_logged_in()) {
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            if (is_null($text) AND is_null($parameter)) {
                if ($this->input->post('txtText') == '') {
                    redirect('administracion/usuarios');
                } else {
                    $parameter = ($this->input->post('rbtText') == '') ? 'Todos' : $this->input->post('rbtText');
                    $text =$this->input->post('txtText');
                }
            } else {
                $text = urldecode($text);
            }
            
            $num_row = $this->Usuarios_Model->getNumRows($text, $parameter);
            if (is_numeric($num_row) && $num_row > 0) {
                $config['base_url'] = base_url() . 'administracion/usuarios/searchUser/' . urlencode($text) . '/' . $parameter;
                $config['uri_segment'] = '6';
                $config['total_rows'] = $num_row;
                $config['per_page'] = '1';
                $this->pagination->initialize($config);
                $data['users'] = $this->Usuarios_Model->getSearchUser($text, $parameter, $config['per_page'], $this->uri->segment(6));
                $data['pag_links'] = $this->pagination->create_links();
            }

            $this->load->model('Perfil_Model');
            $perfiles = $this->Perfil_Model->getPerfil();
            if (is_array($perfiles)) {
                $data['perfiles'] = $perfiles;
            }
            $data['active'] = 'Administración'; // Hacemos que se muestre activo el menu Administracion
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'bootstrap-tab', 'bootstrap-modal', 'validate', 'jquery.alerts');
            $data['jsPropio'] = array('usuarios/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Usuarios';
            $data['subtitle'] = 'Administraci&oacute;n de Usuarios';
            $data['main_content'] = 'usuarios';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Se encargará de verificar si el usuario se encuentra logueado
     * @access     private
     * @return     boolean     Si no estamos logueados devolverá FALSE
     */
    function _is_logged_in() {
        $is_logged_in = $this->session->userdata('logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            redirect('login');
        } else {
            return TRUE;
        }
    }

}