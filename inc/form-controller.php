<?php

if( wp_doing_ajax() ) {
    add_action( 'wp_ajax_nopriv_pf_contact', 'pf_contact_form_handler' );
    add_action( 'wp_ajax_pf_contact', 'pf_contact_form_handler' );    
}

function pf_contact_form_handler() {
    $response = [
        'msg'   => '',
        'error' => false,
        'id'    => null,
    ];

    $name  = $_POST['name'] ?? false;
    $email = $_POST['email'] ?? false;
    $msg   = $_POST['msg'] ?? '';

    if( ! $name || ! $email ) {
        $response['msg'] = __( 'Пожалуйста, заполните все поля!', 'pf' );
        $response['error'] = true;
    } else {
        $name  = sanitize_text_field( $name );
        $email = sanitize_text_field( $email );
        $msg   = sanitize_text_field( $msg );
    
        $id = wp_insert_post([
            'post_type'   => 'orders',
            'post_title'  => 'Заявка # ',
            'post_status' => 'publish',
            'meta_input'  => [
                'name'   => $name,
                'email'  => $email,
                'msg'    => $msg,
                'status' => 'new',
            ],
        ] );
    
        if ( $id ) {
            wp_update_post( [
                'ID'         => $id,
                'post_title' => 'Заявка # ' . $id,
            ] );
        }
    
        $response['id']  = $id;
        $response['msg'] = 'Ваша заявка # ' . $id . ' принята!';
    }
    
    echo json_encode($response);
    wp_die();
}
