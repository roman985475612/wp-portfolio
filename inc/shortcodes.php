<?php
add_shortcode( 'progress', function () {
    ob_start();

    foreach ( get_posts( [ 'post_type' => 'progress' ] ) as $post ) :
    ?>
        <h4><?php echo $post->post_title ?></h4>
        <div class="progress mb-3" style="height: 20px;">
            <div 
                class="progress-bar" 
                role="progressbar" 
                style="width: <?= get_post_meta( $post->ID, 'valuenow', true ) ?>%" 
                aria-valuenow="<?= get_post_meta( $post->ID, 'valuenow', true ) ?>" 
                aria-valuemin="0" 
                aria-valuemax="100"
            ><?= get_post_meta( $post->ID, 'valuenow', true ) ?>%</div>
        </div>
    <?php
    endforeach;
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
    ?>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        <?php foreach( $posts as $post ) : ?>
            <div class="col">
                <div class="card">
                    <div class="card-header">Full-stack deleveper</div>
                    <div class="card-body">
                        <h4 class="card-title">ООО "Рога и копыта"</h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, eum?</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">PHP / Laravel</li>
                        <li class="list-group-item">MySQL</li>
                        <li class="list-group-item">HTML / CSS / JavaScript </li>
                    </ul>
                    <div class="card-footer text-muted">Dates: 2015 - 2017</div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
} );

add_shortcode( 'contact', function () {
    get_template_part( 'template-parts/section', 'contact' );
} );
