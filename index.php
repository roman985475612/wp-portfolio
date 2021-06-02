<?php 
    get_header();
?>
    <?php
    $pages = get_pages( [
        'sort_column'  => 'post_date',
        'sort_order'   => 'ASC',
    ] );
    $isActive = true;
    foreach( $pages as $page ) : 
        $section = get_post_meta( $page->ID, 'section', true );

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
            <div class="card card-body <?php echo get_post_meta( $page->ID, 'color', true ) ?> text-white py-5">
                <h2 class="text-capitalize"><?php echo get_post_meta( $page->ID, 'title', true ) ?></h2>
                <p class="lead"><?php echo get_post_meta( $page->ID, 'desc', true ) ?></p>
            </div>
            <div class="card card-body py-5">
                <?php echo $page->post_content ?>
                <?php echo do_shortcode( '[' . get_post_meta( $page->ID, 'shortcode', true ) . ']' ) ?>
            </div>
        </section>
    <?php endforeach ?>
<?php get_footer() ?>