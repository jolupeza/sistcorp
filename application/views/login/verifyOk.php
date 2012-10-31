<!-- Inicio container -->
<div class="container-fluid">
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <p>Sistema de Información General.</p>
            </div>
            <!-- Fin acciones -->
        </aside>
        <!-- Fin #submenu -->
        <!-- Inicio #main -->
        <section class="span9" id="main">
            <div class="alert alert-info">
                <h3><?php echo $subtitle; ?></h3>      
                <p>Su cuenta se activ&oacute; correctamente debe loguearse para comenzar a utilizar nuestro Sistema SISTCORP.</p>            
                <h5><?php echo anchor(site_url() . 'login', 'Click aqu&iacute; para loguearse.') ?></h5>
            </div>
        </section>
        <!-- Fin main -->    
    </div>
</div>
<!-- Fin container -->