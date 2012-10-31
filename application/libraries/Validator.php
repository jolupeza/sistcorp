<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Clase admite validación formulario web PHP y AJAX 
class Validator {

    /** Creamos propiedad que nos permitirá implementar cualquier funcionalidad
     * de Codeigniter
     */
    protected $ci;

    // constructor asigna a la propiedad una copia de la instancia del 
    // superobjeto CodeIgniter
    function __construct() {
        $this->ci = & get_instance();
    }

    // soporte validación AJAX , verifica un valor simple
    public function validateAJAX($inputValue, $fieldID) {
        // comprueba que campo est� siendo validado y ejecuta la validaci�n
        switch ($fieldID) {
            // Comprueba si hemos ingresado valor al campo
            case 'txtNomUser':
            case 'txtApePaterno':
            case 'txtApeMaterno':
            case 'txtNomUserEdit':
            case 'txtApePaternoEdit':
            case 'txtApeMaternoEdit':
            case 'txtEditUsername':
            case 'txtPerfilEdit':
            case 'txtGrupoEdit':
            case 'txtClase':
            case 'txtClaseEdit':
            case 'txtFamilia':
            case 'txtFamiliaEdit':
            case 'txtProducto':
            case 'txtProductoEdit':
                return $this->validateRequired($inputValue);
                break;

            // Comprueba si email es válido
            case 'txtEmail':
                return $this->validateEmail($inputValue);
                break;

            // Comprueba si el username del usuario es válido
            case 'txtUsername':
                return $this->validateUsername($inputValue);
                break;

            // Comprueba si el password del usuario es válido
            case 'txtPassword':
                return $this->validatePassword($inputValue);
                break;

            // Comprueba si ha repetido el password 
            case 'txtRePassword':
                return $this->validateRepassword($inputValue);
                break;

            // Comprueba si ha seleccionado item de select
            case 'ddlPerfiles':
            case 'ddlPerfilesEdit':
            case 'ddlGrupo':
            case 'ddlGrupoEdit':
            case 'ddlClase':
            case 'ddlClaseEdit':
            case 'ddlFamilia':
            case 'ddlFamiliaEdit':
            case 'ddlMarca':
            case 'ddlUniMed':
            case 'ddlMoneda':
            case 'ddlTipoProducto':
            case 'ddlMarcaEdit':
            case 'ddlUniMedEdit':
            case 'ddlMonedaEdit':
            case 'ddlTipoProductoEdit':
                return $this->validateSelect($inputValue);
                break;

            // Comprueba que el username a editar no este vacío
            case 'txtEditEmail':
                return $this->validateEditEmail($inputValue);
                break;

            // Comprueba que el nombre del Perfil a añadir no exista
            case 'txtPerfil':
                return $this->validatePerfilName($inputValue);
                break;

            // Comprueba que el grupo no este vacío y que no exista
            case 'txtGrupo':
                return $this->validateGrupo($inputValue);
                break;

            // Comprueba que el precio sea válido y no este vacío
            case 'txtPrecioCosto':
            case 'txtPrecioVenta':
            case 'txtPrecioMayor':
            case 'txtPrecioCostoEdit':
            case 'txtPrecioVentaEdit':
            case 'txtPrecioMayorEdit':
                return $this->validatePrecio($inputValue);
                break;
        }
    }

    // validaci�n nombre de perfil (no debe estar vacío, y no debe estar ya registrado)
    private function validatePerfilName($value) {
        // nombre de usuario vacío no es válido
        $value = trim($value);
        if ($value == null)
            return 0; // no válido

        $value = strtoupper($value);
        // comprueba si el nombre de usuario existe en la base de datos
        $this->ci->load->model('Perfil_Model');
        $result = $this->ci->Perfil_Model->getPerfilByName($value);
        return $result;
    }

    // validar que se haya ingresado texto
    private function validateRequired($value) {
        $value = trim($value);
        if ($value == null) {
            return 0;
        } else {
            return 1;
        }
    }

    // validación email
    private function validateEmail($value) {
        // formatos validaci�n email: *@*.*, *@*.*.*, *.*@*.*, *.*@*.*.*)
        $value = trim($value);
        if ($value == null) {
            return 0;
        } else {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                // comprueba si el email ya se encuentra registrado
                $this->ci->load->model('Usuarios_Model');
                $result = $this->ci->Usuarios_Model->verifyEmail($value);
                return $result;
            } else {
                return 0;
            }
        }
    }

    // validación email cuando se edite
    private function validateEditEmail($value) {
        // formatos validaci�n email: *@*.*, *@*.*.*, *.*@*.*, *.*@*.*.*)
        $value = trim($value);
        if ($value == null) {
            return 0;
        } else {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    // validación username (no debe estar vacío, y no debe estar ya registrado)
    private function validateUsername($value) {
        // nombre de usuario vacío no es válido
        $value = trim($value);
        if ($value == null)
            return 0; // no válido



            
// comprueba si el nombre de usuario existe en la base de datos
        $this->ci->load->model('Usuarios_Model');
        $result = $this->ci->Usuarios_Model->getUserByUsername($value);
        return $result;
    }

    // validación del password del usuario 
    private function validatePassword($value) {
        $value = trim($value);
        if ($value == null) {
            return 0;
        } else if (strlen($value) < 6) {
            return 0;
        } else {
            return 1;
        }
    }

    // validación del password del usuario 
    private function validateRepassword($value) {
        $value = trim($value);
        if ($value == null) {
            return 0;
        } else if (strlen($value) < 6) {
            return 0;
        } else {
            return 1;
        }
    }

    // Validamos que se haya seleccionado
    private function validateSelect($value) {
        if ($value == '0') {
            return 0;
        } else {
            return 1;
        }
    }

    private function validateGrupo($value) {
        // nombre de usuario vacío no es válido
        $value = trim($value);
        if ($value == null)
            return 0; // no válido
            //
        // comprueba si el nombre de usuario existe en la base de datos
        $this->ci->load->model('Grupos_Model');
        $result = $this->ci->Grupos_Model->verifyExistGrupo($value);
        return $result;
    }

    // validación txtPrecioCosto (no debe estar vacío y debe ser válido)
    private function validatePrecio($value) {
        // precio vacío no es válido
        $value = trim($value);
        if ($value == null) {
            return 0; // no válido
        } else if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
            return 0;
        }
        return 1;
    }

}