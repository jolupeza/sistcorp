<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Nombre       : administracion/controllers/acciones.php
 * Descripción  : Controlador que se encargará de administrar los permisos de los roles
 *                y de los usuarios.
 * @author Ing. José Pérez
 */
class Acciones extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Acciones_Model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    function index($query_id = 0, $sort_by = 'Accion', $sort_order = 'asc', $registros = 10)
    {
        if ($this->_is_logged_in()) {
            if ( !$this->acl->hasPermission('perm_view') ) {
                $this->session->set_flashdata('mensaje_error', 'No tiene el permiso para acceder a esta página');
                redirect('/dashboard/');
            }

            $data = array();
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            $data['fields'] = array(
                'ID_ACCION' =>  'ID',
                'Accion'    =>  'Permiso',
                'Activo'    =>  'Activo',
                'Opcion'    =>  'Opcion',
                'AccionKey' =>  'Clave'
            );
            $data['sort_by'] = $sort_by;
            $data['sort_order'] = $sort_order;

            $query_array = array();
            if ($query_id > 0) {
                $this->input->load_query($query_id);
                $query_array = array(
                    'Accion'    =>  $this->input->get('Accion'),
                    'Opcion'    =>  $this->input->get('Opcion'),
                    'Key'       =>  $this->input->get('Clave')
                );
            }

            $registros = (int) $registros;
            $results = $this->Acciones_Model->getAcciones($query_array, $registros, $this->uri->segment(8), $sort_by, $sort_order);

            $data['acciones']  = $results['rows'];
            $data['num_rows']  = $results['num_rows'];
            $data['registros'] = $registros;

            if (is_numeric($results['num_rows']) && $results['num_rows'] > 0) {
                $config['base_url'] = site_url('administracion/acciones/index/' . $query_id . '/' . $sort_by . '/' . $sort_order . '/' . $registros);
                $config['uri_segment'] = 8;
                $config['total_rows'] = $results['num_rows'];
                $config['per_page'] = $registros;

                $this->pagination->initialize($config);
                $data['pag_links'] = $this->pagination->create_links();
            }

            // Obtenemos las opciones y la enviamos a la vista para que se cargen al momento de agregar o editar algún permiso
            $op = $this->Acciones_Model->getAllOpciones();
            if (is_array($op) && count($op)) {
                $data['opciones'] = $op;
            }

            $this->load->helper(array('funciones_helper'));
            $data['active'] = 'Administración'; // Hacemos que se muestre activo el menu Administracion
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts', 'acciones/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Permisos';
            $data['subtitle'] = 'Administraci&oacute;n de Permisos';
            $data['main_content'] = 'acciones';
            $this->load->view('themes/admin/template.php', $data);
        }
    }

    /**
     * Función que permitirá buscar permisos
     * @access     public
     */
    function searchPermisos($registros)
    {
        if ($this->_is_logged_in()) {
            $txtPermisoSearch = $this->input->post('txtPermisoSearch');
            $txtOpcionSearch = $this->input->post('txtOpcionSearch');
            $txtClaveSearch = $this->input->post('txtClaveSearch');

            if (empty($txtPermisoSearch) AND empty($txtOpcionSearch) AND empty($txtClaveSearch)) {
                redirect('administracion/acciones/index/0/Accion/asc/' . $registros);
            }

            $query_array = array(
                'Accion'    =>  $this->input->post('txtPermisoSearch'),
                'Opcion'    =>  $this->input->post('txtOpcionSearch'),
                'Clave'     =>  $this->input->post('txtClaveSearch')
            );

            $query_id = $this->input->save_query($query_array);
            redirect('administracion/acciones/index/' . $query_id . '/Acciones/asc/' . $registros);
        }
    }

    function viewPdf()
    {
        if ($this->_is_logged_in()) {
            if ( !$this->acl->hasPermission('perm_view') ) {
                $this->session->set_flashdata('mensaje_error', 'No tiene el permiso para acceder a esta página');
                redirect('/dashboard/');
            }

            $this->load->library('html2pdf');

            $this->html2pdf->folder('./assets/admin/tpl_proyecta/file/pdfs/');

            //establecemos el nombre del archivo
            $this->html2pdf->filename('permisos.pdf');

            //establecemos el tipo de papel
            $this->html2pdf->paper('a4', 'portrait');

            //datos que queremos enviar a la vista, lo mismo de siempre
            $data = array(
                'title' => 'Listado de las provincias españolas en pdf',
                'provincias' => $this->pdf_model->getProvincias()
            );

            //hacemos que coja la vista como datos a imprimir
            //importante utf8_decode para mostrar bien las tildes, ñ y demás
            $this->html2pdf->html(utf8_decode($this->load->view('pdf', $data, true)));

            //si el pdf se guarda correctamente lo mostramos en pantalla
            if($this->html2pdf->create('save')){
                $this->show();
            }
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validatePermisoAjax()
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
     * Realizará validaciones del lado del servidor y si todo esta correcto
     * ingresará el nuevo registro a la base de datos.
     * @access     public
     */
    function verifyAddPermiso()
    {
        if ($this->_is_logged_in()) {
            if ( !$this->acl->hasPermission('perm_add') ) {
                $this->session->set_flashdata('mensaje_error', 'No tiene el permiso para acceder a esta página');
                redirect('/dashboard/');
            }

            $this->form_validation->set_rules('txtPermiso', 'Permiso', 'trim|required|callback__verifyPermiso');
            $this->form_validation->set_rules('txtKey', 'Key', 'trim|required|callback__verifyKey');
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('_verifyPermiso', '%s ya existe');
            $this->form_validation->set_message('_verifyKey', '%s ya existe');
            if ($this->form_validation->run($this) == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Accion' => ucwords($this->input->post('txtPermiso')),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'ID_OPCION' => $this->input->post('ddlOpcion'),
                    'AccionKey' => strtolower($this->input->post('txtKey')),
                    'ID_EMPRESA' => $this->session->userdata('empresa')
                );
                $result = $this->Acciones_Model->addPermiso($data);
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo agregar el nuevo permiso. Por favor verifique que los datos sean correctos.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'El nuevo permiso se agregó satisfactoriamente.');
                }
                redirect('administracion/acciones');
            }
        }
    }

    /**
     * Método que nos devolverá los datos del permiso a editar
     * @access     public
     * @param      integer     $idpermiso  Contiene el id del permiso a editar
     */
    function getPermiso()
    {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idpermiso');
            $result = $this->Acciones_Model->getPermisoByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de validar que se haya ingresado correctamente los valores para editar. Si no cumple se devuelve
     * a index. Y si cumple se actualizará el permiso en la base de datos.
     * @access     public
     */
    function verifyEditPermiso()
    {
        if ($this->_is_logged_in()) {
            if ( !$this->acl->hasPermission('perm_edit_all') ) {
                $this->session->set_flashdata('mensaje_error', 'No tiene el permiso para acceder a esta página');
                redirect('/dashboard/');
            }

            $this->form_validation->set_rules('txtPermisoEdit', 'Permiso', 'trim|required');
            $this->form_validation->set_rules('txtKeyEdit', 'Key', 'trim|required');
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $data = array(
                    'Accion' => ucwords($this->input->post('txtPermisoEdit')),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s'),
                    'ID_OPCION' => $this->input->post('ddlOpcion'),
                    'AccionKey' => strtolower($this->input->post('txtKeyEdit')),
                    'ID_EMPRESA' => $this->session->userdata('empresa')
                );
                // Con este código verificamos en caso se haya ingresado distinto
                // nombre de permiso que no hayamos ingresado un permiso que ya existe
                if (ucwords($this->input->post('txtPermisoEdit')) == ucwords($this->input->post('hdPermiso'))) {
                    if (strtolower($this->input->post('txtKeyEdit')) == strtolower($this->input->post('hdKey'))) {
                        $this->_editPermiso($data, $this->input->post('id'));
                    } else {
                        // Verificamos el key ha ingresar no se encuentre registrado
                        if ($this->Acciones_Model->verifyKey(strtolower($this->input->post('txtKeyEdit')))) {
                            $this->_editPermiso($data, $this->input->post('id'));
                        } else {
                            $this->session->set_flashdata('mensaje_error', 'El key que intenta ingresar ya se encuentra registrado.');
                        }
                    }
                } else {
                    if ($this->Acciones_Model->verifyPermiso(ucwords($this->input->post('txtPermisoEdit')))) {
                        $this->_editPermiso($data, $this->input->post('id'));
                    } else {
                        $this->session->set_flashdata('mensaje_error', 'El permiso que intenta ingresar ya se encuentra registrado.');
                    }
                }
                redirect('administracion/acciones');
            }
        }
    }

    /**
     * Editamos los datos del permiso luego de haber realizado las validaciones
     * @param arr $data
     * @param int $id
     */
    function _editPermiso($data, $id)
    {
        $result = $this->Acciones_Model->editPermiso($data, $id);
        if (!$result) {
            $this->session->set_flashdata('mensaje_error', 'No se pudo editar el permiso. Por favor verifique que los datos sean correctos.');
        } else {
            $this->session->set_flashdata('mensaje_exito', 'El permiso se editó correctamente.');
        }
    }

    /**
     * Método para verificar si existe o no el permiso a ingresar
     * @param  String  $permiso
     * @return Boolean
     */
    function _verifyPermiso($permiso)
    {
        $result = $this->Acciones_Model->verifyPermiso($permiso);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Método para verificar si existe o no el key del permiso a ingresar
     * @param  String  $key
     * @return Boolean
     */
    function _verifyKey($key)
    {
        $result = $this->Acciones_Model->verifyKey($key);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Eliminar un permiso
     * como parámetro
     * @access     public
     */
    function deletePermiso()
    {
        if ($this->_is_logged_in()) {
            if ( !$this->acl->hasPermission('perm_del_all') ) {
                $this->session->set_flashdata('mensaje_error', 'No tiene el permiso para acceder a esta página');
                redirect('/dashboard/');
            }

            if ($this->uri->segment(4)) {
                if (!$this->Acciones_Model->deletePermiso($this->uri->segment(4))) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar el permiso. Por favor vuelva a intentarlo.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'El permiso se eliminó correctamente.');
                }
            }
            redirect('administracion/acciones');
        }
    }

    /**
     * Función que permitirá buscar un determinado permiso
     * @access     public
     */
    function searchAccion()
    {
        if ($this->_is_logged_in()) {
            if ($this->input->post('txtSearchAccion') == '') {
                redirect('administracion/acciones/index');
            }

            $query_array = array(
                'Accion' => $this->input->post('txtSearchAccion')
            );

            $query_id = $this->input->save_query($query_array);
            redirect('administracion/acciones/index/' . $query_id);

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