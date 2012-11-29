<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Nombre       : administracion/controllers/perfil.php
 * Descripción  : Controlador que se encargará de administrar los perfiles de usuarios disponibles en la aplicación.
 * @author Ing. José Pérez
 */
class Perfil extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Perfil_Model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
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

            $num_row = $this->Perfil_Model->getNumRows();
            if (is_numeric($num_row) && $num_row > 0) {
                $config['base_url'] = base_url() . 'administracion/perfil/index';
                $config['total_rows'] = $num_row;
                $config['per_page'] = '5';
                $config['uri_segment'] = '4';
                $this->pagination->initialize($config);
                $data['perfil'] = $this->Perfil_Model->getPerfilLimit($config['per_page'], $this->uri->segment(4));
                $data['pag_links'] = $this->pagination->create_links();
            }

            $data['active'] = 'Administración'; // Hacemos que se muestre activo el menu Administracion
            $data['cssLoad'] = array('jquery.alerts');
            //$data['jsLoad'] = array('funciones', 'bootstrap-tab', 'bootstrap-modal', 'validate', 'jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts');
            $data['jsPropio'] = array('perfil/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Perfiles';
            $data['subtitle'] = 'Administraci&oacute;n de Perfiles';
            $data['main_content'] = 'perfil';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validatePerfilAjax() {
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
     * Realizará validaciones del lado del servidor y si todo esta correcto
     * ingresará el nuevo registro a la base de datos. 
     * @access     public
     */
    function verifyAddPerfil() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtPerfil', 'Perfil', 'trim|required|callback__verifyExistPerfil');
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('_verifyExistPerfil', '%s ya existe');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Perfil' => strtoupper($this->input->post('txtPerfil')),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'ID_EMPRESA' => $this->session->userdata('empresa')
                );
                $result = $this->Perfil_Model->addPerfil($data);
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo agregar el nuevo perfil. Por favor verifique que los datos.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'El nuevo perfil se agregó satisfactoriamente.');
                }
                redirect('administracion/perfil');
            }
        }
    }

    /**
     * Método para verificar que existe el perfil a añadir
     * @param  String  $perfil
     * @return Boolean
     */
    function _verifyExistPerfil($perfil) {
        $result = $this->Perfil_Model->getPerfilByName($perfil);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Método que nos devolverá los datos del perfil a editar
     * @access     public
     * @param      integer     $id_perfil  Contiene el id del perfil a editar
     */
    function editPerfil() {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idperfil');
            $result = $this->Perfil_Model->getPerfilByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de validar que se haya ingresado correctamente los valores para editar. Si no cumple se devuelve 
     * a editPerfil. Y si cumple se actualizará el perfil en la base de datos.
     * @access     public
     */
    function verifyEditPerfil() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtPerfilEdit', 'Perfil', 'trim|required');
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Perfil' => strtoupper($this->input->post('txtPerfilEdit')),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s'),
                );
                // Con este código verificamos en caso se haya ingresado distinto
                // nombre de perfil que no hayamos ingresado un perfil que ya existe
                if (strtoupper($this->input->post('txtPerfilEdit')) == $this->input->post('hdPerfil')) {
                    $result = $this->Perfil_Model->editPerfil($data, $this->input->post('id'));
                    if (!$result) {
                        $this->session->set_flashdata('mensaje_error', 'No se pudo editar el perfil. Por favor verifique que los datos sean correctos.');
                    } else {
                        $this->session->set_flashdata('mensaje_exito', 'El perfil se editó satisfactoriamente.');
                    }
                } else {
                    if (!$this->Perfil_Model->getPerfilByName(strtoupper($this->input->post('txtPerfilEdit')))) {
                        $this->session->set_flashdata('mensaje_error', 'No se pudo editar el perfil por que el nombre ya ha sido registrado.');
                    } else {
                        $result = $this->Perfil_Model->editPerfil($data, $this->input->post('id'));
                        if (!$result) {
                            $this->session->set_flashdata('mensaje_error', 'No se pudo editar el perfil. Por favor verifique que los datos sean correctos.');
                        } else {
                            $this->session->set_flashdata('mensaje_exito', 'El perfil se editó satisfactoriamente.');
                        }
                    }
                }
                redirect('administracion/perfil');
            }
        }
    }

    /**
     * Función que eliminará de la tabla tbl_perfil el perfil indicado
     * como parámetro
     * @access     public
     */
    function deletePerfil() {
        if (!$this->Perfil_Model->deletePerfil($this->uri->segment(4))) {
            $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar el perfil. Por favor vuelva a intentarlo.');
        } else {
            $this->session->set_flashdata('mensaje_exito', 'El perfil se eliminó satisfactoriamente.');
        }
        redirect('administracion/perfil');
    }

    /**
     * Función que permitirá buscar un determinado perfil
     * @access     public
     */
    function searchPerfil($texto = NULL) {
        if ($this->_is_logged_in()) {
            $this->load->model('Modulos_Model');
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            if (is_null($texto)) {
                if ($this->input->post('txtNomPerfil') == '') {
                    redirect('administracion/perfil');
                } else {
                    $texto = $this->input->post('txtNomPerfil');
                }
            } else {
                $texto = urldecode($texto);
            }

            $num_row = $this->Perfil_Model->getNumRows($texto);
            if (is_numeric($num_row) AND $num_row > 0) {
                $config['base_url'] = base_url() . 'administracion/perfil/searchPerfil/' . urlencode($texto);
                $config['total_rows'] = $num_row;
                $config['per_page'] = '5';
                $config['uri_segment'] = '5';
                $this->pagination->initialize($config);
                $data['perfil'] = $this->Perfil_Model->getSearchPerfil($texto, $config['per_page'], $this->uri->segment(5));
                $data['pag_links'] = $this->pagination->create_links();
            }
            $data['current'] = 'Administración';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones',  'validate', 'jquery.alerts');
            $data['jsPropio'] = array('perfil/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Perfiles';
            $data['subtitle'] = 'Administraci&oacute;n de Perfiles';
            $data['main_content'] = 'perfil';
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