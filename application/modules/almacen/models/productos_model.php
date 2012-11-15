<?php

/**
 * Nombre       : models/productos_model.php
 * Descripción  : Modelo que trabajará con la tabla tbl_producto
 * @author Ing. José Pérez
 */
class Productos_Model extends CI_Model {

    private $_table;

    function __construct() {
        parent::__construct();
        $this->_table = 'tbl_producto';
    }

    /** (1)
     * Método para obtener el número total de resultados de una consulta
     * @param   String      $producto      Producto a buscar
     * @return  Integer     Número de filas que devuelve la consulta
     */
    function getNumRows($producto = NULL) {
        if (!is_null($producto)) {
            $this->db->select('ID_PRODUCTO');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $this->db->like('Producto', $producto);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        } else {
            $this->db->select('ID_PRODUCTO');
            $where = array('ID_EMPRESA' => $this->session->userdata('empresa'));
            $this->db->where($where);
            $result = $this->db->get($this->_table);
            return $result->num_rows();
        }
    }

    /** (1)
     * Método para obtener listado de productos pero con limit definido
     * @param   String  $cuantos    Número de grupos a listar
     * @param   String  $inicio     Desde donde empieza a listar
     * @return  Array
     */
    function getProductosLimit($cuantos, $inicio) {
        $products = array();
        $this->db->select('ID_PRODUCTO, Producto, f.Familia, m.Simbolo, PrecioCosto, PrecioVenta, PrecioXMayor, p.Activo, p.ID_EMPRESA');
        $this->db->from('tbl_producto p');
        $this->db->join('tbl_familiaprod f', 'p.ID_FAMPROD = f.ID_FAMILIAPROD');
        $this->db->join('tbl_moneda m', 'p.ID_MONEDA = m.ID_MONEDA');
        $where = array('p.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->order_by("Producto", "asc");
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $products = $result->result();
        }
        $result->free_result();
        return $products;
    }

    /** (1)
     * Método para agregar un producto
     * @access  public
     * @param   Array   $data       Contiene los datos del producto a agregar
     * @return  Array
     */
    function addProducto($data) {
        return $this->db->insert($this->_table, $data);
    }

    /** (1)
     * Método para seleccionar un producto específica
     * @access      public
     * @param       String      Id de producto a editar
     * @return      Array       Obtenemos un array con los datos del producto
     *                          indicado
     */
    function getProductoByID($id) {
        $this->db->select('ID_PRODUCTO, ID_EMPRESA, ID_UNIDMED, ID_FAMPROD, ID_CLASEPROD, ID_GRUPOPROD, ID_MARCA, Producto, Abreviatura, ID_MONEDA, PrecioCosto, PrecioVenta, PrecioXMayor, Activo, ID_TIPOPRODUCTO');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_PRODUCTO' => $id);
        $this->db->where($where);
        $result = $this->db->get($this->_table);
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** (1)
     * Método que permite editar los datos de un producto.
     *
     * @param  String $medida
     *   Unidad de medida del producto. 
     *
     * @return Boolean
     *   True si actualización fue exitosa y false si no.
     */
    function editProducto($data, $id) {
        $this->db->where('ID_PRODUCTO', $id);
        return $this->db->update($this->_table, $data);
    }

    /**
     * Método para buscar un producto 
     * @param type $producto
     * @param type $cuantos
     * @param type $inicio
     * @return boolean 
     */
    function searchProducto($producto, $cuantos, $inicio) {
        $this->db->select('ID_PRODUCTO, Producto, f.Familia, PrecioCosto, PrecioVenta, PrecioXMayor, p.Activo, p.ID_EMPRESA');
        $this->db->from('tbl_producto p');
        $this->db->join('tbl_familiaprod f', 'p.ID_FAMPROD = f.ID_FAMILIAPROD');
        $where = array('p.ID_EMPRESA' => $this->session->userdata('empresa'));
        $this->db->where($where);
        $this->db->like('Producto', $producto);
        $this->db->order_by("Producto", "asc");
        $this->db->limit($cuantos, $inicio);
        $result = $this->db->get();
        if ($result->num_rows() <= 0) {
            return FALSE;
        }
        return $result->result();
    }

    /**
     * Método para obtener la foto de un producto
     * @access      public
     * @param       Integer     $id_producto  ID del producto
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function getFotoProducto($id_producto) {
        $this->db->select('Foto');
        $where = array('ID_EMPRESA' => $this->session->userdata('empresa'), 'ID_PRODUCTO' => $id_producto);
        $this->db->where($where);
        $result = $this->db->get('tbl_producto');
        if (!$result) {
            return FALSE;
        }
        if ($result->num_rows() == 0) {
            return FALSE;
        }
        return $result->row();
    }

    /** (1)
     * Método para eliminar un producto
     * @access      public
     * @param       Integer     $id_producto  ID del producto a eliminar
     * @return      Boolean     De acuerdo si se efectuó correctamente la
     *                          eliminación
     */
    function deleteProducto($id_producto) {
        $this->db->select('Foto');
        $this->db->where('ID_PRODUCTO', $id_producto);
        $result = $this->db->get('tbl_productos_fotos');
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $foto) {
                $thumb = explode(".", $foto->Foto);
                $thumb[0] .= '_thumb';
                $thumb = implode(".", $thumb);
                unlink(ROOT . 'images' . DS . 'products' . DS . $foto->Foto);
                unlink(ROOT . 'images' . DS . 'products' . DS . 'thumb' . DS . $thumb);
            }
        }
        $this->db->delete('tbl_productos_fotos', array('ID_PRODUCTO' => $id_producto));
        return $this->db->delete($this->_table, array('ID_PRODUCTO' => $id_producto));
    }

    /**
     * Método para agregar imágenes aun producto
     * @param array $data
     * @return bol 
     */
    function addFoto($data) {
        return $this->db->insert('tbl_productos_fotos', $data);
    }

    function getFotosProducto($id) {
        $result = $this->db->get_where('tbl_productos_fotos', array('ID_PRODUCTO' => $id));
        if ($result->num_rows() > 0) {
            return $result->result();
        }
    }

    /**
     * Método que nos permite eliminar una imagen 
     * @param int $id 
     */
    function delFoto($id) {
        $this->db->select('Foto');
        $this->db->where('ID_FOTO', $id);
        $result = $this->db->get('tbl_productos_fotos');
        if ($result->num_rows() > 0) {
            $foto = $result->row();
            $thumb = explode(".", $foto->Foto);
            $thumb[0] .= '_thumb';
            $thumb = implode(".", $thumb);
            unlink(ROOT . 'images' . DS . 'products' . DS . $foto->Foto);
            unlink(ROOT . 'images' . DS . 'products' . DS . 'thumb' . DS . $thumb);
        }
        return $this->db->delete('tbl_productos_fotos', array('ID_FOTO' => $id));
    }

}