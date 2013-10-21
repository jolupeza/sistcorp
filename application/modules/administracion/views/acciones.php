<!-- Inicio container -->
<div class="container-fluid">
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                <?php if ( $this->acl->hasPermission('perm_add') ) : ?>
                    <a href="javascript:void(0);" id="addPermiso" title="Agregar Permiso"><?php echo img(base_url() . 'assets/admin/tpl_itproyecta/img/nuevo.png') . 'Agregar'; ?></a>
                <?php endif; ?>
                <?php if ($this->acl->hasPermission('perm_view')) : ?>
                    <?php echo anchor('administracion/acciones/', img(base_url() . 'assets/admin/tpl_itproyecta/img/pdf.png') . 'Exportar a PDF', 'title="Exportar a PDF"'); ?>
                <?php endif; ?>
                    <?php echo anchor(site_url() . 'dashboard', img(base_url() . 'assets/admin/tpl_itproyecta/img/back.png') . 'Atr&aacute;s', 'title="Atr&aacute;s"'); ?>
                </div>
            </div>
            <!-- Fin acciones -->

            <?php if ($this->session->flashdata('mensaje_error')) : ?>
                <div class="alert alert-error"><p><?php echo $this->session->flashdata('mensaje_error'); ?></p></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('mensaje_exito')) : ?>
                <div class="alert alert-success"><p><?php echo $this->session->flashdata('mensaje_exito'); ?></p></div>
            <?php endif; ?>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-error"><?php echo validation_errors(); ?></div>
            <?php endif; ?>
        </aside>
        <!-- Fin #submenu -->

        <!-- Inicio #main -->
        <section class="span9" id="main">
            <h3><?php echo $subtitle; ?></h3>
            <?php if (isset($acciones) && count($acciones) > 0) : ?>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                        <?php foreach ($fields as $field_name => $field_display) : ?>
                            <?php $sort = ($sort_order == "asc") ? "desc" : "asc"; ?>
                            <th><?php echo anchor('administracion/acciones/index/' . $this->uri->segment(4) . '/' . $field_name . '/' . $sort . '/' . $registros, $field_display); ?></th>
                        <?php endforeach; ?>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($acciones as $row) : ?>
                        <tr class="content_grid">
                        <?php foreach ($fields as $field_name => $field_display) : ?>
                            <td class="td-center">
                            <?php
                                if ($field_name == 'Activo') {
                                    $activo = ($row->Activo == '1') ? 'Sí' : 'No';
                                    echo $activo;
                                } else {
                                    echo $row->$field_name;
                                }
                            ?>
                            </td>
                        <?php endforeach; ?>
                            <td class="td-center">
                        <?php if ( $this->acl->hasPermission('perm_edit_all') ) : ?>
                                <?php echo anchor('', img(base_url() . 'assets/admin/tpl_itproyecta/img/edit.png'), 'data-idaccion="' . $row->ID_ACCION . '" class="editAccion" title="Editar ' . $row->Accion . '"') ?>
                        <?php endif; ?>
                        <?php if ( $this->acl->hasPermission('perm_del_all') ) : ?>
                                <a href="javascript:void(0);" title="Eliminar <?php echo $row->Accion; ?>" onclick="deleteRow('<?php echo $row->Accion; ?>', '<?php echo base_url() . 'administracion/acciones/deletePermiso/' . $row->ID_ACCION; ?>');"><?php echo img(base_url() . 'assets/admin/tpl_itproyecta/img/delete.png'); ?></a>
                        <?php endif; ?>
                            </td>
                        </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (strlen($pag_links)) : ?>
                <div class="pagination">
                    <ul id="pagination">
                        <?php echo $pag_links; ?>
                    </ul>
                </div><!-- end pagination -->
                <?php endif; ?>

                <div class="panel-search">
                    <form class="form-inline" action="<?php echo base_url(); ?>administracion/acciones/searchPermisos/<?php echo $registros; ?>" method="post">
                        <fieldset>
                            <legend>Buscador</legend>
                                <label for="txtPermisoSearch">Permiso: </label>
                                <input type="text" name="txtPermisoSearch" id="txtPermisoSearch">
                                <label for="txtOpcionSearch">Opción: </label>
                                <input type="text" name="txtOpcionSearch" id="txtOpcionSearch">
                                <label for="txtClaveSearch">Clave: </label>
                                <input type="text" name="txtClaveSearch" id="txtClaveSearch">
                                <button type="submit" class="btn"><i class="icon-search"></i></button>
                        </fieldset>
                    </form>
                </div><!-- end panel-search -->

                <div class="extra-table">
                    <ul>
                        <li><?php echo anchor('', '<i class="icon-search"></i>', 'title="Buscar" class="displaySearch"') ?></li>
                        <li>
                            <select class="span12" id="slRegistro" data-sortby="<?php echo $this->uri->segment(5); ?>" data-sortorder="<?php echo $this->uri->segment(6); ?>" data-search="<?php echo $this->uri->segment(4); ?>">
                            <?php for($i = 10; $i <= 100; $i+=10) : ?>
                                <option value="<?php echo $i ?>" <?php if ($registros == $i) { echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                            </select>
                        </li>
                        <li>
                            <label for="txtPagina">Página: </label>
                            <input class="input-mini" type="text" name="txtPage" id="txtPage" data-total="<?php echo $num_rows; ?>" data-sortby="<?php echo $this->uri->segment(5); ?>" data-sortorder="<?php echo $this->uri->segment(6); ?>" data-search="<?php echo $this->uri->segment(4); ?>">
                            <button class="btn" id="btnGo">Ir</button>
                        </li>
                        <li><span>Mostrando <?php if ($registros > $num_rows) echo $num_rows; else echo $registros; ?> registros de <?php echo $num_rows; ?></span></li>
                    </ul>
                </div><!-- end extra-table -->
            <?php else : ?>
                <div class="alert alig_center">
                    No se encontraron datos para mostrar.
                </div>
            <?php endif; ?>
        </section>
        <!-- Fin #main -->

        <!-- Formulario que nos permitirá agregar un nuevo perfil -->
        <!-- Inicio addPerfilModal -->
        <div class="modal hide fade" id="addPermisoModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Agregar Permiso</h3>
            </div>
            <?php echo form_open('administracion/acciones/verifyAddPermiso', array('name' => 'frmAddPermiso', 'id' => 'frmAddPermiso', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Permiso: *', 'txtPermiso', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $permiso = array(
                            'name' => 'txtPermiso',
                            'id' => 'txtPermiso',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/acciones/validatePermisoAjax\');'
                        );
                        echo form_input($permiso);
                        ?>
                        <div id="txtPermisoFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Key: *', 'txtKey', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $key = array(
                            'name' => 'txtKey',
                            'id' => 'txtKey',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/acciones/validatePermisoAjax\');'
                        );
                        echo form_input($key);
                        ?>
                        <div id="txtKeyFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Opción: ', 'ddlOpcion', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $data = array('0' => 'Seleccione la opción');
                        if (isset($opciones) && count($opciones)) {
                            foreach ($opciones as $op) {
                                $data[$op->ID_OPCION] = $op->Opcion;
                            }
                        }
                        echo form_dropdown('ddlOpcion', $data, '0', 'id = "ddlOpcion"');
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Activo: ', 'ddlActivo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $activo = array('0' => 'No', '1' => 'S&iacute;');
                        echo form_dropdown('ddlActivo', $activo, '0', 'id = "ddlActivo"');
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
                echo form_button(array('id' => 'btnAddAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Permiso', 'content' => 'Agregar Permiso'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- Fin addPerfilModal -->

        <!-- Formulario que nos permitirá editar información de perfil -->
        <!-- Inicio editPerfilModal -->
        <div class="modal hide fade" id="editPermisoModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Editar Permiso</h3>
            </div>
            <?php echo form_open('administracion/acciones/verifyEditPermiso', array('name' => 'frmEditPermiso', 'id' => 'frmEditPermiso', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Permiso: *', 'txtPermisoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $txtPermisoEdit = array(
                            'name' => 'txtPermisoEdit',
                            'id' => 'txtPermisoEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/acciones/validatePermisoAjax\');'
                        );
                        echo form_input($txtPermisoEdit);
                        ?>
                        <div id="txtPermisoEditFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Key: *', 'txtKeyEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $txtKeyEdit = array(
                            'name' => 'txtKeyEdit',
                            'id' => 'txtKeyEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/acciones/validatePermisoAjax\');'
                        );
                        echo form_input($txtKeyEdit);
                        ?>
                        <div id="txtKeyEditFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo form_label('Opción: ', 'ddlOpcion', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $data = array('0' => 'Seleccione la opción');
                        if (isset($opciones) && count($opciones)) {
                            foreach ($opciones as $op) {
                                $data[$op->ID_OPCION] = $op->Opcion;
                            }
                        }
                        echo form_dropdown('ddlOpcion', $data, '0', 'id = "ddlOpcion"');
                        ?>
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
                <?php echo form_hidden('hdPermiso', ''); ?>
                <?php echo form_hidden('hdKey', ''); ?>
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnEditAceptar', 'class' => 'btn btn-primary', 'value' => 'Editar Permiso', 'content' => 'Editar Permiso'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- Fin editPerfilModal -->
    </div>
</div>
<!-- Fin container -->