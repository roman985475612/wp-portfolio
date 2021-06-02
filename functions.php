<?php

spl_autoload_register( function ( $class ) {
    $path = get_template_directory() . '/inc/' . str_replace( '\\', '/', $class ) . '.php';
    if( file_exists( $path ) ) {
        include $path;
    }
});

new \Metaboxes\Progress;
new \Metaboxes\Page;
new \PostColumns\Progress;
new \PostColumns\Page;

add_action( 'init', 'pf_create_post_types', 0 );
add_action( 'wp_enqueue_scripts', 'pf_scripts' );
add_action( 'customize_register', 'pf_customize_register' );

add_shortcode( 'progress', 'show_progress_bar' );

add_shortcode( 'simple', function ( $atts ) {
	return 'Simple Shortcode!';
} );

function pf_scripts() {
    wp_enqueue_style( 'pf-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' );
    wp_enqueue_style( 'pf-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' );
    wp_enqueue_style( 'pf-bb', 'https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css' );
    wp_enqueue_style( 'pf-style', get_template_directory_uri() . '/assets/css/style.css' );

    wp_enqueue_script( 'pf-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', array(), '', true );
    wp_enqueue_script( 'pf-bb', 'https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js', array(), '', true );
    wp_enqueue_script( 'pf-main', get_template_directory_uri() . '/assets/js/main.js', array(), '', true );
}

function pf_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'pf_header',
		array(
			'title'		  => __( 'Заголовок сайта', 'pf' ),
			'description' => __( 'Заполнение заголовка сайта', 'pf' ),
			'priority'	  => 1,
        )
	);

    // $transport = 'postMessage';
    $transport = 'refresh';

	$setting = 'pf_photo';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, $setting, [
            'label'    => __( 'Фото', 'pf' ),
            'settings' => $setting,
            'section'  => 'pf_header'
        ] )
	);

	$setting = 'pf_username';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		$setting,
		[
			'section' => 'pf_header',
			'label'	  => __( 'Фамилия Имя Отчество', 'pf' ),
			'type'	  => 'text'
        ]
	);

	$setting = 'pf_vacancy';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		$setting,
		[
			'section' => 'pf_header',
			'label'	  => __( 'Вакансия', 'pf' ),
			'type'	  => 'text'
        ]
	);

	$setting = 'pf_github';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		$setting,
		[
			'section' => 'pf_header',
			'label'	  => __( 'GitHub', 'pf' ),
			'type'	  => 'url'
        ]
	);

	$setting = 'pf_gitlab';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		$setting,
		[
			'section' => 'pf_header',
			'label'	  => __( 'GitLab', 'pf' ),
			'type'	  => 'url'
        ]
	);

	$setting = 'pf_bitbacket';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		$setting,
		[
			'section' => 'pf_header',
			'label'	  => __( 'Bitbacket', 'pf' ),
			'type'	  => 'url'
        ]
	);

	$setting = 'pf_telegram';

	$wp_customize->add_setting(
		$setting,
		[
            'type'       => 'theme_mod',
	        'capability' => 'edit_theme_options',
			'default'	 => '',
			'transport'	 => $transport,
        ]
	);

	$wp_customize->add_control(
		$setting,
		[
			'section' => 'pf_header',
			'label'	  => __( 'Telegram', 'pf' ),
			'type'	  => 'url'
        ]
	);

}

function pf_create_post_types() {
    register_post_type( 'progress', [
        'labels' => [
            'name'               => __( 'Прогресс', 'pf' ),
            'singular_name'      => __( 'Прогресс', 'pf' ),
            'add_new'            => __( 'Добавить новый прогресс', 'pf' ),
            'add_new_item'       => __( 'Добавить новый прогресс', 'pf' ),
            'edit_item'          => __( 'Редактировать прогресс', 'pf' ),
            'new_item'           => __( 'Новый прогресс', 'pf' ),
            'view_item'          => __( 'Посмотреть прогресс', 'pf' ),
            'search_items'       => __( 'Найти прогресс', 'pf' ),
            'not_found'          => __( 'Прогресс не найдено', 'pf' ),
            'not_found_in_trash' => __( 'В корзине прогресс не найдено', 'pf' ),
            'parent_item_colon'  => __( '', 'pf' ),
            'menu_name'          => __( 'Прогресс', 'pf' ),
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug'],
        'menu_icon'     => 'dashicons-chart-bar',
        // 'show_in_menu'  => 'sections',
        'show_in_menu'  => true,
        'supports'      => [
            'title',
            // 'editor',
            // 'thumbnail',
            // 'excerpt',
            // 'custom-fields',
        ],
    ] );
}

function show_progress_bar() {
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
}

function dd( $data ) {
	$dt = print_r( $data, 1 );
	if( is_string( $dt ) ) {
		$dt = htmlspecialchars( $dt );
	}
	?>
		<div class="alert alert-warning" role="alert">
			<h5 class="alert-heading">Report!</h5>
			<hr>
			<pre><?php print_r( $dt ) ?></pre>
		</div>
	<?php
}