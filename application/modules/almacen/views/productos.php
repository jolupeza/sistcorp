<!-- Inicio container -->
<div class="container-fluid">    
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio .acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                    <a href="javascript:void(0);" id="addProducto" title="Agregar Producto"><?php echo img(base_url() . 'images/nuevo.png') . 'Agregar'; ?></a>
                    <?php echo anchor('dashboard', img(base_url() . 'images/back.png') . 'Atr&aacute;s', 'title="Atr&aacute;s"'); ?>
                </div>
            </div>
            <!-- Fin .acciones -->

            <?php if ($this->session->flashdata('mensaje_error')) : ?>
                <div class="alert alert-error"><p><?php echo $this->session->flashdata('mensaje_error'); ?></p></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('mensaje_exito')) : ?>
                <div class="alert alert-success"><p><?php echo $this->session->flashdata('mensaje_exito'); ?></p></div>
            <?php endif; ?>

            <!-- Inicio .acciones -->
            <div class="acciones">
                <span>B&uacute;squeda de Productos</span>
                <?php
                echo form_open('almacen/productos/searchProducto', array('name' => 'frmsearch', 'class' => 'form-search'));
                ?>
                <div class="input-append">
                    <?php echo form_input(array('name' => 'txtNomProducto', 'class' => 'span7 search-query')); ?>
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

            <?php if ($this->session->flashdata('error_foto')) : ?>
                <div class="alert alert-error">
                    <dl>
                        <?php foreach ($this->session->flashdata('error_foto') as $foto => $ms_error) : ?>
                            <dt>Archivo: <?php echo $foto; ?></dt>
                            <dd><?php echo $ms_error; ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success_foto')) : ?>
                <div class="alert alert-success">
                    <p>Archivos subidos:</p>
                    <ul>
                        <?php foreach ($this->session->flashdata('success_foto') as $foto_success) : ?>
                            <li><?php echo $foto_success; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </aside>
        <!-- Fin #submenu -->

        <!-- Inicio main -->
        <section class="span9" id="main">
            <h3><?php echo $subtitle; ?></h3>
            <!-- Inicio div gridResult -->
            <div id="gridResult"></div>      
            <!-- Fin div gridResult -->
        </section>
        <!-- Fin main -->

        <!-- Formulario que nos permitirá agregar un nuevo producto -->        
        <!-- Inicio divIngresoForm -->
        <div class="modal hide fade" id="divIngresoForm">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Agregar Producto</h3>
            </div>
            <?php echo form_open('almacen/productos/verifyAddProducto', array('name' => 'frm', 'id' => 'frm', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Producto: *', 'txtProducto', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $producto = array(
                            'name' => 'txtProducto',
                            'id' => 'txtProducto',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');'
                        );
                        echo form_input($producto);
                        ?>
                        <div id="txtProductoFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Grupo: *', 'ddlGrupo', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el grupo');
                        if (is_array($grupos) && count($grupos) > 0) {
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
                    <?php echo form_label('Clase: *', 'ddlClase', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Primero seleccione el grupo');
                        echo form_dropdown('ddlClase', $opciones, '0', 'id="ddlClase"');
                        ?>
                        <div id="ddlClaseFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Familia: *', 'ddlFamilia', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Primero seleccione la clase');
                        echo form_dropdown('ddlFamilia', $opciones, '0', 'id="ddlFamilia"');
                        ?>
                        <div id="ddlFamiliaFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Unid. Medida: *', 'ddlUniMed', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione la Unidad de Medida');
                        if (is_array($unidades) && $unidades > 0) {
                            foreach ($unidades as $unidad) {
                                $opciones[$unidad->ID_UNIDMED] = $unidad->UnidadMedida;
                            }
                        }
                        echo form_dropdown('ddlUniMed', $opciones, '0', 'id="ddlUniMed"');
                        ?>
                        <div id="ddlUniMedFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Marca: *', 'ddlMarca', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione la Marca');
                        if (is_array($marcas) && count($marcas) > 0) {
                            foreach ($marcas as $marca) {
                                $opciones[$marca->ID_MARCA] = $marca->Marca;
                            }
                        }
                        echo form_dropdown('ddlMarca', $opciones, '0', 'id="ddlMarca"');
                        ?>
                        <div id="ddlMarcaFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Abreviatura:', 'txtAbreviatura', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtAbreviatura', 'id' => 'txtAbreviatura')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Moneda: *', 'ddlMoneda', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione la Moneda');
                        if (is_array($monedas) && count($monedas) > 0) {
                            foreach ($monedas as $moneda) {
                                $opciones[$moneda->ID_MONEDA] = $moneda->Moneda;
                            }
                        }
                        echo form_dropdown('ddlMoneda', $opciones, '0', 'id="ddlMoneda"');
                        ?>
                        <div id="ddlMonedaFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Precio Costo: *', 'txtPrecioCosto', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtPrecioCosto', 'id' => 'txtPrecioCosto', 'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');')); ?>
                        <div id="txtPrecioCostoFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Precio Venta: *', 'txtPrecioVenta', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtPrecioVenta', 'id' => 'txtPrecioVenta', 'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');')); ?>
                        <div id="txtPrecioVentaFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Precio x Mayor: *', 'txtPrecioMayor', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtPrecioMayor', 'id' => 'txtPrecioMayor', 'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');')); ?>
                        <div id="txtPrecioMayorFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Tipo Producto: *', 'ddlTipoProducto', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el tipo del producto');
                        if (is_array($tipos) && count($tipos) > 0) {
                            foreach ($tipos as $tipo) {
                                $opciones[$tipo->ID_TIPOPRODUCTO] = $tipo->Tipo;
                            }
                        }
                        echo form_dropdown('ddlTipoProducto', $opciones, '0', 'id="ddlTipoProducto"');
                        ?>
                        <div id="ddlTipoProductoFailed" class="hidden"></div>
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
                echo form_button(array('id' => 'btnAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Producto', 'content' => 'Agregar Producto', 'onclick' => 'submit(this.form)'));
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
                <h3>Editar Producto</h3>                
            </div>
            <?php echo form_open('almacen/productos/verifyEditProducto', array('name' => 'frmEdit', 'id' => 'frmEdit', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Producto: *', 'txtProductoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $producto = array(
                            'name' => 'txtProductoEdit',
                            'id' => 'txtProductoEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');'
                        );
                        echo form_input($producto);
                        ?>
                        <div id="txtProductoEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Grupo: *', 'ddlGrupoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el grupo');
                        if (is_array($grupos) && count($grupos) > 0) {
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
                    <?php echo form_label('Clase: *', 'ddlClaseEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Primero seleccione el grupo');
                        echo form_dropdown('ddlClaseEdit', $opciones, '0', 'id="ddlClaseEdit"');
                        ?>
                        <div id="ddlClaseEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Familia: *', 'ddlFamiliaEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Primero seleccione la clase');
                        echo form_dropdown('ddlFamiliaEdit', $opciones, '0', 'id="ddlFamiliaEdit"');
                        ?>
                        <div id="ddlFamiliaEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Unid. Medida: *', 'ddlUniMedEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione la Unidad de Medida');
                        if (is_array($unidades) && $unidades > 0) {
                            foreach ($unidades as $unidad) {
                                $opciones[$unidad->ID_UNIDMED] = $unidad->UnidadMedida;
                            }
                        }
                        echo form_dropdown('ddlUniMedEdit', $opciones, '0', 'id="ddlUniMedEdit"');
                        ?>
                        <div id="ddlUniMedEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Marca: *', 'ddlMarcaEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione la Marca');
                        if (is_array($marcas) && count($marcas) > 0) {
                            foreach ($marcas as $marca) {
                                $opciones[$marca->ID_MARCA] = $marca->Marca;
                            }
                        }
                        echo form_dropdown('ddlMarcaEdit', $opciones, '0', 'id="ddlMarcaEdit"');
                        ?>
                        <div id="ddlMarcaEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Abreviatura:', 'txtAbreviatura', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtAbreviatura', 'id' => 'txtAbreviatura')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Moneda: *', 'ddlMonedaEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione la Moneda');
                        if (is_array($monedas) && count($monedas) > 0) {
                            foreach ($monedas as $moneda) {
                                $opciones[$moneda->ID_MONEDA] = $moneda->Moneda;
                            }
                        }
                        echo form_dropdown('ddlMonedaEdit', $opciones, '0', 'id="ddlMonedaEdit"');
                        ?>
                        <div id="ddlMonedaEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Precio Costo: *', 'txtPrecioCostoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtPrecioCostoEdit', 'id' => 'txtPrecioCostoEdit', 'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');')); ?>
                        <div id="txtPrecioCostoEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Precio Venta: *', 'txtPrecioVentaEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtPrecioVentaEdit', 'id' => 'txtPrecioVentaEdit', 'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');')); ?>
                        <div id="txtPrecioVentaEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Precio x Mayor: *', 'txtPrecioMayorEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_input(array('name' => 'txtPrecioMayorEdit', 'id' => 'txtPrecioMayorEdit', 'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'almacen/productos/validateProductoAjax\');')); ?>
                        <div id="txtPrecioMayorEditFailed" class="hidden"></div>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Tipo Producto: *', 'ddlTipoProductoEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el tipo del producto');
                        if (is_array($tipos) && count($tipos) > 0) {
                            foreach ($tipos as $tipo) {
                                $opciones[$tipo->ID_TIPOPRODUCTO] = $tipo->Tipo;
                            }
                        }
                        echo form_dropdown('ddlTipoProductoEdit', $opciones, '0', 'id="ddlTipoProductoEdit"');
                        ?>
                        <div id="ddlTipoProductoEditFailed" class="hidden"></div>
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
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnAceptar', 'class' => 'btn btn-primary', 'value' => 'Editar Producto', 'content' => 'Editar Producto', 'onclick' => 'submit(this.form)'));
                ?> 
            </div>
            <?php echo form_close(); ?>
            <!-- Inicio div cargando -->
            <div id="cargando" class="hidden"><?php echo img(base_url() . 'images/ajax-loader.gif'); ?></div>
            <!-- Fin div cargando -->
        </div>
        <!-- Fin divEditForm -->

        <!-- Modal para agregar fotos a los productos -->
        <div id="modalFoto" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Agregar Im&aacute;gen</h3>
            </div>
            <?php echo form_open_multipart('almacen/productos/addFoto', array('name' => 'frmFoto', 'id' => 'frmFoto', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                    <?php echo form_label('Foto01: ', 'foto01', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_upload(array('name' => 'foto01', 'id' => 'foto01')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Foto02: ', 'foto02', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_upload(array('name' => 'foto02', 'id' => 'foto02')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo form_label('Foto03: ', 'foto03', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo form_upload(array('name' => 'foto03', 'id' => 'foto03')); ?>
                    </div>
                </div>
                <input type="hidden" name="id_producto" value="" />
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                echo form_button(array('id' => 'btnAceptar', 'class' => 'btn btn-primary', 'value' => 'Agregar Fotos', 'content' => 'Agregar Foto', 'onclick' => 'submit(this.form)'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>

        <!-- Modal para agregar fotos a los productos -->
        <div id="modalEditFoto" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Eliminar Im&aacute;gen</h3>
            </div>
            <div class="modal-body">
                <ul class="thumbnails" id="panelFoto"></ul>
                <?php echo form_hidden('idproducto', ''); ?>
            </div>
            <div class="modal-footer">
                <?php echo form_button(array('id' => 'btnCancelar', 'class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal')); ?>
            </div>
        </div>

    </div>
</div>
<!-- Fin container -->