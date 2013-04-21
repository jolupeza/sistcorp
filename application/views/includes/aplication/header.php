<!-- Inicio header -->
<header>
    <!-- Inicio container -->
    <div class="container-fluid">
        <div class="row-fluid">
            <!-- Inicio #logo -->
            <div class="span7" id="logo">
                <h3><?php echo anchor(site_url(), img(array('src' => 'images/logo.png', 'alt' => 'SISTEMA ADMINISTRATIVO - SISTCORP')) . 'SISTEMA ADMINISTRATIVO - SISTCORP', array('title' => 'SISTEMA ADMINISTRATIVO - SISTCORP')); ?></h3>
            </div>
            <!-- Fin #logo -->

            <?php if ($this->session->userdata('logged_in')) : ?>
            <!-- Inicio #mnu_setting -->
            <div class="span5" id="mnu_setting">                
                    <p>Bienvenid@, <?php echo $this->session->userdata('nom_user'); ?></p>
                    <div class="btn-group">
                        <a class="btn" href="" title="Mi cuenta">Mi cuenta</a>
                        <a class="btn" href="" title="Configuraci&oacute;n">Configuraci&oacute;n</a>
                        <?php echo anchor(site_url('login/logout'), 'Cerrar sesi&oacute;n', 'title="Cerrar sesi&oacute;n" class="btn"'); ?>
                    </div>    
                    <p class="text-right"><?php echo format_date(); ?></p>
            </div>
            <!-- Fin #mnu_setting -->
             <?php endif; ?>
        </div>
    </div>
    <!-- Fin container -->
</header>
<!-- Fin header -->