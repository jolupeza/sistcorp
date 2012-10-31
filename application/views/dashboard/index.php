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

            <?php if ($this->session->flashdata('mensaje_error')) : ?>
                <div class="alert alert-error"><p><?php echo $this->session->flashdata('mensaje_error'); ?></p></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('mensaje_exito')) : ?>
                <div class="alert alert-success"><p><?php echo $this->session->flashdata('mensaje_exito'); ?></p></div>
            <?php endif; ?>
        </aside>
        <!-- Fin submenu -->

        <!-- Inicio #main -->
        <section class="span9" id="main">          
            <ul class="thumbnails">
                <li class="span2">
                    <?php echo anchor(site_url() . 'administracion/usuarios', img(array('src' => base_url() . 'images/user.png', 'alt' => 'Usuarios')) . 'Usuarios', 'title="Usuarios" class="thumbnail"') ?>
                </li>
                <li class="span2">
                    <?php echo anchor(site_url() . 'almacen/productos', img(array('src' => base_url() . 'images/products.png', 'alt' => 'Productos')) . 'Productos', 'title="Productos" class="thumbnail"') ?>
                </li>
                <li class="span2">
                    <?php echo anchor(site_url() . 'seguridad/usuarios', img(array('src' => base_url() . 'images/proveedor.png', 'alt' => 'Proveedores')) . 'Proveedores', 'title="Proveedores" class="thumbnail"') ?>
                </li>
                <li class="span2">
                    <?php echo anchor(site_url() . 'seguridad/usuarios', img(array('src' => base_url() . 'images/clientes.png', 'alt' => 'Clientes')) . 'Clientes', 'title="Clientes" class="thumbnail"') ?>
                </li>
                <li class="span2">
                    <?php echo anchor(site_url() . 'seguridad/usuarios', img(array('src' => base_url() . 'images/facturacion.png', 'alt' => 'Facturaci&oacute;n')) . 'Facturaci&oacute;n', 'title="Facturaci&oacute;n" class="thumbnail"') ?>
                </li>
            </ul>
        </section>
        <!-- Fin #main -->
    </div>
</div>
<!-- Fin container -->