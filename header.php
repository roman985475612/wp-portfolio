<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head() ?>
</head>
<body <?php body_class() ?>>
<?php wp_body_open() ?>

    <div class="container">
        <header id="main-header" class="grid-container">
            <div class="header-left">
                <img src="<?php echo get_theme_mod( 'pf_photo' ) ?>" class="" alt="">
            </div>
            <div class="d-flex justify-content-between align-items-center px-5 text-white header-name" style="background-color: var(--bs-gray-dark);">
                <h1 class="display-4"><?php echo get_theme_mod( 'pf_username' ) ?></h1>
                <div class="d-block">
                    <a href="<?php echo get_theme_mod( 'pf_github' ) ?>" class="text-white">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                </div>
                <div class="d-block">
                    <a href="<?php echo get_theme_mod( 'pf_bitbucket' ) ?>" class="text-white">
                        <i class="fab fa-bitbucket fa-2x"></i>
                    </a>
                </div>
                <div class="d-block">
                    <a href="<?php echo get_theme_mod( 'pf_gitlab' ) ?>" class="text-white">
                        <i class="fab fa-gitlab fa-2x"></i>
                    </a>
                </div>
                <div class="d-block">
                    <a href="<?php echo get_theme_mod( 'pf_telegram' ) ?>" class="text-white">
                        <i class="fab fa-telegram-plane fa-2x"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center px-5 bg-dark header-profession">
                <span class="text-capitalize text-white"><?php echo get_theme_mod( 'pf_vacancy' ) ?></span>
            </div>

            <div class="port-item port-item-1 active" data-section="home">
                <i class="fas fa-home fa-2x"></i>
                <span class="port-item__text">home</span>
            </div>
            <div class="port-item port-item-2" data-section="resume">
                <i class="fas fa-graduation-cap fa-2x"></i>
                <span class="port-item__text">resume</span>
            </div>
            <div class="port-item port-item-3" data-section="work">
                <i class="fas fa-folder-open fa-2x"></i>
                <span class="port-item__text">work</span>
            </div>
            <div class="port-item port-item-4" data-section="contact">
                <i class="fas fa-envelope fa-2x"></i>
                <span class="port-item__text">contact</span>
            </div>
        </header>
