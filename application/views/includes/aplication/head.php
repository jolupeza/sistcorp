<?php echo doctype('html5'); ?>
<html lang="es-ES">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />    
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css"  />    
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
        <!-- Cargamos los estilos propios de una vista -->
        <?php if (isset($cssLoad) && count($cssLoad)) : ?>
            <?php for ($i = 0; $i < count($cssLoad); $i++) : ?>
                <link rel="stylesheet" href="<?php echo base_url(); ?>css/<?php echo $cssLoad[$i]; ?>.css" />
            <?php endfor; ?>
        <?php endif; ?>  

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <!-- Cargamos el script de jquery.validation -->
        <?php if (isset($validar) && $validar) : ?>
            <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
        <?php endif; ?>
        <!-- Cargamos script particulares que necesita nuestro controlador -->
        <?php if (isset($jsLoad) && count($jsLoad)) : ?>
            <?php for ($i = 0; $i < count($jsLoad); $i++) : ?>
                <script src="<?php echo base_url(); ?>js/<?php echo $jsLoad[$i]; ?>.js"></script>
            <?php endfor; ?>
        <?php endif; ?>

        <!-- Cargamos script construido para el funcionamiento del controlador -->
        <?php if (isset($jsPropio) && count($jsPropio)) : ?>
            <?php for ($i = 0; $i < count($jsPropio); $i++) : ?>
                <script src="<?php echo base_url(); ?>js/<?php echo $jsPropio[$i]; ?>.js"></script>
            <?php endfor; ?>
        <?php endif; ?> 
    </head>
    <body>