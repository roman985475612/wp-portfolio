<?php

if( wp_doing_ajax() ) {
    add_action( 'wp_ajax_nopriv_pf_contact', 'pf_contact_form_handler' );
    add_action( 'wp_ajax_pf_contact', 'pf_contact_form_handler' );    
}

function pf_contact_form_handler() {
    $response = [
        'is_valid' => true,
        'errors'   => [],
        'id'       => null,
    ];

    $name  = $_POST['name'] ?? false;
    $email = $_POST['email'] ?? false;
    $msg   = $_POST['msg'] ?? '';

    $name  = sanitize_text_field( $name );
    $email = sanitize_text_field( $email );
    $msg   = sanitize_text_field( $msg );

    if( empty( $name ) ) {
        $response['errors']['name'] = __( 'Пожалуйста, заполните имя!', 'pf' );
        $response['is_valid'] = false;
    } 

    if( empty( $email ) ) {
        $response['errors']['email'] = __( 'Пожалуйста, заполните email!', 'pf' );
        $response['is_valid'] = false;
    } elseif( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $response['errors']['email'] = __( 'Пожалуйста, введите корректный email!', 'pf' );
        $response['is_valid'] = false;
    } 

    if( empty( $msg ) ) {
        $response['errors']['msg'] = __( 'Пожалуйста, заполните сообщение!', 'pf' );
        $response['is_valid'] = false;
    } 
    
    if( $response['is_valid'] ) {
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
    
        $response['id'] = $id;
    }
    
    echo json_encode($response);
    wp_die();
}
