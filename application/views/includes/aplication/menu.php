<?php if ($this->session->userdata('logged_in')) : ?>
    <!-- Inicio nav -->
    <nav>
        <div class="container-fluid">
            <div class="row-fluid">
                <!-- Inicio #menu -->
                <div class="span12" id="menu">
                    <ul class="nav nav-pills">
<?php
    if (isset($active) && $active == 'Dashboard') {
        $activo = 'active';
    }
    else {
        $activo = '';
    }
?>
                        <li class="<?php echo $activo; ?>"><a href="<?php echo site_url('dashboard'); ?>" title="Dashboard">Dashboard</a></li>
<?php foreach ($modulos as $row) : 
                if (isset($active) && $active == $row->Modulo) {
                    $activo = 'active';
                }
                else {
                    $activo = '';
                }
?>                            
                        <li class="dropdown <?php echo $activo; ?>"><a href="#" class="dropdow-toggle" data-toggle="dropdown" title="<?php echo $row->Modulo; ?>"><?php echo $row->Modulo; ?><b class="caret"></b></a> 
                            <ul class="dropdown-menu">
<?php 
    $opciones = $this->Modulos_Model->getOpciones($row->ID_MODULO); 
    if (is_array($opciones)) {
        foreach ($opciones as $opcion) :
            $subOpciones = $this->Modulos_Model->getSubOpciones($opcion->ID_OPCION);
                if (is_array($subOpciones)) :
?>
                                <li class="dropdown"><a href="<?php echo site_url($opcion->URL); ?>" title="<?php echo $opcion->Opcion; ?>"><?php echo $opcion->Opcion; ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">                                
<?php
                    foreach ($subOpciones as $subOpcion) :
?>
                                        <li><a href="<?php echo site_url($subOpcion->URL); ?>" title="<?php echo $subOpcion->Opcion ?>"><?php echo $subOpcion->Opcion ?></a></li>
<?php       endforeach; ?>
                                    </ul>
                                </li>
<?php   else : ?>
                                <li><a href="<?php echo site_url($opcion->URL); ?>" title="<?php echo $opcion->Opcion; ?>"><?php echo $opcion->Opcion; ?></a></li>
<?php       
                endif;
        endforeach;
    }
?>                               
                            </ul>
                        </li>
<?php endforeach; ?>
<?php
    if (isset($active) && $active == 'Help') {
        $activo = 'active';
    }
    else {
        $activo = '';
    }
?>
                        <li class="<?php echo $activo; ?>"><a href="#">Help</a></li>
                    </ul>
                </div>
                <!-- Fin #menu -->
            </div>
        </div>
    </nav>
    <!-- Fin nav -->
<?php endif; ?>