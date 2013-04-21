<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Nombre       : controllers/almacen/marcas.php
 * Descripción  : Controlador que se encargará de la lógica del negocio referente a las marcas
 * @author Ing. José Pérez
 */
class Marcas extends MX_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Marcas_Model');
        $this->lang->load('upload', 'spanish');
    }

    /**
     * Se encargará de cargar la vista principal para el control de marcas
     * @param      $mensaje     Se mostrará en caso de quere presentar un mensaje
     * @access     public
     */
    function index($query_id = 0) 
    {
        if ($this->_is_logged_in()) {
            $limit = 10;
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }
            
            $query_array = array();
            if ($query_id > 0) {
                $this->input->load_query($query_id);
                $query_array = array(
                    'Marca' => $this->input->get('Marca')
                );
            }
            
            $results = $this->Marcas_Model->getMarcas($query_array, $limit, $this->uri->segment(5));
            
            $data['marcas'] = $results['rows'];
            $data['query_id'] = $query_id;
            $data['num_rows'] = $results['num_rows'];

            if (is_numeric($results['num_rows']) AND $results['num_rows'] > 0) {
                $config['base_url'] = base_url() . 'almacen/marcas/index/' . $query_id;
                $config['total_rows'] = $results['num_rows'];
                $config['per_page'] = '10';
                $config['uri_segment'] = '5';
                $this->pagination->initialize($config);
                $data['pag_links'] = $this->pagination->create_links();
            }

            $this->load->helper(array('funciones_helper'));
            $data['current'] = 'Almacen';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts', 'marcas/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Marcas';
            $data['subtitle'] = 'Administraci&oacute;n de Marcas';
            $data['main_content'] = 'marcas';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validateMarcaAjax() 
    {
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
    function verifyAddMarca() 
    {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtMarca', 'Marca', 'trim|required|callback__verifyMarca');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifyMarca', '%s ya existe');

            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                if ($_FILES['flFoto']['name'] && $_FILES['flFoto']['name'] != '') {
                    $marca = str_replace(" ", "_", $this->input->post('txtMarca'));
                    $config['upload_path'] = './images/marcas/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['file_name'] = $marca;
                    $config['max_size'] = '100';
                    $config['max_width'] = '65';
                    $config['max_height'] = '25';
                    $this->load->library('upload', $config);
                    if(!$this->upload->do_upload('flFoto')){
                        $this->session->set_flashdata('mensaje_error', $this->upload->display_errors());
                    } else {
                        $foto_info = $this->upload->data();
                        $data = array(
                            'Marca' => $this->input->post('txtMarca'),
                            'Foto' => $foto_info['file_name'],
                            'Activo' => $this->input->post('ddlActivo'),
                            'User_Creacion' => $this->session->userdata('id_user'),
                            'Fec_Creacion' => date('Y-m-d H:i:s'),
                            'ID_EMPRESA' => $this->session->userdata('empresa')
                        );
                        $result = $this->Marcas_Model->addMarca($data);
                        if (!$result) {
                            $this->session->set_flashdata('mensaje_error', 'No se puedo agregar la nueva marca. Por favor vuelva a intentarlo.');
                        } else {
                            $this->session->set_flashdata('mensaje_exito', 'La nueva marca se agreg&oacute; satisfactoriamente.');
                        }
                    }
                } else {
                    $data = array(
                        'Marca' => $this->input->post('txtMarca'),
                        'Activo' => $this->input->post('ddlActivo'),
                        'User_Creacion' => $this->session->userdata('id_user'),
                        'Fec_Creacion' => date('Y-m-d H:i:s'),
                        'ID_EMPRESA' => $this->session->userdata('empresa')
                    );
                    $result = $this->Marcas_Model->addMarca($data);
                    if (!$result) {
                        $this->session->set_flashdata('mensaje_error', 'No se puedo agregar la nueva marca. Por favor vuelva a intentarlo.');
                    } else {
                        $this->session->set_flashdata('mensaje_exito', 'La nueva marca se agreg&oacute; satisfactoriamente.');
                    }
                }
                redirect('almacen/marcas');
            }
        }
    }

    /**
     * Verificamos si Marca esta registrado o no.
     * @param str $marca    Marca a evaluar
     * @return boolean      True en caso de no estar registrado y false en caso de si.
     */
    function _verifyMarca($marca) 
    {
        if ($this->Marcas_Model->getMarca($marca)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Método que permitirá traer los datos de la marca a editar
     * @access     public
     */
    function getMarca() 
    {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idMarca');
            $result = $this->Marcas_Model->getMarcaByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de actualizar los datos editados de la marca seleccionada
     * @access     public
     */
    function verifyEditMarca() 
    {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtEditMarca', 'Clase', 'trim|required');
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                if ($_FILES['flFoto']['name'] && $_FILES['flFoto']['name'] != '') {
                    if (unlink(ROOT . 'images/marcas/' . $this->input->post('hdFoto'))) {
                        $marca = str_replace(" ", "_", $this->input->post('txtEditMarca'));
                        $config['upload_path'] = './images/marcas/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['file_name'] = $marca;
                        $config['max_size'] = '100';
                        $config['max_width'] = '65';
                        $config['max_height'] = '25';
                        $this->load->library('upload', $config);
                        if(!$this->upload->do_upload('flFoto')){
                            $this->session->set_flashdata('mensaje_error', $this->upload->display_errors());
                        } else {
                            $foto_info = $this->upload->data();
                            $data = array(
                                'Marca' => $this->input->post('txtEditMarca'),
                                'Foto' => $foto_info['file_name'],
                                'Activo' => $this->input->post('ddlActivo'),
                                'User_Modificacion' => $this->session->userdata('id_user'),
                                'Fec_Modificacion' => date('Y-m-d H:i:s'),
                                'ID_EMPRESA' => $this->session->userdata('empresa')
                            );
                            $result = $this->Marcas_Model->editMarca($data, $this->input->post('hdId'));
                            if (!$result) {
                                $this->session->set_flashdata('mensaje_error', 'No se puedo editar la marca. Por favor vuelva a intentarlo.');
                            } else {
                                $this->session->set_flashdata('mensaje_exito', 'La marca se actualiz&oacute; satisfactoriamente.');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('mensaje_error', 'No se puedo editar la marca. Por favor vuelva a intentarlo.');
                    }
                } else {
                    $data = array(
                        'Marca' => $this->input->post('txtEditMarca'),
                        'Activo' => $this->input->post('ddlActivo'),
                        'User_Modificacion' => $this->session->userdata('id_user'),
                        'Fec_Modificacion' => date('Y-m-d H:i:s'),
                        'ID_EMPRESA' => $this->session->userdata('empresa')
                    );
                    $result = $this->Marcas_Model->editMarca($data, $this->input->post('hdId'));
                    if (!$result) {
                        $this->session->set_flashdata('mensaje_error', 'No se puedo editar la marca. Por favor vuelva a intentarlo.');
                    } else {
                        $this->session->set_flashdata('mensaje_exito', 'La marca se actualiz&oacute; satisfactoriamente.');
                    }
                }
                redirect('almacen/marcas');
            }
        }
    }

    /**
     * Método para buscar una determinada Marca
     * @access     public 
     */
    function searchMarca() 
    {
        if ($this->_is_logged_in()) {
            if ($this->input->post('txtNomMarca') != '') {
                $query_array = array(
                    'Marca' => $this->input->post('txtNomMarca')
                );
                $query_id = $this->input->save_query($query_array);
                redirect('almacen/marcas/index/' . $query_id);
            } else {
                redirect('almacen/marcas/index');
            }
        }
    }

    /**
     * Función que eliminará de la tabla tbl_claseprod la clase indicada
     * como parámetro
     * @access     public
     */
    function deleteMarca() 
    {
        if ($this->_is_logged_in()) {
            if ($this->uri->segment(4)){
                $marca = $this->Marcas_Model->getMarcaByID($this->uri->segment(4));
                if (count($marca) && is_object($marca)) {
                    if (!$this->Marcas_Model->deleteMarca($this->uri->segment(4))) {
                        $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar la clase. Por favor vuelva a intentarlo.');
                    } else {
                        unlink(ROOT . 'images/marcas/' . $marca->Foto);
                        $this->session->set_flashdata('mensaje_exito', 'La clase se eliminó satisfactoriamente.');
                    }
                }
            } 
            redirect('almacen/marcas');
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