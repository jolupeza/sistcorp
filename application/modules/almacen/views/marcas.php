<!-- Inicio container -->
<div class="container-fluid">    
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                    <a href="javascript:void(0);" id="addMarca" title="Agregar Marca"><?php echo img(base_url() . 'images/nuevo.png') . 'Marca'; ?></a>
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
                <span>B&uacute;squeda de Marcas</span>
                <?php
                echo form_open('almacen/marcas/searchMarca', array('name' => 'frmsearch', 'class' => 'form-search'));
                ?>
                <div class="input-append">
                    <?php echo form_input(array('name' => 'txtNomMarca', 'class' => 'span7 search-query', 'value' => set_value('txtNomMarca'))); ?>
                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                </div>
                <?php echo form_close(); ?> 
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
            <?php if (isset($marcas) && count($marcas)) : ?> 
                <table class="container_grid">
                    <tr class="header_grid">
                        <td>ID</td>
                        <td>MARCA</td>
                        <td>Foto</td>
                        <td>ACTIVO</td>
                        <td>EDITAR</td>
                        <td>ELIMINAR</td>
                    </tr>
                    <?php foreach ($marcas as $marca) : ?>
                        <tr class="content_grid">
                            <td class="text-center"><?php echo $marca->ID_MARCA; ?></td>
                            <td><?php echo $marca->Marca; ?></td>
                            <td class="text-center">
                                <?php
                                if ($marca->Foto && $marca->Foto != '') {
                                    $imgMarca = array(
                                        'src' => base_url() . 'images/marcas/' . $marca->Foto,
                                        'alt' => $marca->Marca,
                                        'title' => $marca->Marca
                                    );
                                    echo img($imgMarca);
                                } else {
                                    $imgMarca = array(
                                        'src' => base_url() . 'images/no-imagen.png',
                                        'alt' => $marca->Marca,
                                        'title' => $marca->Marca
                                    );
                                    echo img($imgMarca);
                                }
                                ?>
                            </td>
                            <td class="text-center"><?php
                                $activo = ($marca->Activo == 1) ? 'S&iacute;' : 'No';
                                echo $activo;
                                ?></td>
                            <td class="text-center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idmarca="' . $marca->ID_MARCA . '" class="editMarca" title="Editar ' . $marca->Marca . '"') ?></td>
                            <td class="text-center"><a href="javascript:void(0);" title="Eliminar <?php echo $marca->Marca; ?>" onclick="deleteRow('<?php echo $marca->Marca; ?>', '<?php echo base_url() . 'almacen/marcas/deleteMarca/' . $marca->ID_MARCA; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php if (isset($pag_links)) : ?>
                    <ul id="pagination">
                        <?php echo $pag_links; ?>
                    </ul> 
                <?php endif; ?>
            <?php else : ?>
                <div class="alert text-center">
                    No se encontraron datos para mostrar.
                </div>
            <?php endif; ?>
        </section>
        <!-- Fin #main -->
    </div>

    <!-- Formulario que nos permitirá agregar un nuevo marca -->        
    <!-- Inicio addMarcaModal -->
    <div class="modal hide fade" id="addMarcaModal">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Agregar Marca</h3>
        </div>
        <?php echo form_open_multipart(base_url() . 'almacen/marcas/verifyAddMarca', array('name' => 'frmAddMarca', 'id' => 'frmAddMarca', 'class' => 'form-horizontal')); ?>
        <div class="modal-body">
            <div class="control-group">
                <?php echo form_label('Marca: *', 'txtMarca', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php
                    $marca = array(
                        'name' => 'txtMarca',
                        'id' => 'txtMarca',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/marcas/validateMarcaAjax\');'
                    );
                    echo form_input($marca);
                    ?>
                    <div id="txtMarcaFailed" class="hidden"></div>
                </div>
            </div>

            <div class="control-group">
                <?php echo form_label('Foto: ', 'flFoto', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo form_upload(array('name' => 'flFoto', 'id' => 'flFoto')); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo form_label('Activo: ', 'ddlActivo', array('class' => 'control-label')); ?>
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
            // Creamos el boton Cancelar , 'onclick' => 'submit(this.form)'
            echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
            // Creamos el boton Agregar Perfil
            echo form_button(array('id' => 'btnAddAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Marca', 'content' => 'Agregar Marca'));
            ?> 
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- Fin addMarcaModal --> 

    <!-- Formulario que nos permitirá editar una marca -->        
    <!-- Inicio editMarcaModal -->
    <div class="modal hide fade" id="editMarcaModal">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Editar Marca</h3>
        </div>
        <?php echo form_open_multipart(base_url() . 'almacen/marcas/verifyEditMarca', array('name' => 'frmEditMarca', 'id' => 'frmEditMarca', 'class' => 'form-horizontal')); ?>
        <div class="modal-body">
            <div class="control-group">
                <?php echo form_label('Marca: *', 'txtEditMarca', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php
                    $marca = array(
                        'name' => 'txtEditMarca',
                        'id' => 'txtEditMarca',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/marcas/validateMarcaAjax\');'
                    );
                    echo form_input($marca);
                    ?>
                    <div id="txtEditMarcaFailed" class="hidden"></div>
                </div>
            </div>

            <div class="control-group">
                <?php echo form_label('Foto: ', 'fltFoto', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo form_upload(array('name' => 'flFoto', 'id' => 'flFoto')); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo form_label('Activo: ', 'ddlActivo', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php
                    $opciones = array('0' => 'No', '1' => 'S&iacute;');
                    echo form_dropdown('ddlActivo', $opciones, '0', 'id="ddlActivo"');
                    ?>
                </div>
            </div>
            <?php 
                echo form_hidden('hdId', '');
                echo form_hidden('hdFoto', '');
            ?>
            <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
        </div>

        <div class="modal-footer">
            <?php
            // Creamos el boton Cancelar
            echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
            // Creamos el boton Agregar Perfil
            echo form_button(array('id' => 'btnEditAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Marca', 'content' => 'Editar Marca'));
            ?> 
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- Fin addMarcaModal --> 

</div>
<!-- Fin container -->