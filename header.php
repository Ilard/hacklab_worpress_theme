<!DOCTYPE html>
<html>
    <head>
        <title><?php echo wp_title('|',true, 'right'); bloginfo('name'); ?></title>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700,800&display=swap" rel="stylesheet">

        <?php wp_head(); ?>
    </head>
    <body>
        <header class="header">
            <div class="header-wrapper">
                <div class="header-logo">
                    <a class="logo" href="#">Logo Hacklab</a>
                </div>
                <div class="header-menu">
                    <div class="header-menu-toggle">
                        <div class="header-menu-toggle-content">
                            <span></span>
                        </div>
                    </div>
                    <div class="header-menu-content">
                        <?php wp_nav_menu(array('theme_location' => 'main_menu')); ?>
                    </div>
                </div>
            </div>
        </header>
