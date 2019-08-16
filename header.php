<!DOCTYPE html>
<html>
    <head>
        <title><?php echo wp_title('|',true, 'right'); bloginfo('name'); ?></title>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Import styles -->
        <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri();  ?>/dist/main.min.css">

        <?php wp_head(); ?>
    </head>
    <body>
        <header class="header">
            Entête de page
        </header>
