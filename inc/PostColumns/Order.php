<?php

namespace PostColumns;

class Order
{
    private $post_type = 'orders';

    public function __construct() {
        add_action( "manage_{$this->post_type}_posts_columns", [ $this, 'manage_posts_columns' ] );
        add_action( "manage_{$this->post_type}_posts_custom_column", [ $this, 'manage_posts_custom_column' ], 10, 2 );
        add_filter( "manage_edit-{$this->post_type}_sortable_columns", [ $this, 'manage_edit_sortable_columns' ] );
        add_action( 'pre_get_posts', [ $this, 'orderby_column' ] );
    }

    public function manage_posts_columns( $columns ) {
        $new_columns = [
            'name'    => __( 'Имя клиента', 'pl' ),
            'comment' => __( 'Комментарий', 'pl' ),
            'status'  => __( 'Статус', 'pl' ),
        ];
        
        return array_slice( $columns, 0, 2 ) + $new_columns + $columns;    
    }

    public function manage_posts_custom_column( $column_name, $post_ID ) {
        switch( $column_name ) {
            case 'name':
            case 'comment':
                ?>
                    <a href="<?php echo get_edit_post_link() ?>">
                        <?php echo get_post_meta( $post_ID, $column_name, true ) ?>
                    </a>
                <?php
                break;
            case 'status':
                $status_list = [
                    'new'        => __( 'Новая заявка', 'pl' ),
                    'done'       => __( 'Заявка обработана', 'pl' ),
                    'processing' => __( 'Требуется уточнение', 'pl' ),
                ];
                $status_key = get_post_meta( $post_ID, $column_name, true );
                $status_value = $status_list[ $status_key ];
                ?>
                    <a href="<?php echo get_edit_post_link() ?>">
                        <?php echo $status_value ?>
                    </a>
                <?php
                break;
            }
        return $column_name;
    }

    public function manage_edit_sortable_columns( $columns ) {
        $columns['status'] = 'status';
        return $columns;
    }
    
    public function orderby_column( $query ) {
        if( ! is_admin() )
            return;
     
        $orderby = $query->get( 'orderby' );
     
        if( 'status' == $orderby ) {
            $query->set('meta_key', 'status');
            $query->set('orderby', 'meta_value');
        }
    }
}