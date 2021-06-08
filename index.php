<?php 
    get_header();
?>
    <?php
    $query = new WP_Query( [
        'post_type'  => 'section',
        'order'      => 'ASC',
        'orderby'    => 'meta_value_num',
        'meta_key'   => 'sort',
    ] );
    
    $isActive = true;
    
    foreach( $query->posts as $post ) : 
        $section = get_post_meta( $post->ID, 'section', true );

        $sectionClasses = [];
        $sectionClasses[] = 'tab-section';
        $sectionClasses[] = "section-$section";

        if( $isActive ) {
            $sectionClasses[] = 'active';
        }

        $sectionClassList = implode( ' ', $sectionClasses );

        $isActive = false;
    ?>
        <section 
            class="<?= $sectionClassList ?>" 
            id="<?= $section ?>"
        >
            <div class="card card-body <?= get_post_meta( $post->ID, 'color', true ) ?> text-white py-5">
                <h2 class="text-capitalize"><?= get_post_meta( $post->ID, 'title', true ) ?></h2>
                <p class="lead"><?= get_post_meta( $post->ID, 'desc', true ) ?></p>
            </div>
            <div class="card card-body py-5">
                <?= $post->post_content ?>
                <?= do_shortcode( get_post_meta( $post->ID, 'shortcode', true ) ) ?>
            </div>
        </section>
    <?php endforeach ?>
<?php get_footer() ?>