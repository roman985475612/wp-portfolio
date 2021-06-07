<?php

spl_autoload_register( function ( $class ) {
    $path = get_template_directory() . '/inc/' . str_replace( '\\', '/', $class ) . '.php';
    if( file_exists( $path ) ) {
        include $path;
    }
});

new \Metaboxes\Progress;
new \Metaboxes\Section;
new \Metaboxes\Resume;
new \Metaboxes\Order;
new \Metaboxes\Work;
new \PostColumns\Progress;
new \PostColumns\Section;
new \PostColumns\Order;
new \PostColumns\Resume;
new \PostColumns\Work;

add_action( 'after_setup_theme', 'pf_setup' );
add_action( 'init', 'pf_create_post_types', 0 );
add_action( 'wp_enqueue_scripts', 'pf_scripts' );
add_action( 'customize_register', 'pf_customize_register' );

function pf_setup() {
    add_theme_support( 'post-thumbnails' );
}

function pf_scripts() {
    wp_enqueue_style( 'pf-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' );
    wp_enqueue_style( 'pf-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' );
    wp_enqueue_style( 'pf-bb', 'https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css' );
    wp_enqueue_style( 'pf-style', get_template_directory_uri() . '/assets/css/style.css' );

    wp_enqueue_script( 'pf-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', array(), '', true );
    wp_enqueue_script( 'pf-bb', 'https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js', array(), '', true );
    wp_enqueue_script( 'pf-main', get_template_directory_uri() . '/assets/js/main.js', array(), '', true );

	wp_localize_script( 'pf-main', 'MyAjax', [ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
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

	$setting = 'pf_bitbucket';

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
    register_post_type( 'section', [
        'labels' => [
            'name'               => __( 'Секции', 'pf' ),
            'singular_name'      => __( 'Секции', 'pf' ),
            'add_new'            => __( 'Добавить новую секцию', 'pf' ),
            'add_new_item'       => __( 'Добавить новую секцию', 'pf' ),
            'edit_item'          => __( 'Редактировать секцию', 'pf' ),
            'new_item'           => __( 'Новая секция', 'pf' ),
            'view_item'          => __( 'Посмотреть секцию', 'pf' ),
            'search_items'       => __( 'Найти секцию', 'pf' ),
            'not_found'          => __( 'Секция не найдено', 'pf' ),
            'not_found_in_trash' => __( 'В корзине секция не найдена', 'pf' ),
            'parent_item_colon'  => __( '', 'pf' ),
            'menu_name'          => __( 'Секции', 'pf' ),
        ],
        'public'       => true,
        'show_ui'  	   => true,
        'menu_icon'    => 'dashicons-screenoptions',
        'show_in_menu' => true,
        'supports'     => ['title', 'editor'],
    ] );

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
        'show_in_menu'  => true,
        'supports'      => ['title'],
    ] );
	
	register_post_type( 'resume', [
        'labels' => [
            'name'               => __( 'Резюме', 'pf' ),
            'singular_name'      => __( 'Резюме', 'pf' ),
            'add_new'            => __( 'Добавить новое резюме', 'pf' ),
            'add_new_item'       => __( 'Добавить новое резюме', 'pf' ),
            'edit_item'          => __( 'Редактировать резюме', 'pf' ),
            'new_item'           => __( 'Новое резюме', 'pf' ),
            'view_item'          => __( 'Посмотреть резюме', 'pf' ),
            'search_items'       => __( 'Найти резюме', 'pf' ),
            'not_found'          => __( 'Резюме не найдено', 'pf' ),
            'not_found_in_trash' => __( 'В корзине резюме не найдено', 'pf' ),
            'parent_item_colon'  => __( '', 'pf' ),
            'menu_name'          => __( 'Резюме', 'pf' ),
        ],
        'public'        => false,
        'show_ui'   	=> true,
        'menu_icon'     => 'dashicons-welcome-learn-more',
        'show_in_menu'  => true,
        'supports'      => ['title', 'editor'],
    ] );
	
	register_post_type( 'order', [
        'labels' => [
            'name'               => __( 'Заявки', 'pf' ),
            'singular_name'      => __( 'Заявки', 'pf' ),
            'add_new'            => __( 'Добавить новую заявку', 'pf' ),
            'add_new_item'       => __( 'Добавить новую заявку', 'pf' ),
            'edit_item'          => __( 'Редактировать заявку', 'pf' ),
            'new_item'           => __( 'Новое заявка', 'pf' ),
            'view_item'          => __( 'Посмотреть заявку', 'pf' ),
            'search_items'       => __( 'Найти заявку', 'pf' ),
            'not_found'          => __( 'Заявка не найдено', 'pf' ),
            'not_found_in_trash' => __( 'В корзине заявка не найдена', 'pf' ),
            'parent_item_colon'  => __( '', 'pf' ),
            'menu_name'          => __( 'Заявки', 'pf' ),
        ],
        'public'        => false,
        'show_ui'   	=> true,
        'menu_icon'     => 'dashicons-email',
        'show_in_menu'  => true,
        'supports'      => ['title'],
    ] );
	
	register_post_type( 'work', [
        'labels' => [
            'name'               => __( 'Работы', 'pf' ),
            'singular_name'      => __( 'Работы', 'pf' ),
            'add_new'            => __( 'Добавить новую работу', 'pf' ),
            'add_new_item'       => __( 'Добавить новую работу', 'pf' ),
            'edit_item'          => __( 'Редактировать работу', 'pf' ),
            'new_item'           => __( 'Новая работа', 'pf' ),
            'view_item'          => __( 'Посмотреть работу', 'pf' ),
            'search_items'       => __( 'Найти работу', 'pf' ),
            'not_found'          => __( 'Заявка на работу', 'pf' ),
            'not_found_in_trash' => __( 'В корзине работа не найдена', 'pf' ),
            'parent_item_colon'  => __( '', 'pf' ),
            'menu_name'          => __( 'Работы', 'pf' ),
        ],
        'public'        => false,
        'show_ui'   	=> true,
        'menu_icon'     => 'dashicons-images-alt',
        'show_in_menu'  => true,
        'supports'      => ['title', 'thumbnail'],
    ] );
}

require get_template_directory() . '/inc/shortcodes.php';

require get_template_directory() . '/inc/form-controller.php';

require get_template_directory() . '/inc/helpers.php';
