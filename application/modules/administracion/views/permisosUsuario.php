<!-- Inicio container -->
<div class="container-fluid">
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                <?php if ($this->acl->hasPermission('perm_edit_all')) : ?>
                    <a href="javascript:void(0);" id="btnGuardar" title="Guardar Cambios"><?php echo img(base_url() . 'images/save.png') . 'Guardar'; ?></a>
                <?php endif; ?>
                    <?php echo anchor(site_url() . 'dashboard', img(base_url() . 'images/back.png') . 'Atr&aacute;s', 'title="Atr&aacute;s"'); ?>
                </div>
            </div>
            <!-- Fin acciones -->

            <?php if ($this->session->flashdata('mensaje_error')) : ?>
                <div class="alert alert-error"><p><?php echo $this->session->flashdata('mensaje_error'); ?></p></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('mensaje_exito')) : ?>
                <div class="alert alert-success"><p><?php echo $this->session->flashdata('mensaje_exito'); ?></p></div>
            <?php endif; ?>

            <!-- Inicio .acciones -->
            <div class="acciones">
                <span>B&uacute;squeda de Usuarios</span>
                <?php echo form_open('administracion/usuarios/searchUser', array('name' => 'frmsearch', 'class' => 'form-search')); ?>
                <div class="input-append">
                    <?php echo form_input(array('name' => 'txtUser', 'class' => 'span5 search-query', 'value' => set_value('txtUser'))); ?>
                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn', 'content' => '<i class="icon-search"></i>')); ?>
                </div>
                <label class="radio inline"><?php echo form_radio('rbtText', 'Username'); ?>Username</label>
                <label class="radio inline"><?php echo form_radio('rbtText', 'Nombres'); ?>Nombres</label>
                <label class="radio inline"><?php echo form_radio('rbtText', 'Apaterno'); ?>A. Paterno</label>
                <label class="radio inline"><?php echo form_radio('rbtText', 'Amaterno'); ?>A. Materno</label>
                <?php echo form_close(); ?>
                <p class="text-info"><small>Si no selecciona ninguna opci&oacute;n se buscar&aacute; en todos los campos.</small></p>
            </div>
            <!-- Fin .acciones -->
            <?php if (validation_errors()) : ?>
                <div class="alert alert-error"><?php echo validation_errors(); ?></div>
            <?php endif; ?>
        </aside>
        <!-- Fin #submenu -->

        <!-- Inicio #main -->
        <section class="span9" id="main">
            <h3><?php echo $subtitle; ?></h3>
            <?php if (isset($permisos) && count($permisos)) : ?>
            <?php echo form_open('administracion/usuarios/permisosUser', array('name' => 'frmPermUser', 'id' => 'frmPermUser')); ?>
            <?php echo form_hidden('guardar', '1'); ?>
            <?php echo form_hidden('id_user', $this->uri->segment(4)); ?>
                <table class="container_grid">
                    <tr class="header_grid">
                        <td>PERMISOS</td>
                        <td>ASIGNADO</td>
                    </tr>
                <?php foreach ($permisos as $pr) : ?>
                    <?php ($role[$pr]['value'] == 1) ? $v = 'habilitado' : $v = 'denegado'; ?>
                    <tr class="content_grid">
                        <td class="text-center"><?php echo $usuario[$pr]['name']; ?></td>
                        <td class="text-center">
                            <select name="perm_<?php echo $usuario[$pr]['id']; ?>" id="perm_<?php echo $usuario[$pr]['id']; ?>">
                                <option value="x" <?php if($usuario[$pr]['inheritted']) : ?> selected="selected" <?php endif; ?>>Heredado(<?php echo $v; ?>)</option>
                                <option value="1" <?php if($usuario[$pr]['value'] == 1 && $usuario[$pr]['inheritted'] == '') : ?> selected="selected" <?php endif; ?>>Habilitado</option>
                                <option value="" <?php if($usuario[$pr]['value'] == "" && $usuario[$pr]['inheritted'] == '') : ?> selected="selected" <?php endif; ?>>Denegado</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
                <?php echo form_close(); ?>
                    <?php if (isset($pag_links)) : ?>
                    <ul id="pagination">
                    <?php echo $pag_links; ?>
                    </ul>
    <?php endif; ?>
<?php else : ?>
                <div class="alert alig_center">
                    No se encontraron datos para mostrar.
                </div>
<?php endif; ?>
        </section>
        <!-- Fin #main -->
    </div>
</div>
<!-- Fin container -->