<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('format_date')) {
    function format_date() {
        $nameDay = array('Domingo', 'Lunes', 'Marte', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado');
        $nameMonth = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $day = $nameDay[date('w')];
        $month = $nameMonth[date('n') - 1];
        
        return $day . ', ' . date('d') . ' de ' . $month . ' del ' . date('Y');
    }
}