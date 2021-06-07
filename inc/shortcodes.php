<?php
add_shortcode( 'progress', function () {
    ob_start();
    
    $skills = get_posts( [ 'post_type' => 'progress' ] );
    
    foreach ( $skills as $skill ) {
        get_template_part( 'template-parts/section', 'progress', compact( 'skill' ) );
    }
    
    wp_reset_postdata();

	$output = ob_get_contents();
	
    ob_end_clean();
 
	return $output;
} );

add_shortcode( 'resume', function () {
    ob_start();
    
    $posts = get_posts( [
        'post_type'  => 'resume',
        // 'meta_value' => 'sort',
        'order'      => 'ASC',
    ] );
    
    get_template_part( 'template-parts/section', 'resume', compact( 'posts' ) );    
    
    $output = ob_get_contents();
    
    ob_end_clean();
    
    return $output;
} );

add_shortcode( 'work', function () {
    ob_start();
    
    $query = new WP_Query( [
        'post_type'  => 'work',
        'order'      => 'ASC',
        'orderby'    => 'meta_value_num',
        'meta_key'   => 'sort',
    ] );

    get_template_part( 'template-parts/section', 'work', ['posts' => $query->posts] );    
    
    $output = ob_get_contents();
    
    ob_end_clean();
    
    return $output;    
} );

add_shortcode( 'contact', function () {
    get_template_part( 'template-parts/section', 'contact' );
} );
