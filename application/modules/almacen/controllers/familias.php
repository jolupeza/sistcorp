<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Nombre       : controllers/almacen/familias.php
 * Descripción  : Controlador que se encargará de la lógica del negocio 
 *                referente a las familias de los productos
 * @author Ing. José Pérez
 */
class Familias extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Familias_Model');
    }

    /**
     * Se encargará de cargar la vista principal para el control de familias
     * @access     public
     */
    function index() {
        if ($this->_is_logged_in()) {
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            $this->load->model('Grupos_Model');
            $grupos = $this->Grupos_Model->getGrupos();
            if (is_array($grupos)) {
                $data['grupos'] = $grupos;
            }
            $this->load->helper(array('funciones_helper'));
            $data['current'] = 'Almacén';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts', 'familias/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Familias';
            $data['subtitle'] = 'Administraci&oacute;n de Familias';
            $data['main_content'] = 'familias';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    function listFamilia($offset = '') {
        $limit = '15';
        $total = $this->Familias_Model->getNumRows();
        if (is_numeric($total) AND $total > 0) {
            $data['familias'] = $this->Familias_Model->getFamiliasLimit($limit, $offset);
            $config['base_url'] = base_url() . 'almacen/familias/listFamilia';
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['uri_segment'] = '4';
            $this->pagination->initialize($config);
            $data['pag_links'] = $this->pagination->create_links();
            $this->load->view('almacen/listFamilia', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validateFamiliaAjax() {
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
     *  Método que via ajax nos envía las clases de acuerdo al grupo seleccionado
     * @access      public 
     */
    function getClases() {
        $id = $this->input->post('grupoId');
        $this->load->model('Clases_Model');
        $clases = $this->Clases_Model->getClasesByGrupo($id);
        if (is_array($clases) && count($clases) > 0) {
            echo json_encode($clases);
        }
    }

    /**
     * Método que recojerá los datos de la nueva familia, realizará una validación php 
     * y de estar todo correcto agregará la nueva familia de productos.
     * @access     public
     */
    function verifyAddFamilia() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtFamilia', 'Familia', 'trim|required');
            $this->form_validation->set_rules('ddlGrupo', 'Grupo', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlClase', 'Clase', 'callback__verifySelect');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar %s de la familia');

            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_flashdata('mensaje_error', 'No se puede agregar la nueva familia. Por favor verifique los datos ingresados y que haya seleccionado el grupo y clase.');
                redirect('almacen/familias');
            } else {
                $data = array(
                    'Familia' => ucfirst($this->input->post('txtFamilia')),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'ID_GRUPOPROD' => $this->input->post('ddlGrupo'),
                    'ID_CLASEPROD' => $this->input->post('ddlClase'),
                    'ID_EMPRESA' => $this->session->userdata('empresa')
                );
                $result = $this->Familias_Model->addFamilia($data);
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se puede agregar la nueva familia. Por favor verifique que no exista.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'La nueva familia se agreg&oacute; satisfactoriamente.');
                }
                redirect('almacen/familias');
            }
        }
    }

    /**
     * Método que verificará que se haya seleccionado la clase o el grupo para la familia a insertar
     * @param type $clase   Clase seleccionado
     * @return boolean 
     */
    function _verifySelect($value) {
        if ($value == '0') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Método que permitirá traer los datos de la familia a editar
     * @access     public
     */
    function editFamilia() {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idFamilia');
            $result = $this->Familias_Model->getFamiliaByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de actualizar los datos editados de la familia seleccionada
     * @access     public
     */
    function verifyEditFamilia() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtFamiliaEdit', 'Familia', 'trim|required');
            $this->form_validation->set_rules('ddlClaseEdit', 'Clase', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlGrupoEdit', 'Grupo', 'callback__verifySelect');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar %s de la familia');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('mensaje_error', 'No se puede editar la familia. Por favor verifique los datos ingresados y que haya seleccionado el grupo y clase.');
                redirect('almacen/familias');
            } else {
                $data = array(
                    'Familia' => ucfirst($this->input->post('txtFamiliaEdit')),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s'),
                    'ID_GRUPOPROD' => $this->input->post('ddlGrupoEdit'),
                    'ID_CLASEPROD' => $this->input->post('ddlClaseEdit')
                );
                $result = $this->Familias_Model->editFamilia($data, $this->input->post('id'));
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo editar la familia. Por favor vuelva a intentarlo.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'La familia se editó satisfactoriamente.');
                }
                redirect('almacen/familias');
            }
        }
    }

    /**
     * Función que permitirá buscar un determinado perfil
     * @access     public
     */
    function searchFamilia($search) {
        $limit = '15';
        $total = $this->Familias_Model->getNumRows(urldecode($search));
        if (is_numeric($total) AND $total > 0) {
            $config['base_url'] = base_url() . 'almacen/familias/searchFamilia/' . $search;
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['uri_segment'] = '5';
            $this->pagination->initialize($config);
            $data['familias'] = $this->Familias_Model->searchFamilia(urldecode($search), $limit, $this->uri->segment(5));
            $data['pag_links'] = $this->pagination->create_links();
            $this->load->view('almacen/listFamilia', $data);
        }
    }

    /**
     * Función que eliminará de la tabla tbl_claseprod la clase indicada
     * como parámetro
     * @access     public
     */
    function deleteFamilia() {
        $result = $this->Familias_Model->deleteFamilia($this->uri->segment(4));
        if (!$result) {
            $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar la familia. Por favor vuelva a intentarlo.');
        } else {
            $this->session->set_flashdata('mensaje_exito', 'La familia se eliminó satisfactoriamente.');
        }
        redirect('almacen/familias');
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