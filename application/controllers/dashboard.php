<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Nombre       : controllers/dashboard.php
 * Descripción  : Controlador que se encargará de mostrar la página principal de nuestra aplicación.
 * @author Ing. José Pérez
 */
class Dashboard extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  /**
   * Se encargará mostrar la página principal de nuestro aplicativo
   * @access     public
   */
  function index() {
    if ($this->_is_logged_in()) {
      // Ya hemos cargado el Modulos_Model en el archivo autoload.php
      // de manera que esta cargado para toda la aplicación
      $mod = $this->Modulos_Model->getModulos();
      if (is_array($mod)) {
        $data['modulos'] = $mod;
      }
      $data['active'] = 'Dashboard';
      $data['title'] = 'SISTCORP - Dashboard';
      $data['main_content'] = 'dashboard/index';
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
      redirect('usuarios');
    } else {
      return TRUE;
    }
  }

}