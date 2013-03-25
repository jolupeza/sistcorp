<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Nombre       : controllers/almacen/clases.php
 * Descripción  : Controlador que se encargará de la lógica del negocio referente a las clases de productos
 * @author Ing. José Pérez
 */
class Clases extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Clases_Model');
    }

    /**
     * Se encargará de cargar la vista principal para el control de clases
     * @param      $mensaje     Se mostrará en caso de quere presentar un mensaje
     * @access     public
     */
    function index() {
        if ($this->_is_logged_in()) {
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            // Obtenemos el número total de registros de la tabla tbl_claseprod
            $num_rows = $this->Clases_Model->getNumRows();
            if (is_numeric($num_rows) AND $num_rows > 0) {
                $config['base_url'] = base_url() . 'almacen/clases/index';
                $config['total_rows'] = $num_rows;
                $config['per_page'] = '10';
                $config['uri_segment'] = '4';
                $this->pagination->initialize($config);
                $data['clases'] = $this->Clases_Model->getClasesLimit($config['per_page'], $this->uri->segment(4));
                $data['pag_links'] = $this->pagination->create_links();
            }

            $this->load->model('Grupos_Model');
            $grupos = $this->Grupos_Model->getGrupos();
            if (is_array($grupos)) {
                $data['grupos'] = $grupos;
            }
            $this->load->helper(array('funciones_helper'));
            $data['current'] = 'Almacen';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts', 'clases/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute; de Clases';
            $data['subtitle'] = 'Administraci&oacute;n de Clases';
            $data['main_content'] = 'clases';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validateClaseAjax() {
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
     * Método que recojerá los datos de la nueva clase, realizará una validación php 
     * y de estar todo correcto agregará la nueva clase.
     * @access     public
     */
    function verifyAddClase() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtClase', 'Clase', 'trim|required');
            $this->form_validation->set_rules('ddlGrupo', 'Grupo', 'callback__verifySelectGrupo');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifyExistClase', '%s ya existe');
            $this->form_validation->set_message('_verifySelectGrupo', 'Debe seleccionar el %s de la clase');

            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Clase' => $this->input->post('txtClase'),
                    'Activo' => $this->input->post('ddlActivo'),
                    'ID_GRUPOPROD' => $this->input->post('ddlGrupo'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'ID_EMPRESA' => $this->session->userdata('empresa')
                );
                $result = $this->Clases_Model->addClase($data);
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se puedo agregar la nueva clase. Por favor verifique que no exista.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'La nueva clase se agreg&oacute; satisfactoriamente.');
                }
                redirect('almacen/clases');
            }
        }
    }

    /**
     * Método que verificará que se haya seleccionado el grupo para la clase a insertar
     * @param type $grupo   Grupo seleccionado
     * @return boolean 
     */
    function _verifySelectGrupo($grupo) {
        if ($grupo == '0') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Método que permitirá traer los datos de la clase a editar
     * @access     public
     */
    function editClase() {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idClase');
            $result = $this->Clases_Model->getClaseByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de actualizar los datos editados de la clase seleccionada
     * @access     public
     */
    function verifyEditClase() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtClaseEdit', 'Clase', 'trim|required');
            $this->form_validation->set_rules('ddlGrupoEdit', 'Grupo', 'callback__verifySelectGrupo');
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('_verifySelectGrupo', 'Debe seleccionar el %s de la clase');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Clase' => $this->input->post('txtClaseEdit'),
                    'ID_GRUPOPROD' => $this->input->post('ddlGrupoEdit'),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s')
                );

                $result = $this->Clases_Model->editClase($data, $this->input->post('id'));
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo editar la clase. Por favor vuelva a intentarlo.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'La clase se editó satisfactoriamente.');
                }
                redirect('almacen/clases');
            }
        }
    }

    /**
     * Función que permitirá buscar un determinado perfil
     * @access     public
     */
    function searchClase($text = NULL) {
        if ($this->_is_logged_in()) {
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            if (is_null($text)) {
                if ($this->input->post('txtNomClase') == '') {
                    redirect('almacen/clases');
                } else {
                    $text = $this->input->post('txtNomClase');
                }
            } else {
                $text = urldecode($text);
            }

            $num_row = $this->Clases_Model->getNumRows($text);
            if (is_numeric($num_row) AND $num_row > 0) {
                $config['base_url'] = base_url() . 'almacen/clases/searchClase/' . urlencode($text);
                $config['total_rows'] = $num_row;
                $config['per_page'] = '10';
                $config['uri_segment'] = '5';
                $this->pagination->initialize($config);
                $data['clases'] = $this->Clases_Model->getSearchClase($text, $config['per_page'], $this->uri->segment(5));
                $data['pag_links'] = $this->pagination->create_links();
            }

            $this->load->model('Grupos_Model');
            $grupos = $this->Grupos_Model->getGrupos();
            if (is_array($grupos)) {
                $data['grupos'] = $grupos;
            }
            $this->load->helper(array('funciones_helper'));
            $data['current'] = 'Almacén';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts', 'clases/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Clases';
            $data['subtitle'] = 'Administraci&oacute;n de Clases';
            $data['main_content'] = 'clases';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Función que eliminará de la tabla tbl_claseprod la clase indicada
     * como parámetro
     * @access     public
     */
    function deleteClase() {
        if (!$this->Clases_Model->deleteClase($this->uri->segment(4))) {
            $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar la clase. Por favor vuelva a intentarlo.');
        } else {
            $this->session->set_flashdata('mensaje_exito', 'La clase se eliminó satisfactoriamente.');
        }
        redirect('almacen/clases');
    }

    /**
     * Se encargará de verificar si el usuario se encuentra logueado
     * @access     private
     * @return     boolean     Si no estamos logueados devolverá FALSE
     */
    function _is_logged_in() {
        $is_logged_in = $this->session->userdata('logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            redirect('usuarios');
        } else {
            return TRUE;
        }
    }

}