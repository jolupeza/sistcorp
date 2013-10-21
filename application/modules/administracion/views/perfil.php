<!-- Inicio container -->
<div class="container-fluid">
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones --
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                    <a href="javascript:void(0);" id="addPerfil" title="Agregar Perfil"><?php echo img(base_url() . 'images/nuevo.png') . 'Agregar'; ?></a>
                    <?php echo anchor(site_url() . 'dashboard', img(base_url() . 'images/back.png') . 'Atr&aacute;s', 'title="Atr&aacute;s"'); ?>
                </div>
            </div>
            <!-- Fin acciones --

            <?php if ($this->session->flashdata('mensaje_error')) : ?>
                <div class="alert alert-error"><p><?php echo $this->session->flashdata('mensaje_error'); ?></p></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('mensaje_exito')) : ?>
                <div class="alert alert-success"><p><?php echo $this->session->flashdata('mensaje_exito'); ?></p></div>
            <?php endif; ?>

            <!-- Inicio .acciones --
            <div class="acciones">
                <span>B&uacute;squeda de Perfil</span>
                <?php
                echo form_open('administracion/perfil/searchPerfil', array('name' => 'frmsearch', 'class' => 'form-search'));
                ?>
                <div class="input-append">
                    <?php echo form_input(array('name' => 'txtNomPerfil', 'class' => 'span7 search-query', 'value' => set_value('txtNomPerfil'))); ?>
                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- Fin .acciones --
            <?php if (validation_errors()) : ?>
                <div class="alert alert-error"><?php echo validation_errors(); ?></div>
            <?php endif; ?>-->
        </aside>
        <!-- Fin #submenu -->

        <!-- Inicio #main -->
        <section class="span9" id="main">
            <h3><?php echo $subtitle; ?></h3>
            <?php if (isset($perfil) && count($perfil) > 0) : ?>
            <?php echo $perfil->output; ?>
            <!--    <table class="container_grid">
                    <tr class="header_grid">
                        <td>ID</td>
                        <td>PERFIL</td>
                        <td>ACTIVO</td>
                        <td>PERMISOS</td>
                        <td>EDITAR</td>
                        <td>ELIMINAR</td>
                    </tr>
                    <?php foreach ($perfil as $row) : ?>
                    <tr class="content_grid">
                        <td class="text-center"><?php echo $row->ID_PERFIL; ?></td>
                        <td><?php echo $row->Perfil; ?></td>
                        <?php
                        if ($row->Activo == '0') {
                        $activo = 'No';
                        } else if ($row->Activo == '1') {
                        $activo = 'S&iacute;';
                        }
                        ?>
                        <td class="text-center"><?php echo $activo; ?></td>
                        <td class="text-center"><?php echo anchor('administracion/perfil/permisosPerfil/' . $row->ID_PERFIL, img(base_url() . 'images/permisos.png'), array('class' => 'editPermisos', 'title' => 'Editar Permisos de ' . $row->Perfil)); ?></td>
                        <td class="text-center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idperfil="' . $row->ID_PERFIL . '" class="editPerfil" title="Editar ' . $row->Perfil . '"') ?></td>
                        <td class="text-center"><a href="javascript:void(0);" title="Eliminar <?php echo $row->Perfil; ?>" onclick="deleteRow('<?php echo $row->Perfil; ?>', '<?php echo base_url() . 'administracion/perfil/deletePerfil/' . $row->ID_PERFIL; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <?php if (isset($pag_links)) : ?>
                    <ul id="pagination">
                        <?php echo $pag_links; ?>
                    </ul>
                <?php endif; ?>-->
            <?php else : ?>
                <div class="alert alig_center">
                    No se encontraron datos para mostrar.
                </div>
            <?php endif; ?>
        </section>
        <!-- Fin #main -->

        <!-- Formulario que nos permitirá agregar un nuevo perfil -->
        <!-- Inicio addPerfilModal -->
        <div class="modal hide fade" id="addPerfilModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Agregar Perfil</h3>
            </div>
            <?php echo form_open('administracion/perfil/verifyAddPerfil', array('name' => 'frmAddPerfil', 'id' => 'frmAddPerfil', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Perfil: *', 'txtPerfil', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $perfil = array(
                            'name' => 'txtPerfil',
                            'id' => 'txtPerfil',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/perfil/validatePerfilAjax\');'
                        );
                        echo form_input($perfil);
                        ?>
                        <div id="txtPerfilFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Activo: ', 'ddlActivo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'No', '1' => 'S&iacute;');
                        echo form_dropdown('ddlActivo', $opciones, '0', 'id = "ddlActivo"');
                        ?>
                    </div>
                </div>
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnAddAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Perfil', 'content' => 'Agregar Perfil'));
                ?>
            </div>
            <?php echo form_close(); ?>
            <!-- Inicio div cargando -->
            <div id="cargando"  class="hidden">
                <?php echo img(base_url() . 'images/ajax-loader.gif'); ?>
            </div>
            <!-- Fin div cargando -->
        </div>
        <!-- Fin addPerfilModal -->

        <!-- Formulario que nos permitirá editar información de perfil -->
        <!-- Inicio editPerfilModal -->
        <div class="modal hide fade" id="editPerfilModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Editar Perfil</h3>
            </div>
            <?php echo form_open('administracion/perfil/verifyEditPerfil', array('name' => 'frmEditPerfil', 'id' => 'frmEditPerfil', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Perfil: *', 'txtPerfilEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $txtPerfilEdit = array(
                            'name' => 'txtPerfilEdit',
                            'id' => 'txtPerfilEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/perfil/validatePerfilAjax\');'
                        );
                        echo form_input($txtPerfilEdit);
                        ?>
                        <div id="txtPerfilEditFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Activo :', 'ddlActivo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'No', '1' => 'S&iacute;');
                        echo form_dropdown('ddlActivo', $opciones, '0', 'id="ddlActivo"');
                        ?>
                    </div>
                </div>

                <?php echo form_hidden('id', ''); ?>
                <?php echo form_hidden('hdPerfil', ''); ?>
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnEditAceptar', 'class' => 'btn btn-primary', 'value' => 'Editar Perfil', 'content' => 'Editar Perfil'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- Fin editPerfilModal -->
    </div>
</div>
<!-- Fin container -->