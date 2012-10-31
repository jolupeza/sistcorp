<!-- Inicio container -->
<div class="container-fluid">    
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                    <a href="javascript:void(0);" id="addClase" title="Agregar Clase"><?php echo img(base_url() . 'images/nuevo.png') . 'Agregar'; ?></a>
                    <?php echo anchor('dashboard', img(base_url() . 'images/back.png') . 'Atr&aacute;s', 'title="Atr&aacute;s"'); ?>
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
                <span>B&uacute;squeda de Clases</span>
                <?php
                echo form_open('almacen/clases/searchClase', array('name' => 'frmsearch', 'class' => 'form-search'));
                ?>
                <div class="input-append">
                    <?php echo form_input(array('name' => 'txtNomClase', 'class' => 'span7 search-query')); ?>
                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                </div>
                <?php
                echo form_close();
                ?> 
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
            <?php if (isset($clases) && count($clases)) : ?> 
                <table class="container_grid">
                    <tr class="header_grid">
                        <td>ID</td>
                        <td>CLASE</td>
                        <td>GRUPO</td>
                        <td>ACTIVO</td>
                        <td>EDITAR</td>
                        <td>ELIMINAR</td>
                    </tr>
                    <?php foreach ($clases as $clase) : ?>
                        <tr class="content_grid">
                            <td class="alig_center"><?php echo $clase->ID_CLASEPROD; ?></td>
                            <td class="alig_left"><?php echo $clase->Clase; ?></td>
                            <td class="alig_left"><?php echo $clase->Grupo; ?></td>
                            <td class="alig_center"><?php $activo = ($clase->Activo == '1') ? 'S&iacute;' : 'No'; echo $activo; ?></td>
                            <td class="alig_center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idclase="' . $clase->ID_CLASEPROD . '" class="editClase" title="Editar ' . $clase->Clase . '"') ?></td>
                            <td class="alig_center"><a href="javascript:void(0);" title="Eliminar <?php echo $clase->Clase; ?>" onclick="deleteRow('<?php echo $clase->Clase; ?>','<?php echo base_url() . 'almacen/clases/deleteClase/' . $clase->ID_CLASEPROD; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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

        <!-- Formulario que nos permitirá agregar un nuevo grupo -->        
        <!-- Inicio divIngresoForm -->
        <div class="modal hide fade" id="divIngresoForm">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Agregar Clase</h3>
            </div>
            <?php echo form_open('almacen/clases/verifyAddClase', array('name' => 'frm', 'id' => 'frm', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Clase: *', 'txtClase', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $clase = array(
                            'name' => 'txtClase',
                            'id' => 'txtClase',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/clases/validateClaseAjax\');'
                        );
                        echo form_input($clase);
                        ?>
                        <div id="txtClaseFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Grupo: *', 'ddlGrupo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el grupo');
                        if (is_array($grupos)) {
                            foreach ($grupos as $grupo) {
                                $opciones[$grupo->ID_GRUPOPROD] = $grupo->Grupo;
                            }
                        }
                        echo form_dropdown('ddlGrupo', $opciones, '0', 'id="ddlGrupo"');
                        ?>
                        <div id="ddlGrupoFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Activo:', 'ddlActivo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'No', '1' => 'S&iacute;');
                        echo form_dropdown('ddlActivo', $opciones, '0', 'id="ddlActivo"');
                        ?>
                    </div>
                </div>
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Clase', 'content' => 'Agregar Clase', 'onclick' => 'submit(this.form)'));
                ?> 
            </div>
            <?php echo form_close(); ?>
            <!-- Inicio div cargando -->
            <div id="cargando"  class="hidden">
                <?php echo img(base_url() . 'images/ajax-loader.gif'); ?>
            </div>
            <!-- Fin div cargando -->
        </div>
        <!-- Fin divIngresoForm -->     

        <!-- Formulario que nos permitirá editar información de un grupo -->        
        <!-- Inicio divEditForm -->
        <div class="modal hide fade" id="divEditForm">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Editar Grupo</h3>                
            </div>
            <?php echo form_open('almacen/clases/verifyEditClase', array('name' => 'frm', 'id' => 'frm', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Clase: *', 'txtClaseEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $clase = array(
                            'name' => 'txtClaseEdit',
                            'id' => 'txtClaseEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/clases/validateClaseAjax\');'
                        );
                        echo form_input($clase);
                        ?>
                        <div id="txtClaseEditFailed" class="hidden"></div>
                    </div>
                </div>    
                <div class="control-group">
                    <?php echo form_label('Grupo: *', 'ddlGrupoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el grupo');
                        if (is_array($grupos)) {
                            foreach ($grupos as $grupo) {
                                $opciones[$grupo->ID_GRUPOPROD] = $grupo->Grupo;
                            }
                        }
                        echo form_dropdown('ddlGrupoEdit', $opciones, '0', 'id="ddlGrupoEdit"');
                        ?>
                        <div id="ddlGrupoEditFailed" class="hidden"></div>
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
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
                <?php echo form_hidden('id', ''); ?>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnAceptar', 'class' => 'btn btn-primary', 'value' => 'Editar Clase', 'content' => 'Editar Clase', 'onclick' => 'submit(this.form)'));
                ?> 
            </div>
            <?php echo form_close(); ?>
            <!-- Inicio div cargando -->
            <div id="cargando" class="hidden"><?php echo img(base_url() . 'images/ajax-loader.gif'); ?></div>
            <!-- Fin div cargando -->
        </div>
        <!-- Fin divEditForm -->                
    </div>
</div>
<!-- Fin container -->