<!-- Inicio footer -->
<footer class="container-fluid navbar-fixed-bottom">
    <div class="row-fluid">
        <p>&copy; Sistemas Coorporativos <?php echo date('Y'); ?>. Derechos reservados.</p>
    </div>
</footer>
<!-- Fin footer -->

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/js/bootstrap.min.js"></script>
<!-- Cargamos el script de jquery.validation -->
<?php if (isset($validar) && $validar) : ?>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/js/messages_es.js"></script>
<?php endif; ?>
<!-- Cargamos script particulares que necesita nuestro controlador -->
<?php if (isset($jsLoad) && count($jsLoad)) : ?>
    <?php for ($i = 0; $i < count($jsLoad); $i++) : ?>
        <script src="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/js/<?php echo $jsLoad[$i]; ?>.js"></script>
    <?php endfor; ?>
<?php endif; ?>

<!--<?php foreach($perfil->js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>-->
    <script>var _root_ = '<?php echo base_url(); ?>'</script>
</body>
</html>