<?php if (isset($productos) && count($productos) > 0) : ?>
    <table class="container_grid">
        <tr class="header_grid">
            <td>PRODUCTO</td>
            <td>FAMILIA</td>
            <td>PRECIO COSTO</td>
            <td>PRECIO VENTA</td>
            <td>PRECIO X MAYOR</td>
            <td>ACTIVO</td>
            <td>AGREGAR IMAGEN</td>
            <td>ELIMINAR IMAGEN</td>
            <td>EDITAR</td>
            <td>ELIMINAR</td>
        </tr>
        <?php foreach ($productos as $row) : ?>
            <tr class="content_grid">
                <td class="alig_left"><?php echo $row->Producto; ?></td>
                <td class="alig_left"><?php echo $row->Familia; ?></td>
                <td class="alig_right"><?php echo $row->PrecioCosto; ?></td>
                <td class="alig_right"><?php echo $row->PrecioVenta; ?></td>
                <td class="alig_right"><?php echo $row->PrecioXMayor; ?></td>
                <td class="alig_center"><?php $activo = ($row->Activo == '1') ? 'S&iacute;' : 'No'; echo $activo;?></td>
                <td class="alig_center"><a href="javascript:void(0);" class="addFoto" data-idproducto="<?php echo $row->ID_PRODUCTO; ?>" title="Agregar Im&aacute;gen"><?php echo img(base_url() . 'images/photos.png'); ?></a></td>
                <td class="alig_center"><a href="javascript:void(0);" class="editFoto" data-idproducto="<?php echo $row->ID_PRODUCTO; ?>" title="Eliminar Im&aacute;gen"><?php echo img(base_url() . 'images/edit_image.png'); ?></a></td>
                <td class="alig_center"><?php echo anchor('', img(base_url() . 'images/edit.png'), 'data-idproducto="' . $row->ID_PRODUCTO . '" class="editProducto" title="Editar ' . $row->Producto . '"') ?></td>
                <td class="alig_center"><a href="javascript:void(0);" title="Eliminar <?php echo $row->Producto; ?>" onclick="deleteRow('<?php echo $row->Producto; ?>','<?php echo base_url() . 'almacen/productos/deleteProducto/' . $row->ID_PRODUCTO; ?>');"><?php echo img(base_url() . 'images/delete.png'); ?></a></td>
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