<!-- Inicio container -->
<div class="container-fluid">    
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                    <a href="javascript:void(0);" id="addGrupo" title="Agregar Grupo"><?php echo img(base_url() . 'images/nuevo.png') . 'Agregar'; ?></a>
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
                <span>B&uacute;squeda de Grupos</span>
                <?php
                echo form_open('almacen/grupos/searchGrupo', array('name' => 'frmsearch', 'class' => 'form-search'));
                ?>
                <div class="input-append">
                    <?php echo form_input(array('name' => 'txtNomGrupo', 'class' => 'span7 search-query')); ?>
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
            <?php if (isset($grupos) && count($grupos)) : ?>
                <table class="container_grid">
                    <tr class="header_grid">
                        <td>ID</td>
                        <td>GRUPO</td>
                        <td>ACTIVO</td>
                        <td>EDITAR</td>
                        <td>ELIMINAR</td>
                    </tr>
                    <?php foreach ($grupos as $row) : ?>
                        <tr class="content_grid">
                            <td class="text-center"><?php echo $row->ID_GRUPOPROD; ?></td>
                            <td><?php echo $row->Grupo; ?></td>
                            <td class="text-center"><?php $activo = ($row->Activo == '1') ? 'S&iacute;' : 'No'; echo $activo; ?></td>
                            <td class="text-center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idgrupo="' . $row->ID_GRUPOPROD . '" class="editGrupo" title="Editar ' . $row->Grupo . '"') ?></td>
                            <td class="text-center"><a href="javascript:void(0);" title="Eliminar <?php echo $row->Grupo; ?>" onclick="deleteRow('<?php echo $row->Grupo; ?>','<?php echo base_url() . 'almacen/grupos/deleteGrupo/' . $row->ID_GRUPOPROD; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
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
        <!-- Inicio addGrupoModal -->
        <div class="modal hide fade" id="addGrupoModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Agregar Grupo</h3>
            </div>
            <?php echo form_open('almacen/grupos/verifyAddGrupo', array('name' => 'frmAddGrupo', 'id' => 'frmAddGrupo', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Grupo: *', 'txtGrupo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $grupo = array(
                            'name' => 'txtGrupo',
                            'id' => 'txtGrupo',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/grupos/validateGrupoAjax\');'
                        );
                        echo form_input($grupo);
                        ?>
                        <div id="txtGrupoFailed" class="hidden"></div>
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
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnAddAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Grupo', 'content' => 'Agregar Grupo'));
                ?> 
            </div>
            <?php echo form_close(); ?>
            <!-- Inicio div cargando -->
            <div id="cargando"  class="hidden">
                <?php echo img(base_url() . 'images/ajax-loader.gif'); ?>
            </div>
            <!-- Fin div cargando -->
        </div>
        <!-- Fin addGrupoModal -->     

        <!-- Formulario que nos permitirá editar información de un grupo -->        
        <!-- Inicio editGrupoModal -->
        <div class="modal hide fade" id="editGrupoModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Editar Grupo</h3>                
            </div>
            <?php echo form_open('almacen/grupos/verifyEditGrupo', array('name' => 'frmEditGrupo', 'id' => 'frmEditGrupo', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Grupo: *', 'txtGrupoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $grupo = array(
                            'name' => 'txtGrupoEdit',
                            'id' => 'txtGrupoEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/grupos/validateGrupoAjax\');'
                        );
                        echo form_input($grupo);
                        ?>
                        <div id="txtGrupoEditFailed" class="hidden"></div>
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
                <?php echo form_hidden('hdGrupo', ''); ?>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnEditAceptar', 'class' => 'btn btn-primary', 'value' => 'Editar Grupo', 'content' => 'Editar Grupo'));
                ?> 
            </div>
            <?php echo form_close(); ?>
            <!-- Inicio div cargando -->
            <div id="cargando" class="hidden"><?php echo img(base_url() . 'images/ajax-loader.gif'); ?></div>
            <!-- Fin div cargando -->
        </div>
        <!-- Fin editGrupoModal -->                
    </div>
</div>
<!-- Fin container -->