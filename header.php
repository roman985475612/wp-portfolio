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
                <img src="<?= get_theme_mod( 'pf_photo' ) ?>" alt="<?= esc_html( get_the_title() ) ?>">
            </div>
            <div class="d-flex justify-content-between align-items-center px-5 text-white header-name" style="background-color: var(--bs-gray-dark);">
                <h1 class="display-4"><?php echo get_theme_mod( 'pf_username' ) ?></h1>
                <div class="d-block">
                    <a href="//<?php echo get_theme_mod( 'pf_github' ) ?>" class="text-white">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                </div>
                <div class="d-block">
                    <a href="//<?php echo get_theme_mod( 'pf_bitbucket' ) ?>" class="text-white">
                        <i class="fab fa-bitbucket fa-2x"></i>
                    </a>
                </div>
                <div class="d-block">
                    <a href="//<?php echo get_theme_mod( 'pf_gitlab' ) ?>" class="text-white">
                        <i class="fab fa-gitlab fa-2x"></i>
                    </a>
                </div>
                <div class="d-block">
                    <a href="//<?php echo get_theme_mod( 'pf_telegram' ) ?>" class="text-white">
                        <i class="fab fa-telegram-plane fa-2x"></i>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center px-5 bg-dark header-profession">
                <span class="text-capitalize text-white"><?php echo get_theme_mod( 'pf_vacancy' ) ?></span>
            </div>
            
            <?php
            $posts = get_posts( [
                'post_type'  => 'section',
                // 'meta_value' => 'sort',
                'order'      => 'ASC',
            ] );
            $isActive = true;
            $i = 1;
            foreach( $posts as $post ) :
                $classes = [];
                $classes[] = "port-item";
                $classes[] = "port-item-$i";
                $classes[] = get_post_meta( $post->ID, 'color', true );

                if( $isActive ) {
                    $classes[] = 'active';
                }
        
                $isActive = false;
                $i += 1;
            ?>
                <div 
                    class="<?php echo implode( ' ', $classes ) ?>" 
                    data-section="<?php echo get_post_meta( $post->ID, 'section', true ) ?>"
                >
                    <i class="<?php echo get_post_meta( $post->ID, 'icon', true ) ?> fa-2x"></i>
                    <span class="port-item__text"><?php echo get_post_meta( $post->ID, 'name', true ) ?></span>
                </div>
            <?php 
            endforeach ?>

        </header>
