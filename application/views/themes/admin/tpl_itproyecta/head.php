<?php echo doctype('html5'); ?>
<html lang="es-ES">
    <head>
        <meta charset='utf-8' />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/css/bootstrap-responsive.css"  />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/css/style.css" />

    <!--<?php foreach($perfil->css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>-->

        <!-- Cargamos los estilos propios de una vista -->
        <?php if (isset($cssLoad) && count($cssLoad)) : ?>
            <?php for ($i = 0; $i < count($cssLoad); $i++) : ?>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/tpl_itproyecta/css/<?php echo $cssLoad[$i]; ?>.css" />
            <?php endfor; ?>
        <?php endif; ?>
    </head>
    <body>