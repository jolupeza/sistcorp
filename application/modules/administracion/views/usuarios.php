<!-- Inicio container -->
<div class="container-fluid">
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">
                <?php if ($this->acl->hasPermission('user_add')) : ?>
                    <a href="javascript:void(0);" id="addUser" title="Agregar Usuario"><?php echo img(base_url() . 'assets/admin/tpl_itproyecta/img/nuevo.png') . 'Agregar'; ?></a>
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
        <?php if (isset($users) && count($users) > 0) : ?>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USUARIO</th>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>PERFIL</th>
                        <th>ACTIVO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
            <?php foreach ($users as $row) : ?>
                <tbody>
                    <tr>
                        <td class="td-center"><?php echo $row->ID_USUARIO; ?></td>
                        <td><?php echo $row->Usuario; ?></td>
                        <td><?php echo $row->Nombres . ' ' . $row->Ape_Paterno . ' ' . $row->Ape_Materno; ?></td>
                        <td><?php echo $row->Email; ?></td>
                        <td><?php echo $row->PERFIL; ?></td>
                        <td class="td-center"><?php $activo = ($row->Activo == '1') ? 'S&iacute;' : 'No';echo $activo; ?></td>
                        <td class="td-center">
                <?php if($this->acl->hasPermission('perm_view')) : ?>
                        <?php echo anchor('administracion/usuarios/permisosUser/' . $row->ID_USUARIO, img(base_url() . 'assets/admin/tpl_itproyecta/img/permisos.png'), 'title="Ver permisos de ' . $row->Usuario . '"') ?>
                <?php endif; ?>
                <?php if($this->acl->hasPermission('user_edit_all')) : ?>
                        <?php echo anchor('', img(base_url() . 'assets/admin/tpl_itproyecta/img/edit.png'), 'data-iduser="' . $row->ID_USUARIO . '" class="editUser" title="Editar ' . $row->Usuario . '"') ?>
                <?php endif; ?>
                <?php if($this->acl->hasPermission('user_del_all')) : ?>
                        <a href="javascript:void(0);" title="Eliminar <?php echo $row->Usuario; ?>" onclick="deleteRow('<?php echo $row->Usuario; ?>', '<?php echo base_url() . 'administracion/usuarios/deleteUser/' . $row->ID_USUARIO; ?>');"><?php echo img(base_url() . 'assets/admin/tpl_itproyecta/img/delete.png'); ?></a>
                <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
            </table>
            <?php if (isset($pag_links)) : ?>
                <ul id="pagination">
                <?php echo $pag_links; ?>
                </ul>
            <?php endif; ?>
            <div class="extra-table">
                <ul>
                    <li><?php echo anchor('', '<i class="icon-search"></i>', 'title="Buscar"') ?></li>
                    <li>
                        <form action="">
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </form>
                    </li>
                    <li>
                        <form class="form-horizontal" action="">
                            <div class="control-group">
                                <label class="control-label" for="txtPagina">Página</label>
                                <div class="controls">
                                    <input type="text" name="txtPagina" id="txtPagina">
                                </div>
                            </div>
                        </form>
                    </li>
                    <li><span>Mostrando 1 a 1 de 1 registros</span></li>
                </ul>
            </div>
        <?php else : ?>
            <div class="alert alig_center">
                No se encontraron datos para mostrar.
            </div>
        <?php endif; ?>
        </section>
        <!-- Fin #main -->

        <!-- Formulario que nos permitirá agregar un nuevo usuario -->
        <!-- Inicio addUserModal -->
        <div class="modal hide fade" id="addUserModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Agregar Usuario</h3>
            </div>
                    <?php echo form_open('administracion/usuarios/verifyAddUser', array('name' => 'frmAddUser', 'id' => 'frmAddUser', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="control-group">
                        <?php echo form_label('Nombres: *', 'txtNomUser', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $nomuser = array(
                            'name' => 'txtNomUser',
                            'id' => 'txtNomUser',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                        );
                        echo form_input($nomuser);
                        ?>
                        <div id="txtNomUserFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    // Creamos label Apellido Paterno
                    echo form_label('Ape. Paterno: *', 'txtApePaterno', array('class' => 'control-label'));
                    $apepaterno = array(
                        'name' => 'txtApePaterno',
                        'id' => 'txtApePaterno',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($apepaterno); ?>
                        <div id="txtApePaternoFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    echo form_label('Ape. Materno: *', 'txtApeMaterno', array('class' => 'control-label'));
                    $apematerno = array(
                        'name' => 'txtApeMaterno',
                        'id' => 'txtApeMaterno',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($apematerno); ?>
                        <div id="txtApeMaternoFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    echo form_label('Usuario: *', 'txtUsername', array('class' => 'control-label'));
                    $username = array(
                        'name' => 'txtUsername',
                        'id' => 'txtUsername',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($username); ?>
                        <div id="txtUsernameFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    echo form_label('Password: *', 'txtPassword', array('class' => 'control-label'));
                    $password = array(
                        'name' => 'txtPassword',
                        'id' => 'txtPassword',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_password($password); ?>
                        <div id="txtPasswordFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    echo form_label('Re-Password: *', 'txtRePassword', array('class' => 'control-label'));
                    $repassword = array(
                        'name' => 'txtRePassword',
                        'id' => 'txtRePassword',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_password($repassword); ?>
                        <div id="txtRePasswordFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="alig_center control-group">
                    <label class="radio inline">
                        <input type="radio" name="rbtSexo" value="M" checked="checked">Masculino
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="rbtSexo" value="F">Femenino
                    </label>
                </div>
                <div class="control-group">
                    <?php
                    // Creamos label Email
                    echo form_label('Email: *', 'txtEmail', array('class' => 'control-label'));
                    $email = array(
                        'name' => 'txtEmail',
                        'id' => 'txtEmail',
                        'value' => set_value('txtEmail'),
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($email); ?>
                        <div id="txtEmailFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                        <?php echo form_label('Tel&eacute;fono: ', 'txtTelefono', array('class' => 'control-label')); ?>
                    <div class="controls">
<?php echo form_input(array('name' => 'txtTelefono', 'id' => 'txtTelefono')); ?>
                    </div>
                </div>
                <div class="control-group">
                        <?php echo form_label('Perfil: *', 'ddlPerfiles', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el perfil');
                        if (is_array($perfiles)) {
                            foreach ($perfiles as $perfil) {
                                $opciones[$perfil->ID_PERFIL] = $perfil->Perfil;
                            }
                        }
                        echo form_dropdown('ddlPerfiles', $opciones, '0', 'id="ddlPerfiles"');
                        ?>
                        <div id="ddlPerfilesFailed" class="hidden"></div>
                    </div>
                </div>
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                echo form_button(array('id' => 'btnAddAceptar', 'class' => 'btn btn-primary addUser', 'value' => 'Agregar Usuario', 'content' => 'Agregar Usuario'));
                ?>
            </div>
<?php echo form_close(); ?>
        </div>
        <!-- Fin addUserModal -->

        <!-- Formulario que nos permitirá editar información de un usuario -->
        <!-- Inicio editUserModal -->
        <div class="modal hide fade" id="editUserModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Editar Usuario</h3>
            </div>
            <div class="modal-body">
                    <?php echo form_open('administracion/usuarios/verifyEditUser', array('name' => 'frmEditUser', 'id' => 'frmEditUser', 'class' => 'form-horizontal')); ?>
                <div class="control-group">
                        <?php echo form_label('Nombres: *', 'txtNomUserEdit', array('id' => 'lbl_NomUser', 'class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $nomuser = array(
                            'name' => 'txtNomUserEdit',
                            'id' => 'txtNomUserEdit',
                            'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                        );
                        echo form_input($nomuser);
                        ?>
                        <div id="txtNomUserEditFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    // Creamos label Apellido Paterno
                    echo form_label('Ape. Paterno: *', 'txtApePaternoEdit', array('id' => 'lbl_ApePaterno', 'class' => 'control-label'));
                    $apepaterno = array(
                        'name' => 'txtApePaternoEdit',
                        'id' => 'txtApePaternoEdit',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($apepaterno); ?>
                        <div id="txtApePaternoEditFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    echo form_label('Ape. Materno: *', 'txtApeMaternoEdit', array('id' => 'lbl_ApeMaterno', 'class' => 'control-label'));
                    $apematerno = array(
                        'name' => 'txtApeMaternoEdit',
                        'id' => 'txtApeMaternoEdit',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($apematerno); ?>
                        <div id="txtApeMaternoEditFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                    <?php
                    echo form_label('Usuario: *', 'txtEditUsername', array('id' => 'lbl_Username', 'class' => 'control-label'));
                    $username = array(
                        'name' => 'txtEditUsername',
                        'id' => 'txtEditUsername',
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($username); ?>
                        <div id="txtEditUsernameFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="alig_center control-group">
                    <label class="radio inline">
                        <input type="radio" name="rbtSexo" value="M">Masculino
                    </label>
                    <label class="radio inline">
                        <input type="radio" name="rbtSexo" value="F">Femenino
                    </label>
                </div>
                <div class="control-group">
                    <?php
                    // Creamos label Email
                    echo form_label('Email: *', 'txtEditEmail', array('id' => 'lbl_Email', 'class' => 'control-label'));
                    $email = array(
                        'name' => 'txtEditEmail',
                        'id' => 'txtEditEmail',
                        'value' => set_value('txtEmail'),
                        'onblur' => 'validate(this.value, this.id, \'' . base_url() . 'administracion/usuarios/validateUserAjax\');'
                    );
                    ?>
                    <div class="controls">
<?php echo form_input($email); ?>
                        <div id="txtEditEmailFailed" class="hidden"></div>
                    </div>
                </div>
                <div class="control-group">
                        <?php echo form_label('Tel&eacute;fono: ', 'txtTelefonoEdit', array('id' => 'lbl_Telefono', 'class' => 'control-label')); ?>
                    <div class="controls">
<?php echo form_input(array('name' => 'txtTelefonoEdit', 'id' => 'txtTelefonoEdit')); ?>
                    </div>
                </div>
                <div class="control-group">
                        <?php echo form_label('Perfil: *', 'ddlPerfilesEdit', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $opciones = array('0' => 'Seleccione el perfil');
                        if (is_array($perfiles)) {
                            foreach ($perfiles as $perfil) {
                                $opciones[$perfil->ID_PERFIL] = $perfil->Perfil;
                            }
                        }
                        echo form_dropdown('ddlPerfilesEdit', $opciones, '0', 'id="ddlPerfilesEdit"');
                        ?>
                        <div id="ddlPerfilesEditFailed" class="hidden"></div>
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
<?php echo form_hidden('hdUsername', ''); ?>
<?php echo form_hidden('hdEmail', ''); ?>
                <p class="text-error"><small>Los campos con (*) son obligatorios.</small></p>
            </div>
            <div class="modal-footer">
                <?php
                // Creamos el boton Cancelar
                echo form_button(array('class' => 'btn btn-primary', 'value' => 'Cancelar', 'content' => 'Cancelar', 'data-dismiss' => 'modal'));
                // Creamos el boton Agregar Perfil
                echo form_button(array('id' => 'btnEditAceptar', 'class' => 'btn btn-primary', 'value' => 'Editar Usuario', 'content' => 'Editar Usuario'));
                echo form_close();
                ?>
            </div>
        </div>
        <!-- Fin divEditForm -->
    </div>
</div>
<!-- Fin container -->