<?php
    /**
     * Nombre       : includes/aplication/template.php
     * Descripción  : Template general de nuestra aplicación
     * @author Ing. José Pérez
     */

     $this->load->view('includes/aplication/head');
     $this->load->view('includes/aplication/header');
     $this->load->view('includes/aplication/menu');
     $this->load->view($main_content);
     $this->load->view('includes/aplication/footer');