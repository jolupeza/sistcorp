<?php echo doctype('html5'); ?>
<html lang="es-ES">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css" />    
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.css"  />    
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
        <!-- Cargamos los estilos propios de una vista -->
        <?php if (isset($cssLoad) && count($cssLoad)) : ?>
            <?php for ($i = 0; $i < count($cssLoad); $i++) : ?>
                <link rel="stylesheet" href="<?php echo base_url(); ?>css/<?php echo $cssLoad[$i]; ?>.css" />
            <?php endfor; ?>
        <?php endif; ?>  
    </head>
    <body>