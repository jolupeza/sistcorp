<!-- Inicio container -->
<div class="container-fluid">    
    <div class="row-fluid">
        <!-- Inicio #submenu -->
        <aside class="span3" id="submenu">
            <!-- Inicio acciones -->
            <div class="acciones">
                <span>Acciones</span>
                <div id="opciones">                        
                    <a href="javascript:void(0);" id="btnGuardar" title="Guardar Cambios"><?php echo img(base_url() . 'images/save.png') . 'Guardar'; ?></a>
                    <a href="javascript:void(0);" title="Atrás" onclick="history.back();"><img src="<?php echo base_url() . 'images/back.png'?>" />Atrás</a>
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
            <?php if (isset($permisos) && count($permisos) > 0) : ?>
            <?php 
                echo form_open(base_url() . 'administracion/perfil/editPermisos', array('name' => 'frmPermisosPerfil', 'id' => 'frmPermisosPerfil'));
                echo form_hidden('ID_PERFIL', $this->uri->segment(4));
            ?>
                <table class="container_grid">
                    <tr class="header_grid">
                        <td>ID</td>
                        <td>PERMISO</td>
                        <td>HABILITADO</td>
                        <td>DENEGADO</td>
                        <td>IGNORADO</td>
                    </tr>
                    <?php foreach ($permisos as $row) : ?>
                    <tr class="content_grid">
                        <td class="text-center"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>                                                                                                                                                                                                                                                                                                                                                
                        <td class="text-center"><input type="radio" name="perm_<?php echo $row['id']; ?>" value="1" <?php if ($row['valor'] == 1) : ?>checked="checked"<?php endif; ?> /></td>
                        <td class="text-center"><input type="radio" name="perm_<?php echo $row['id']; ?>" value="" <?php if ($row['valor'] == 0) : ?>checked="checked"<?php endif; ?> /></td>
                        <td class="text-center"><input type="radio" name="perm_<?php echo $row['id']; ?>" value="x" <?php if ($row['valor'] === "x") : ?>checked="checked"<?php endif; ?> /></td>
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
                    No existen permisos asignados a este perfil.
                </div>
            <?php endif; ?>
        </section>
        <!-- Fin #main -->
    </div>
</div>
<!-- Fin container -->