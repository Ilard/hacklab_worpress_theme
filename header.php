<!DOCTYPE html>
<html>
    <head>
        <title><?php echo wp_title('|',true, 'right'); bloginfo('name'); ?></title>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <?php wp_head(); ?>
    </head>
    <body>
        <header class="header">
            <div class="header-wrapper">
                <div class="header-logo">
                    <a class="logo" href="#">Logo Hacklab</a>
                </div>
                <div class="header-menu-toggle">

                </div>
                <div class="header-menu">
                    <?php wp_nav_menu(array('theme_location' => 'main_menu')); ?>
                </div>
            </div>
        </header>
