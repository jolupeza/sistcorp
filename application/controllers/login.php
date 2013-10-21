    <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Nombre       : controllers/login.php
 * Descripción  : Controlador que se encargará de realizar la verificación del logueo del usuario y de cerrar la sesión.
 * @author Ing. José Pérez
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Login_Model');
    }

    /**
     * Se encargará de cargar la vista principal para el control de
     * usuarios
     * @access     public
     */
    function index()
    {
        if (!$this->_is_logged_in()) {
            $this->load->model('Empresas_Model');
            $emp = $this->Empresas_Model->getEmpresas();
            if (is_array($emp)) {
                $data['empresas'] = $emp;
            }
            $data['validar'] = TRUE;
            $data['jsLoad'] = array('login/funciones');
            $data['main_content'] = 'login/index';
            $data['title'] = 'SISTCORP - Login';
            $this->load->view('themes/admin/template.php', $data);
        }
    }

    /**
     * Se encargará de recibir los datos del formulario de login
     * @access     public
     */
    function verifyLogin()
    {
        // Verificamos que ya estemos registrados y accesos indeseados
        if (!$this->_is_logged_in()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('empresa', 'Empresa', 'callback__verifySelect');
            $this->form_validation->set_rules('username', 'Usuario', 'trim|required');
            $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|min_length[6]');
            $this->form_validation->set_message('required', 'El campo %s es requerido.');
            $this->form_validation->set_message('min_length', 'Por favor, introduzca al menos 6 caracteres.');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar la empresa.');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $this->load->library('encrypt');
                $datos = array(
                    'Usuario' => $this->input->post('username'),
                    'PWD' => $this->encrypt->sha1($this->input->post('pass')),
                    'ID_EMPRESA' => $this->input->post('empresa')
                );
                $result = $this->Login_Model->login($datos);
                if (is_object($result)) {
                    $data = array(
                        'id_user' => $result->ID_USUARIO,
                        'username' => $result->Usuario,
                        'nom_user' => $result->Nombres . ' ' . $result->Ape_Paterno . ' ' . $result->Ape_Materno,
                        'perfil' => $result->ID_PERFIL,
                        'empresa' => $result->ID_EMPRESA,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('mensaje_error', 'No ha podido loguearse. Por favor verifique su nombre de usuario, password o la empresa.');
                    redirect('login');
                }
            }
        }
    }

    /**
     * Verificar que se haya seleccionado la empresa
     * @access      private
     * @param       int          $value      El valor de empresa seleccionada
     * @return      bool
     */
    function _verifySelect($value)
    {
        if (!isset($value) or $value == '') {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Método para confirmar el registro del nuevo usuario
     * @access     public
     * @param      String      Código de activación
     */
    function register_confirm($code = NULL, $id = NULL)
    {
        if ($this->_is_logged_in()) {
            $this->session->set_flashdata('mensaje_error', 'Usted se encuentra logueado y no puede activar una cuenta.');
            redirect('dashboard');
        } else {
            $code = $this->uri->segment(3);
            $id = $this->uri->segment(4);
            if (is_null($code) OR $code == '') {
                $this->_verifyAcount();
            } else {
                if (!is_null($id) && is_numeric($id) && !empty($id)) {
                    $update = $this->Login_Model->updateStatus($code, $id);
                    $this->_verifyAcount($update);
                }
            }
        }
    }

    function _verifyAcount($veri = FALSE)
    {
        $data['title'] = 'SISTCORP - Verificaci&oacute;n de cuenta';
        $data['subtitle'] = 'Activaci&oacute;n de cuenta';
        $data['main_content'] = ($veri) ? 'login/verifyOk' : 'login/verifyNoOk';
        $this->load->view('themes/admin/template.php', $data);
    }

    /**
     * Se encargará cerrar la sesión del usuario
     * @access     public
     */
    function logout()
    {
        if ($this->session->userdata('logged_in')) {
            $this->session->sess_destroy();
        }
        redirect('login');
    }

    /**
     * Se encargará de verificar si el usuario se encuentra logueado
     * @access     private
     * @return     boolean     Si no estamos logueados devolverá FALSE
     */
    function _is_logged_in()
    {
        $is_logged_in = $this->session->userdata('logged_in');
        if (!isset($is_logged_in) || $is_logged_in == FALSE) {
            return FALSE;
        } else {
            redirect('dashboard');
        }
    }

}