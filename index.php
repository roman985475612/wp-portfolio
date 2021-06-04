<?php 
    get_header();
?>
    <?php
    $posts = get_posts( [
        'post_type'  => 'section',
        // 'meta_value' => 'sort',
        'order'      => 'ASC',
    ] );
    $isActive = true;
    foreach( $posts as $post ) : 
        $section = get_post_meta( $post->ID, 'section', true );

        $sectionClasses = [];
        $sectionClasses[] = 'tab-section';
        $sectionClasses[] = "section-$section";

        if( $isActive ) {
            $sectionClasses[] = 'active';
        }

        $isActive = false;
    ?>
        <section 
            class="<?php echo implode( ' ', $sectionClasses ) ?>" 
            id="<?php echo $section ?>"
        >
            <div class="card card-body <?php echo get_post_meta( $post->ID, 'color', true ) ?> text-white py-5">
                <h2 class="text-capitalize"><?php echo get_post_meta( $post->ID, 'title', true ) ?></h2>
                <p class="lead"><?php echo get_post_meta( $post->ID, 'desc', true ) ?></p>
            </div>
            <div class="card card-body py-5">
                <?php echo $post->post_content ?>
                <?php echo do_shortcode( get_post_meta( $post->ID, 'shortcode', true ) ) ?>
            </div>
        </section>
    <?php endforeach ?>
<?php get_footer() ?>