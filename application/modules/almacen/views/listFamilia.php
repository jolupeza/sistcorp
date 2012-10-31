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
                <td class="alig_center"><?php echo $row->ID_FAMILIAPROD; ?></td>
                <td class="alig_left"><?php echo $row->Familia; ?></td>
                <td class="alig_left"><?php echo $row->Clase; ?></td>
                <td class="alig_left"><?php echo $row->Grupo; ?></td>
                <td class="alig_center"><?php $activo = ($row->Activo == '1') ? 'S&iacute;' : 'No'; echo $activo;?></td>
                <td class="alig_center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idfamilia="' . $row->ID_FAMILIAPROD . '" class="editFamilia" title="Editar ' . $row->Familia . '"') ?></td>
                <td class="alig_center"><a href="javascript:void(0);" title="Eliminar <?php echo $row->Familia; ?>" onclick="deleteRow('<?php echo $row->Familia; ?>','<?php echo base_url() . 'almacen/familias/deleteFamilia/' . $row->ID_FAMILIAPROD; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
            </tr>
    <?php endforeach; ?>
    </table>
        <?php if (isset($pag_links)) : ?>
        <ul id="pagination-digg">
        <?php echo $pag_links; ?>
        </ul> 
    <?php endif; ?>
<?php else : ?>
    <div class="alert alig_center">
        No se encontraron datos para mostrar.
    </div>
<?php endif; ?>