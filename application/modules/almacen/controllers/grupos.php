<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Nombre       : almacen/controllers/grupos.php
 * Descripción  : Controlador que se encargará de la lógica del negocio referente a los grupos de productos.
 * @author Ing. José Pérez
 */
class Grupos extends MX_Controller 
{

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Grupos_Model');
    }

    /**
     * Se encargará de cargar la vista principal para el control de grupos
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
                    'Grupo' => $this->input->get('Grupo')
                );
            }

            $results = $this->Grupos_Model->getGrupos($query_array, $limit, $this->uri->segment(5));
            $data['grupos'] = $results['rows'];
            $data['query_id'] = $query_id;
            $data['num_rows'] = $results['num_rows'];

            // Obtenemos el número total de registros de la tabla tbl_grupoprod
            if (is_numeric($results['num_rows']) AND $results['num_rows'] > 0) {
                $config['base_url'] = base_url() . 'almacen/grupos/index/' . $query_id;
                $config['total_rows'] = $results['num_rows'];
                $config['per_page'] = '10';
                $config['uri_segment'] = '5';
                $this->pagination->initialize($config);
                $data['pag_links'] = $this->pagination->create_links();
            }

            $this->load->helper(array('funciones_helper'));
            $data['current'] = 'Almacen';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts', 'grupos/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Grupos';
            $data['subtitle'] = 'Administraci&oacute;n de Grupos';
            $data['main_content'] = 'grupos';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validateGrupoAjax() 
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
     * Se encargará de validar que se haya ingresado el nombre del nuevo 
     * grupo. Si no cumple se devuelve a addGrupo. Y si cumple se 
     * agregará el nuevo grupo a la base de datos.
     * @access     public
     */
    function verifyAddGrupo() 
    {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtGrupo', 'Grupo', 'trim|required|callback__verifyExistGrupo');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifyExistGrupo', '%s ya existe');

            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Grupo' => strtr(strtoupper($this->input->post('txtGrupo')), "àèìòùáéíóúçñäëïöü", "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'ID_EMPRESA' => $this->session->userdata('empresa')
                );
                $result = $this->Grupos_Model->addGrupo($data);
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se puedo agregar el nuevo grupo. Por favor verifique que no exista.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'El nuevo grupo se agreg&oacute; satisfactoriamente.');
                }
                redirect('almacen/grupos');
            }
        }
    }

    /**
     * Verificamos que el grupo a insertar no este registrado
     * @param str $grupo
     * @return boolean
     */
    function _verifyExistGrupo($grupo) 
    {
        $result = $this->Grupos_Model->verifyExistGrupo($grupo);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Método que permitirá traer los datos del grupo a editar
     * @access     public
     * @param      integer     $id_perfil  Contiene el id del grupo a editar
     */
    function getGrupo() 
    {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idgrupo');
            $result = $this->Grupos_Model->getGrupoByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de actualizar los datos editados del grupo seleccionado
     * @access     public
     */
    function verifyEditGrupo() 
    {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtGrupoEdit', 'Grupo', 'trim|required');
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Grupo' => strtr(strtoupper($this->input->post('txtGrupoEdit')), "àèìòùáéíóúçñäëïöü", "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ"),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s')
                );
                $grupoAnterior = $this->input->post('hdGrupo');
                $idGrupo = $this->input->post('id');

                // Con este código verificamos en caso se haya ingresado distinto
                // nombre de grupo, que no hayamos ingresado un grupo que ya existe
                if (strtr(strtoupper($this->input->post('txtGrupoEdit')), "àèìòùáéíóúçñäëïöü", "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ") == $grupoAnterior) {
                    $result = $this->Grupos_Model->editGrupo($data, $idGrupo);
                    if (!$result) {
                        $this->session->set_flashdata('mensaje_error', 'No se pudo editar el grupo. Por favor vuelva a intentarlo.');
                    } else {
                        $this->session->set_flashdata('mensaje_exito', 'El grupo se editó satisfactoriamente.');
                    }
                } else {
                    if (!$this->Grupos_Model->verifyExistGrupo($this->input->post('txtGrupoEdit'))) {
                        $this->session->set_flashdata('mensaje_error', 'No se puede editar el grupo porque el nombre ya ha sido registrado.');
                    } else {
                        $result = $this->Grupos_Model->editGrupo($data, $idGrupo);
                        if (!$result) {
                            $this->session->set_flashdata('mensaje_error', 'No se pudo editar el grupo. Por favor vuelva a intentarlo.');
                        } else {
                            $this->session->set_flashdata('mensaje_exito', 'El grupo se editó satisfactoriamente.');
                        }
                    }
                }
                redirect('almacen/grupos');
            }
        }
    }

    /**
     * Método para buscar un determinado Grupo
     * @access     public 
     */
    function searchGrupo() 
    {
        if ($this->_is_logged_in()) {     
            if ($this->input->post('txtNomGrupo') != '') {
                $query_array = array(
                    'Grupo' => $this->input->post('txtNomGrupo')
                );

                $query_id = $this->input->save_query($query_array);
                redirect('almacen/grupos/index/' . $query_id);
            } else {
                redirect('almacen/grupos/index');
            }   
        }
    }

    /**
     * Función que eliminará de la tabla tbl_grupoprod el grupo indicado
     * como parámetro
     * @access     public
     */
    function deleteGrupo() 
    {
        if ($this->_is_logged_in()) {
            if ($this->uri->segment(4)) {
                $grupo = $this->Grupos_Model->getGrupoByID($this->uri->segment(4));
                if (count($grupo) && is_object($grupo)) {
                    if (!$this->Grupos_Model->deleteGrupo($this->uri->segment(4))) {
                        $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar el grupo. Por favor vuelva a intentarlo.');
                    } else {
                        $this->session->set_flashdata('mensaje_exito', 'El grupo se eliminó satisfactoriamente.');
                    }
                    redirect('almacen/grupos');
                }                
            }            
        }
    }

    /**
     * Se encargará de verificar si el usuario se encuentra logueado
     * @access     private
     * @return     boolean     Si no estamos logueados devolverá FALSE
     */
    function _is_logged_in() 
    {
        $is_logged_in = $this->session->userdata('logged_in');
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            redirect('usuarios');
        } else {
            return TRUE;
        }
    }

}