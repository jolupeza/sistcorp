<?php if (isset($familias) && count($familias) > 0) : ?>
    <table class="container_grid">
        <tr class="header_grid">
            <td>ID</td>
            <td>FAMILIA</td>
            <td>CLASE</td>
            <td>GRUPO</td>
            <td>ACTIVO</td>
            <td>EDITAR</td>
            <td>ELIMINAR</td>
        </tr>
        <?php foreach ($familias as $row) : ?>
            <tr class="content_grid">
                <td class="text-center"><?php echo $row->ID_FAMILIAPROD; ?></td>
                <td><?php echo $row->Familia; ?></td>
                <td><?php echo $row->Clase; ?></td>
                <td><?php echo $row->Grupo; ?></td>
                <td class="text-center"><?php $activo = ($row->Activo == '1') ? 'S&iacute;' : 'No'; echo $activo;?></td>
                <td class="text-center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idfamilia="' . $row->ID_FAMILIAPROD . '" class="editFamilia" title="Editar ' . $row->Familia . '"') ?></td>
                <td class="text-center"><a href="javascript:void(0);" title="Eliminar <?php echo $row->Familia; ?>" onclick="deleteRow('<?php echo $row->Familia; ?>','<?php echo base_url() . 'almacen/familias/deleteFamilia/' . $row->ID_FAMILIAPROD; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
            </tr>
    <?php endforeach; ?>
    </table>
        <?php if (isset($pag_links)) : ?>
        <ul id="pagination-digg">
        <?php echo $pag_links; ?>
        </ul> 
    <?php endif; ?>
<?php else : ?>
    <div class="alert text-center">
        No se encontraron datos para mostrar.
    </div>
<?php endif; ?>