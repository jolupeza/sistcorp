<?php
    /**
     * Nombre       : application/views/themes/admin/template.php
     * Descripción  : Template para la parte administrativa de nuestra aplicación
     * @author Ing. José Pérez
     */

     $theme = $this->config->item('admin_theme');

     $this->load->view('themes/admin/' . $theme . '/head');
     $this->load->view('themes/admin/' . $theme . '/header');
     $this->load->view('themes/admin/' . $theme . '/menu');
     $this->load->view($main_content);
     $this->load->view('themes/admin/' . $theme . '/footer');