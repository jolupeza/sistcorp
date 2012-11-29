<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Nombre       : controllers/almacen/productos.php
 * Descripción  : Controlador que se encargará de la lógica del negocio 
 *                referente a los productos
 * @author Ing. José Pérez
 */
class Productos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Productos_Model');
        $this->load->library('firephp');
    }

    /**
     * Se encargará de cargar la vista principal para el control de productos
     * @param      $mensaje     Se mostrará en caso de quere presentar un mensaje
     * @access     public
     */
    function index() {
        if ($this->_is_logged_in()) {
            $mod = $this->Modulos_Model->getModulos();
            if (is_array($mod)) {
                $data['modulos'] = $mod;
            }

            $this->load->model('Tipoproducto_Model');
            $tipos = $this->Tipoproducto_Model->getTipoProductos();
            if (is_array($tipos)) {
                $data['tipos'] = $tipos;
            }

            $this->load->model('Unimed_Model');
            $unidad = $this->Unimed_Model->getUnidades();
            if (is_array($unidad)) {
                $data['unidades'] = $unidad;
            }

            $this->load->model('Moneda_Model');
            $monedas = $this->Moneda_Model->getMonedas();
            if (is_array($monedas)) {
                $data['monedas'] = $monedas;
            }

            $this->load->model('Grupos_Model');
            $grupos = $this->Grupos_Model->getGrupos();
            if (is_array($grupos)) {
                $data['grupos'] = $grupos;
            }

            $this->load->model('Marcas_Model');
            $marcas = $this->Marcas_Model->getMarcas();
            if (is_array($marcas)) {
                $data['marcas'] = $marcas;
            }
            $data['current'] = 'Almacén';
            $data['cssLoad'] = array('jquery.alerts');
            $data['jsLoad'] = array('funciones', 'validate', 'jquery.alerts');
            $data['jsPropio'] = array('productos/funciones');
            $data['title'] = 'SISTCORP - Administraci&oacute;n de Productoss';
            $data['subtitle'] = 'Administraci&oacute;n de Productos';
            $data['main_content'] = 'productos';
            $this->load->view('includes/aplication/template', $data);
        }
    }

    /**
     * Método para listar los productos via AJAX
     * @param type $offset 
     */
    function listProducts($offset = '') {
        $limit = '15';
        $total = $this->Productos_Model->getNumRows();
        if (is_numeric($total) AND $total > 0) {
            $data['productos'] = $this->Productos_Model->getProductosLimit($limit, $offset);
            $config['base_url'] = base_url() . 'almacen/productos/listProducts';
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['uri_segment'] = '4';
            $this->pagination->initialize($config);
            $data['pag_links'] = $this->pagination->create_links();
            $this->load->view('almacen/listProducts', $data);
        }
    }

    /**
     * Función para validar a través de Ajax
     */
    function validateProductoAjax() {
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
     *  Método que via ajax nos envía las familias de acuerdo a la clase seleccionada
     * @access      public 
     */
    function getFamilias() {
        $id = $this->input->post('claseId');
        $this->load->model('Familias_Model');
        $familias = $this->Familias_Model->getFamiliasByClase($id);
        if (is_array($familias) && count($familias) > 0) {
            echo json_encode($familias);
        }
    }

    /**
     *  Método que via ajax nos envía las fotos del producto seleccionado
     * @access      public 
     */
    function getFotos() {
        $id = $this->input->post('idproducto');
        $fotos = $this->Productos_Model->getFotosProducto($id);
        if (is_array($fotos) && count($fotos) > 0) {
            echo json_encode($fotos);
        }
    }

    function delFoto() {
        $id = $this->input->post('idfoto');
        if ($this->Productos_Model->delFoto($id)) {
            echo 'ok';
        }
        
    }

    /**
     * Método que recojerá los datos del nuevo producto, realizará una validación php 
     * y de estar todo correcto agregará el producto.
     * @access     public
     */
    function verifyAddProducto() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtProducto', 'Producto', 'trim|required');
            $this->form_validation->set_rules('ddlFamilia', 'Familia', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlMarca', 'Marca', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlUniMed', 'Unidad de Medida', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlMoneda', 'Moneda', 'callback__verifySelect');
            $this->form_validation->set_rules('txtPrecioCosto', 'Precio Costo', 'trim|required');
            $this->form_validation->set_rules('txtPrecioVenta', 'Precio Venta', 'trim|required');
            $this->form_validation->set_rules('txtPrecioMayor', 'Precio x Mayor', 'trim|required');
            $this->form_validation->set_rules('ddlTipoProducto', 'Tipo Producto', 'callback__verifySelect');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar el campo requerido %s');

            if ($this->form_validation->run($this) == FALSE) {
                $this->session->set_flashdata('mensaje_error', 'No se puede agregar el producto. Por favor verifique los datos ingresados y que haya seleccionado los campos requeridos.');
                redirect('almacen/productos');
            } else {
                $data = array(
                    'ID_EMPRESA' => $this->session->userdata('empresa'),
                    'ID_UNIDMED' => $this->input->post('ddlUniMed'),
                    'ID_FAMPROD' => $this->input->post('ddlFamilia'),
                    'ID_CLASEPROD' => $this->input->post('ddlClase'),
                    'ID_GRUPOPROD' => $this->input->post('ddlGrupo'),
                    'ID_MARCA' => $this->input->post('ddlMarca'),
                    'Producto' => ucfirst($this->input->post('txtProducto')),
                    'Abreviatura' => $this->input->post('txtAbreviatura'),
                    'ID_MONEDA' => $this->input->post('ddlMoneda'),
                    'PrecioCosto' => number_format($this->input->post('txtPrecioCosto'), 2, '.', ','),
                    'PrecioVenta' => number_format($this->input->post('txtPrecioVenta'), 2, '.', ','),
                    'PrecioXMayor' => number_format($this->input->post('txtPrecioMayor'), 2, '.', ','),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Creacion' => $this->session->userdata('id_user'),
                    'Fec_Creacion' => date('Y-m-d H:i:s'),
                    'ID_TIPOPRODUCTO' => $this->input->post('ddlTipoProducto')
                );
                $result = $this->Productos_Model->addProducto($data);

                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se puede agregar el producto. Por favor verifique los datos.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'El producto se agreg&oacute; satisfactoriamente.');
                }
                redirect('almacen/productos');
            }
        }
    }

    /**
     *  Método para obtener la extensión de un archivo
     * @access  private
     * @param   type $str
     * @return  string 
     */
    function _getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }

        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    /**
     * Método que verificará que se haya seleccionado la clase para la familia a insertar
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
     * Método que generará un código aleatorio para el nombre de la foto del producto.
     * @access     private
     * @param      $length     Tamaño del código aleatorio
     * @return     String      Código aleatorio
     */
    function _random_string($length) {
        $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $max = strlen($base) - 1;
        $activation_code = '';
        while (strlen($activation_code) < $length) {
            $activation_code .= $base{mt_rand(0, $max)};
        }
        return $activation_code;
    }

    function addFoto() {
        $config['upload_path'] = './images/products/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = $this->_random_string(5) . $this->input->post('id_producto');
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        $error = array();
        $success = array();
        $foto_info = array();
        foreach ($_FILES as $file => $file_info) {
            if ($file_info['name'] != '') {
                if (!$this->upload->do_upload($file)) {
                    $error[$file_info['name']] = $this->upload->display_errors();
                } else {
                    $foto_info = $this->upload->data();
                    $this->_createThumb($foto_info);
                    $data = array(
                        'ID_PRODUCTO' => $this->input->post('id_producto'),
                        'Foto' => $foto_info['file_name']
                    );
                    if ($this->Productos_Model->addFoto($data)) {
                        $success[] = $file_info['name'];
                    }
                }
            }
        }
        if (count($error) > 0)
            $this->session->set_flashdata('error_foto', $error);
        if (count($success) > 0)
            $this->session->set_flashdata('success_foto', $success);
        redirect('almacen/productos');
    }

    function _createThumb($file) {
        $this->load->library('image_lib');
        $config['source_image'] = $file['full_path'];
        $config['create_thumb'] = TRUE;
        $config['thumb_marker'] = '_thumb';
        $config['maintain_ratio'] = TRUE;
        $config['master_dim'] = 'auto';
        $config['width'] = 150;
        $config['height'] = 150;
        $config['new_image'] = $file['file_path'] . 'thumb/';
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    /**
     * Método que permitirá traer los datos del producto a editar
     * @access     public
     */
    function editProducto() {
        if ($this->_is_logged_in()) {
            $id = $this->input->post('idProducto');
            $result = $this->Productos_Model->getProductoByID($id);
            if (is_object($result)) {
                echo json_encode($result);
            }
        }
    }

    /**
     * Se encargará de actualizar los datos editados de la familia seleccionada
     * @access     public
     */
    function verifyEditProducto() {
        if ($this->_is_logged_in()) {
            $this->form_validation->set_rules('txtProductoEdit', 'Producto', 'trim|required');
            $this->form_validation->set_rules('ddlFamiliaEdit', 'Familia', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlClaseEdit', 'Clase', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlGrupoEdit', 'Grupo', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlMarcaEdit', 'Marca', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlUniMedEdit', 'Unidad de Medida', 'callback__verifySelect');
            $this->form_validation->set_rules('ddlMonedaEdit', 'Moneda', 'callback__verifySelect');
            $this->form_validation->set_rules('txtPrecioCostoEdit', 'Precio Costo', 'trim|required');
            $this->form_validation->set_rules('txtPrecioVentaEdit', 'Precio Venta', 'trim|required');
            $this->form_validation->set_rules('txtPrecioMayorEdit', 'Precio x Mayor', 'trim|required');
            $this->form_validation->set_rules('ddlTipoProductoEdit', 'Tipo Producto', 'callback__verifySelect');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('_verifySelect', 'Debe seleccionar el campo requerido %s');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('mensaje_error', 'No se puede editar producto. Por favor verifique los datos ingresados.');
                redirect('almacen/familias');
            } else {
                $data = array(
                    'ID_UNIDMED' => $this->input->post('ddlUniMedEdit'),
                    'ID_FAMPROD' => $this->input->post('ddlFamiliaEdit'),
                    'ID_CLASEPROD' => $this->input->post('ddlClaseEdit'),
                    'ID_GRUPOPROD' => $this->input->post('ddlGrupoEdit'),
                    'ID_MARCA' => $this->input->post('ddlMarcaEdit'),
                    'Producto' => ucfirst($this->input->post('txtProductoEdit')),
                    'Abreviatura' => $this->input->post('txtAbreviatura'),
                    'ID_MONEDA' => $this->input->post('ddlMonedaEdit'),
                    'PrecioCosto' => number_format($this->input->post('txtPrecioCostoEdit'), 2, '.', ','),
                    'PrecioVenta' => number_format($this->input->post('txtPrecioVentaEdit'), 2, '.', ','),
                    'PrecioXMayor' => number_format($this->input->post('txtPrecioMayorEdit'), 2, '.', ','),
                    'Activo' => $this->input->post('ddlActivo'),
                    'User_Modificacion' => $this->session->userdata('id_user'),
                    'Fec_Modificacion' => date('Y-m-d H:i:s'),
                    'ID_TIPOPRODUCTO' => $this->input->post('ddlTipoProductoEdit')
                );

                $result = $this->Productos_Model->editProducto($data, $this->input->post('id'));
                if (!$result) {
                    $this->session->set_flashdata('mensaje_error', 'No se pudo editar el producto. Por favor vuelva a intentarlo.');
                } else {
                    $this->session->set_flashdata('mensaje_exito', 'El producto se editó satisfactoriamente.');
                }
                redirect('almacen/productos');
            }
        }
    }

    /**
     * Función que permitirá buscar un determinado producto
     * @access     public
     */
    function searchProducto($search) {
        $limit = '15';
        $total = $this->Productos_Model->getNumRows(urldecode($search));
        if (is_numeric($total) AND $total > 0) {
            $config['base_url'] = base_url() . 'almacen/productos/searchProducto/' . $search;
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['uri_segment'] = '5';
            $this->pagination->initialize($config);
            $data['productos'] = $this->Productos_Model->searchProducto(urldecode($search), $limit, $this->uri->segment(5));
            $data['pag_links'] = $this->pagination->create_links();
            $this->load->view('almacen/listProducts', $data);
        }
    }

    /**
     * Función que eliminará de la tabla tbl_producto el producto indicado
     * como parámetro
     * @access     public
     */
    function deleteProducto() {
        $result = $this->Productos_Model->deleteProducto($this->uri->segment(4));
        if (!$result) {
            $this->session->set_flashdata('mensaje_error', 'No se pudo eliminar el producto. Por favor vuelva a intentarlo.');
        } else {
            $this->session->set_flashdata('mensaje_exito', 'El producto se eliminó satisfactoriamente.');
        }
        redirect('almacen/productos');
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