<!-- Inicio container-fluid -->
<div class="container-fluid">    
    <div class="row-fluid">
        <!-- Inicio #login -->
        <section class="span12" id="login">
            <h3>SISTEMA ADMINISTRATIVO - LOGIN</h3>
            <?php
            $attributes = array('name' => 'frmLogin', 'id' => 'frmLogin', 'class' => 'form-horizontal');
            echo form_open('login/VerifyLogin', $attributes);
            ?>
            <div class="control-group">
                <?php
                // Creamos label empresa
                echo form_label('Empresa: ', 'empresa', array('class' => 'control-label'));

                // Creamos el select de listado de empresas
                $options = array(
                    '' => 'Seleccione su empresa'
                );
                if (isset($empresas)) {
                    foreach ($empresas as $row) {
                        $options[$row->ID_EMPRESA] = $row->RUC . ' - ' . $row->RazonSocial;
                    }
                }
                ?>
                <div class="controls">
                    <?php echo form_dropdown('empresa', $options, '0');
                    echo form_error('empresa', '<label class="error text-error" for="empresa">', '</label>'); ?>
                </div>
            </div>
            <div class="control-group">
                <?php
                // Creamos label username
                echo form_label('Nombre de usuario: ', 'username', array('class' => 'control-label'));
                $dataUsername = array(
                    'name' => 'username',
                    'id' => 'username',
                    'value' => set_value('username')
                );
                ?>
                <div class="controls">
                    <?php echo form_input($dataUsername);
                    echo form_error('username', '<label class="error text-error" for="username">', '</label>'); ?>
                </div>
            </div>
            <div class="control-group">
                <?php
                // Creamos label pass
                echo form_label('Contrase&ntilde;a', 'pass', array('class' => 'control-label'));
                ?>
                <div class="controls">
                    <?php echo form_password(array('name' => 'pass', 'id' => 'pass'));
                    echo form_error('pass', '<label class="error text-error" for="pass">', '</label>'); ?>
                </div>                
            </div>
            <?php
            // Creamos el boton Iniciar sesión
            echo form_submit(array('class' => 'btn btn-primary', 'value' => 'Iniciar Sesión'));
            echo form_close();
            ?>
        </section>
        <!-- Fin #login -->
        <!-- Inicio #msn -->
        <aside id="msn">
            <?php if ($this->session->flashdata('mensaje_error')) : ?>
                <div class="alert alert-error">
                    <p><?php echo $this->session->flashdata('mensaje_error'); ?></p>
                </div>
            <?php endif; ?>
        </aside>
        <!-- Fin #msn -->
    </div>
</div>
<!-- Fin container-fluid -->